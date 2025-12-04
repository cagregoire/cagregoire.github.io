<?php
session_start();

// Correct password in hash form
$correct_hash = "b14e9015dae06b5e206c2b37178eac45e193792c5ccf1d48974552614c61f2ff";

$error = "";

// Handle password submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $password = $_POST['password'] ?? '';
    $hashedInputted = hash('sha256', $password);

    if ($hashedInputted === $correct_hash) {

        // Correct password = go back to blog.php with admin rights
        $_SESSION['isAdmin'] = true;
        header('Location: blog.php');
        exit();

    } else {
        // Wrong password = error message
        $error = "Incorrect password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Charles-Anthony Gregoire">
    <meta name="description" content="Login Page for To-Do List">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylingfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Blog Admin Login</title>
    <style>
        @media screen and (max-width: 800px) {
            .todoForm_div { grid-template-columns: 1fr; gap: 1.5rem; }
        }
        .todoForm_div {
            width: 500px;
            display: grid;
            grid-gap: 2rem;
            justify-items: center;
            box-sizing: border-box;
        }
        .todoForm_div div { padding: 1rem; }
        .todoForm_div fieldset {
            background-color: powderblue;
            border: 3px solid #DF00FF;
            border-radius: 8px;
            padding: 2rem;
            width: 500px;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .todoForm_div legend { font-weight: bold; font-size: 1.2rem; color: blue; }
        .todoForm_div label { color: #054bad; font-weight: bold; }
        .todoForm_div form input[type="submit"] {
            background-color: #28a745;
            width: auto;
            color: white;
            font-size: 1.2rem;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: block;
            margin: 20px auto 0 auto;
            transition: background-color 0.3s ease;
        }
        .todoForm_div form input[type="submit"]:hover { background-color: #218838; }
        .todoForm_div input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 2px solid #054bad;
            font-size: 1rem;
            text-align: center;
            box-sizing: border-box;
        }
        .todoForm_div h2 { text-align: center; color: #054bad; margin-bottom: 1rem; }
    </style>
</head>

<body>

    <div class="body_wrapper">

        <?php include_once '../includes/nav.php'; ?>

        <div id="centerdiv">
            <h1 style="text-align: center; margin-bottom: 1rem; padding-top: 35%;">Login to Access Admin Rights</h1>

            <div class="todoForm_div">

                <?php if (!empty($error)) : ?>
                    <p style="color: red; text-align: center; font-weight: bold; margin-bottom: 4px;"><?php echo $error; ?></p>
                <?php endif; ?>

                <form method="POST" action="blog_login.php" style="text-align: center; margin-top: 1rem;">
                    <label for="password" style="font-size: 20px;">Password:</label><br><br>
                    <input type="password" id="password" name="password" placeholder="Password" required style="padding: 8px 12px; font-size: 16px;"><br><br>
                    
                    <input type="submit" name="login" value="Login" style="padding: 8px 16px; font-size: 16px; cursor: pointer;">
                </form>
            </div>
        </div>
    </div>

    <?php include_once '../includes/footer.php'; ?>

    </body>
</html>