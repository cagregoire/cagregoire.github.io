<?php

session_start();

$correct_hash = "b14e9015dae06b5e206c2b37178eac45e193792c5ccf1d48974552614c61f2ff"; // hash of the correct password
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $password = $_POST['password'] ?? '';
    $hashedInputted = hash('sha256', $password);

    if ($hashedInputted === $correct_hash) {
            
        // to-do.php AND login.php are in the same folder
        header('Location: to-do.php'); 
        exit();

    } else {
        $error = "Incorrect password. Try again.";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Charles-Anthony Gregoire">
        <meta name="description" content="Login Page for To-Do List">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/stylingfile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>To-Do List</title>
        <style>
            @media screen and (max-width: 800px) {
                .todoForm_div {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }
            }

            .todoForm_div {
                width: 500px;
                box-sizing: border-box;
                display: grid;
                grid-gap: 2rem;
                justify-items: center;
            }

            .todoForm_div div {
                margin-top: 0px;
                padding: 1rem;
            }

            .todoForm_div fieldset {
                background-color: powderblue;
                border: 3px solid #DF00FF;
                border-radius: 8px;
                padding: 2rem;
                width: 500px;
                max-width: 500px;
                box-sizing: border-box;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .todoForm_div legend {
                font-weight: bold;
                font-size: 1.2rem;
                color: blue;
            }

            .todoForm_div label {
                color: #054bad;
                border-color: powderblue;
                font-weight: bold;
            }

            .todoForm_div form input[type="submit"] {
                background-color: #28a745;
                width: auto;
                margin: 10px auto 0 auto;
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

            .todoForm_div form input[type="submit"]:hover {
                background-color: #218838;
            }

            .todoForm_div input[type="text"] {
                width: 90%;
                padding: 10px;
                margin: 10px 0;
                border-radius: 5px;
                border: 2px solid #054bad;
                font-size: 1rem;
                text-align: center;
                box-sizing: border-box;
            }

            .todoForm_div h2 {
                text-align: center;
                color: #054bad;
                margin-bottom: 1rem;
            }

            ul#todo_list {
                list-style-type: disc;
                padding-left: 20px;
                margin: 20px 0 0 0;
                width: 100%;        
                box-sizing: border-box;
                text-align: left; 
            }

            ul#todo_list li {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #f0f8ff;
                margin-bottom: 10px;
                padding: 10px 12px;
                border-radius: 6px;
                border: 1px solid #ccc;
                font-size: 1rem;
                max-width: 100%;      
                word-wrap: break-word;
                overflow-wrap: break-word; 
                box-sizing: border-box;
            }
        </style>
    </head>

    <body>

        <div class="body_wrapper">

            <?php include_once '../nav.php'; ?>

            <div id="centerdiv">

                <h1 style="text-align: center; margin-bottom: 1rem; padding-top: 45%;">Login to Access To-Do List</h1>

                <div class="todoForm_div">
                    <?php if (!empty($error)) : ?>
                        <p style="color: red; text-align: center; font-weight: bold;"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <form method="POST" action="login.php" style="text-align: center; margin-top: 2rem;">
                        <label for="password" style="font-size: 20px;">Enter Password:</label><br><br>
                        <input type="password" id="password" name="password" placeholder="Password" style="padding: 8px 12px; font-size: 16px;"><br><br>
                        <input type="submit" value="Login" style="padding: 8px 16px; font-size: 16px; cursor: pointer;">
                    </form>
                </div>
            </div>
        </div>

        <?php include_once '../footer.php'; ?>

    </body>
</html>

