<?php
session_start();

// Verifies admin status again
$isAdmin = $_SESSION['isAdmin'] ?? false;
if (!$isAdmin) {
    header("Location: blog.php");
    exit();
}

// Grabs blog post content from JSON
$postsJson = file_get_contents("../includes/blog_posts.json");
$posts = json_decode($postsJson, true);

// Get the post ID to know which to edit
$editId = $_GET['edit_id'] ?? '';
$postToEdit = null;

// Find the post in JSON
foreach ($posts as $p) {
    if ($p['id'] === $editId) {
        $postToEdit = $p;
        break;
    }
}

// If the person decides to type nonexistant ID in URL
if (!$postToEdit) {
    
    header("Location: blog.php");
    exit();
}

// The actual editing logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = htmlentities($_POST['title']);
    $textContent = $_POST['story'];
    $paragraphs = array_filter(array_map('trim', explode("\n", $textContent)));

    // Update blog post content at the correct ID
    foreach ($posts as &$p) {
        if ($p['id'] === $editId) {
            $p['title_heading'] = $title;
            $p['paragraphs'] = $paragraphs;
            break;
        }
    }
    unset($p);

    // Save new changes by updating JSON
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
        <title>Edit Post Panel</title>
    </head>

    <body>
        
        <?php include_once '../includes/nav.php'; ?>
        
        <div style="text-align: center; margin: 20px;"> 
            
            <!-- ID of the post to edit is obtained -->
            <h1 style="text-align: center; margin-top: 120px;">Edit Blog Post</h1>
            <form action="edit_post.php?edit_id=<?= htmlspecialchars($editId) ?>" method="POST">

                <!-- Blog title heading is printed -->
                <label for="title" style="font-size: 24px;">Title Heading:</label><br>
                <input type="text" id="title" name="title" required style="width: 70%; padding: 8px;" value="<?= htmlspecialchars($postToEdit['title_heading']) ?>"><br><br>

                <!-- The default text is replaced by the actual blog text -->
                <label for="story" style="font-size: 24px;">Blog Content:</label><br>
                <textarea id="story" name="story" rows="20" cols="33" style="width: 70%;" required><?= 
                    htmlspecialchars(implode("\n", $postToEdit['paragraphs'])) 
                ?></textarea><br><br>

                <div class="login" style="text-align: right;">
                    <button type="button" onclick="window.location.href='blog.php';" style="padding: 10px 20px; font-size: 20px; margin-right: 10px;">Exit</button>
                    <input type="submit" value="Save Changes" style="padding: 10px 20px; font-size: 20px; margin-right: 15%; margin-bottom: 6%;">
                </div>

            </form>
        </div>
        
        <?php include_once '../includes/footer.php'; ?>

    </body>
</html>
