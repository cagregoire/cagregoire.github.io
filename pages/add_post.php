<?php
session_start();

// Technically not necessary but just to be safe
$isAdmin = $_SESSION['isAdmin'] ?? false;
if (!$isAdmin) {
    header("Location: blog.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlentities($_POST['title']);
    $story_raw = $_POST['story'];
    $paragraphs = array_filter(array_map('trim', explode("\n", $story_raw))); // split lines into paragraphs

    // Load existing posts
    $postsJson = file_get_contents("../includes/blog_posts.json");
    $posts = json_decode($postsJson, true);

    // Checks for the last used ID number to append by 1
    $lastIdNum = 0;
    foreach ($posts as $p) {
        if (preg_match('/blog(\d+)/', $p['id'], $matches)) {
            $num = intval($matches[1]);
            if ($num > $lastIdNum) $lastIdNum = $num;
        }
    }
    $newId = 'blog' . ($lastIdNum + 1);

    $date = date("F j, Y"); // So it stores in JSON as "Month day, Year", so prints correctly later

    // Create new post
    $newPost = [
        'id' => $newId,
        'title_heading' => $title,
        'date' => $date,
        'image' => '', // I decided to skip this
        'paragraphs' => $paragraphs
    ];

    $posts[] = $newPost;
    file_put_contents("../includes/blog_posts.json", json_encode($posts, JSON_PRETTY_PRINT));

    header("Location: blog.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Charles-Anthony Gregoire">
        <meta name="description" content="Add New Blog Post Page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/stylingfile.css">
        <link rel="stylesheet" href="../css/blog.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Blog Post Creator</title>
    </head>

    <body>
        
        <?php include_once '../includes/nav.php'; ?>
        
        <div style="text-align: center; margin: 20px;"> 

            <h1 style="text-align: center; margin-top: 120px;">Add New Blog Post</h1>
            <form action="add_post.php" method="POST">
                
                <label for="title" style="font-size: 24px;">Title Heading:</label><br>
                <input type="text" id="title" name="title" required style="width: 70%; padding: 8px;"><br><br>

                <label for="story" style="font-size: 24px;">Blog Content:</label><br>
                <textarea id="story" name="story" rows="20" cols="33" style="width: 70%;" required>Input post content</textarea><br><br>

                <div class="login" style="text-align: right;">

                    <button type="button" onclick="window.location.href='blog.php';" style="padding: 10px 20px; font-size: 20px; margin-right: 10px;">Exit</button>
                    <input type="submit" value="Submit Post" style="padding: 10px 20px; font-size: 20px; margin-right: 15%; margin-bottom: 6%;">
                
                </div>

            </form>
        </div>
        
        <?php include_once '../includes/footer.php'; ?>
        <script src="../script/autosave_draft.js" defer></script>
    </body>
</html>
