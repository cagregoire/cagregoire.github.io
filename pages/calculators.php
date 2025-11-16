<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Charles-Anthony Gregoire">
        <meta name="description" content="Calculators">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/stylingfile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../script/2-calculator.js" defer></script>
        <script src="../script/2-calculator_utils.js" defer></script>
        <title>Calculators</title>
        <style> 
            @media screen and (max-width: 800px) {
                .calculator_div{
                    max-width: 75%;
                    margin: auto;
                    grid-template-columns: 1fr;
                }
            }    
            
            .calculator_div{
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 2rem;
                justify-content: center;
                margin-top: 2rem;
                padding: 1rem;
            }    
            
            .calculator_div div{
                margin-top: 0px;
                padding: 1rem;
            }

            .calculator_div fieldset{
                background-color: powderblue;
                border: 3px solid #DF00FF;
                border-radius: 8px;
            }
            
            legend{
                font-weight: bold;
                font-size: 1.2rem;
                color:blue;
            }

            label{
                font-weight: bold;
                color: #054bad;
                border-color: powderblue;
            }

            .answer{
                display:flex;
                gap: 0.5rem;
                color: red;
            }
        </style>
    </head>

    <body>

        <div class="body_wrapper">

            <?php include_once '../includes/nav.php'; ?>
            
            <div id="centerdiv">

                <h1 style="text-align: center; margin-bottom: 1rem">Some calculators!</h1>

                <div class="calculator_div">
                
                    <!-- Calculator 1: Your age in terms of days -->
                    <fieldset>
                        <legend>How old are you terms of days?</legend>
                        <div>
                            <label for="DOB">Enter your date of birth: </label>
                            <input type="date" id="DOB">
                        </div>
                        <div>
                            <input type="button" id="submit_days" value="Click here to compute" onclick="compute_days()">
                        </div>
                        <div class="answer">
                            <p><strong>Answer:</strong></p>
                            <p id="p_answer_days"></p>
                        </div>
                    </fieldset>

                    <!-- Calculator 2: Radius and area of biggest fitting circle possible -->
                    <fieldset class="right">
                        <legend>The radius and area of the biggest circle fitting in your screen</legend>
                        <div>
                            <input type="button" id="submit_circle" value="Click here to compute" onclick="compute_circle()">
                        </div>
                        <div class="answer">
                            <p><strong>Answer:</strong></p>
                            <p id="p_answer_circle"></p>
                        </div>
                    </fieldset>
                    
                    <!-- Calcultor 3: Palindrome checker -->
                    <fieldset>
                        <legend>Palindrome checker</legend>
                        <div>
                            <label for="possible_palindrome">Enter word:</label>
                            <input type="text" id="possible_palindrome" value="Enter text here">
                        </div>
                        <div>
                            <input type="button" id="submit_palindrome" value="Click here to compute" onclick="check_palindrome()">
                        </div>
                        <div class="answer">
                            <p><strong>Answer:</strong></p>
                            <p id="p_answer_palindrome"></p>
                        </div>
                    </fieldset>
                    
                    <!-- Calculator 4: Fibonacci -->
                    <fieldset class="right">
                        <legend>Fibonacci sequence</legend>
                        <div>
                            <label for="fibo_length">Enter how long would you like me to create the Fibonacci sequence:</label>
                            <input type="number" id="fibo_length">
                        </div>
                        <div>
                            <input type="button" id="submit_fibo" value="Click here to compute" onclick="create_fibo()">
                        </div>
                        <div class="answer">
                            <p><strong>Answer:</strong></p>
                            <p id="p_answer_fibo"></p>
                        </div>
                    </fieldset>   
                        
                </div>
            </div>
        </div>

        <?php include_once '../includes/footer.php'; ?>

    </body>
</html>