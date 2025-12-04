<?php
    session_start();
    $isAdmin = $_SESSION['isAdmin'] ?? false;

    // Load blog posts details from JSON file
    $postsJson = file_get_contents("../includes/blog_posts.json");
    $posts = json_decode($postsJson, true);

    // Filter by date
    $sort = $_GET['sort'] ?? 'newest';

    usort($posts, function($a, $b) use ($sort) {
        $timeA = strtotime($a['date']); // Understands dates like "March 10, 2023"
        $timeB = strtotime($b['date']);

        if ($sort === 'newest') {
            return $timeB - $timeA; // newest → oldest
        } else {
            return $timeA - $timeB; // oldest → newest
        }
    });

    $isDeleteMode = isset($_POST['delete_mode']);

    // Deleting post logic
    if ($isAdmin && isset($_POST['delete_id'])) {
        
        $deleteId = $_POST['delete_id'];

        // Loop through posts and remove the one with matching ID
        $posts = array_filter($posts, function($post) use ($deleteId) {
            return $post['id'] != $deleteId;
        });

        // Order the array IDs properly from 0 to n to not have gaps
        $posts = array_values($posts);

        // Save the changes to JSON file
        file_put_contents("../includes/blog_posts.json", json_encode($posts, JSON_PRETTY_PRINT));
        
        $isDeleteMode = false; // This means you need to click "delete post" button again to delete more posts
        header("Location: blog.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Charles-Anthony Gregoire">
        <meta name="description" content="Blog Page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/stylingfile.css">
        <link rel="stylesheet" href="../css/blog.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>NEL Blog</title>
        <style>
            body {
                font-family: "Raleway", sans-serif;
            }
        </style>
    </head>

    <body>

        <?php include_once '../includes/nav.php'; ?>

            <div class="hero">
                <!-- Hero section, static -->
                <h1>NEO EGOIST LEAGUE<br>NEWS BLOG</h1>
                <p>Welcome to the Neo Egoist League blog!</p>
                <p>You'll find up-to-date news, analysis, and commentary on everything unfolding<br>in the Neo Egoist League. This is based on the Blue Lock manga.</p>
            </div>

            <div style="text-align: right; margin: 1rem; display: flex; justify-content: flex-end; gap: 10px; align-items: center;">
            
                <!-- Admin buttons visible only if logged in -->
                <?php if ($isAdmin): ?>

                    <div class="admin_buttons">
                        
                        <form action="add_post.php" method="get" style="display:inline;">
                            <input type="submit" name="add_post" value="Add Post" style="padding: 8px 16px; font-size: 20px; cursor: pointer;">
                        </form>
                    
                        <form method="POST" action="blog.php" style="display:inline;">
                            <input type="hidden" name="delete_mode" value="1">
                            <input type="submit" value="Delete Post" style="padding: 8px 16px; font-size: 20px; cursor: pointer;">
                        </form>
                    
                    </div>

                    <div class="logout">
                        <form method="POST" action="blog_logout.php" style="display:inline;">
                            <input type="submit" name="logout" value="Log out" style="padding: 8px 16px; font-size: 20px; cursor: pointer; margin-right: 40px;">
                        </form>
                    </div>

                <!-- Else, log in button only -->
                <?php else: ?>

                    <div class="login">
                        <form action="blog_login.php" method="get">
                            <input type="submit" value="Login" style="font-size: 20px; cursor: pointer; margin-right: 40px;">
                        </form>
                    </div>

                <?php endif; ?>
            </div>
            


            <div class="row">

                <div class="leftcolumn">
                    
                    <!-- Printing blog posts in left column, dynamic -->

                    <?php foreach ($posts as $post): ?>

                        <div class="card" id="<?= htmlspecialchars($post['id']) ?>">

                            <!-- If delete post button gets clicked, show delete icon top right of each post -->
                            <?php if ($isDeleteMode && $isAdmin): ?>

                                <form method="POST" action="blog.php" onsubmit="return confirm('Are you sure you want to delete this post?');" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?= $post['id'] ?>">
                                    <input type="hidden" name="delete_mode" value="1">
                                    <button type="submit" name="delete" class="deleteIcon">DELETE 🗑️</button>
                                </form>

                            <?php endif; ?>

                            <h2><?= htmlspecialchars($post['title_heading']) ?></h2>
                            <h5><?= htmlspecialchars($post['date']) ?></h5>

                            <img src="<?= htmlspecialchars($post['image']) ?>" style="height:200px;">

                            <?php foreach ($post['paragraphs'] as $para): ?>
                                <p><?= nl2br(htmlspecialchars($para)) ?></p>
                            <?php endforeach; ?>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="rightcolumn">

                <!-- Search bar section, at the top to avoid page shifting when dynamically searching -->
                <div class="card">
                    <h2>Search Posts</h2>
                    <input type="text" id="searchInput" placeholder="Search keywords..." style="width: 100%; padding: 8px; font-size: 16px;" onkeyup="searchPosts()">
                </div>

                <!-- Sort by date card, reloads page to go immediately to first article -->
                <div class="card">

                    <h2>Filter</h2>
   
                    <form method="GET" action="blog.php">
                        <select name="sort" onchange="this.form.submit()" style="width: 100%; padding: 8px; font-size: 16px;">
                            <option value="newest" <?= ($sort === 'newest') ? 'selected' : '' ?>>Latest → Oldest</option>
                            <option value="oldest" <?= ($sort === 'oldest') ? 'selected' : '' ?>>Oldest → Latest</option>
                        </select>
                    </form>

                </div>
                
                <!-- Recent posts section, dynamically changes -->
                <div class="card">

                    <h2>Recent Posts</h2>
        
                    <div class="recent_posts">

                        <ul style="list-style: none; padding-left: 0;">
                            <?php foreach ($posts as $post): ?>
                                <li>
                                    <a href="#<?= htmlspecialchars($post['id']) ?>">
                                        <?= htmlspecialchars($post['title_heading']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>

                <!-- About the blog section for context -->
                <div class="card">
                    <h2 style="font-size: 36px;">Neo Egoist League</h2>
                    <img src="../pictures/bluelock.png" alt="NEL Logo" style="width:100%">
                    <p>The Neo Egoist League is a round-robin tournament between the world's top football clubs, where players prove their worth through a global auction system. Matches steer away from traditional rules by being “first to 3 goals” to promote a harsh natural-selection environment where egocentrism is rewarded.</p>
                </div>

                <!-- NEL Ranking section, for fun -->
                <div class="card">
                    <h2>Current NEL Ranking</h2>
                    <img src="../pictures/nel_ranking.jpg" alt="NEL Ranking" style="width:100%">
                </div>

            </div>

        <br>
        <?php include_once '../includes/footer.php'; ?>
        <script src="../script/blog_search.js" defer></script>
    </body>
</html>