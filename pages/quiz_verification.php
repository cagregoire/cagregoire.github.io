<?php

// Verify that all prompts are filled

if (
    empty($_GET['name']) || 
    empty($_GET['email']) ||
    empty($_GET['q1']) ||
    empty($_GET['q2']) ||
    empty($_GET['q3']) ||
    empty($_GET['q4']) ||
    empty($_GET['q5']) ||
    empty($_GET['q6']) ||
    empty($_GET['q7']) ||
    empty($_GET['q8'])
) {
    echo "<script>
            alert('Please enter all required prompts.');
            window.history.back();
          </script>";
    exit;
}

// Get name and email

$name = htmlspecialchars($_GET['name']);
$email = htmlspecialchars($_GET['email']);

$answers = [                // Collect all answers
    $_GET['q1'], 
    $_GET['q2'], 
    $_GET['q3'], 
    $_GET['q4'],
    $_GET['q5'], 
    $_GET['q6'], 
    $_GET['q7'], 
    $_GET['q8']
];

$value = [                  // Each value has a number assigned
    1 => "Empathy",
    2 => "Communication",
    3 => "Equity",
    4 => "Ethics",
    5 => "Resilience",
    6 => "Professionalism"
];

$descriptions = [
    "Empathy" => "You value understanding other's feelings and perspectives.",
    "Communication" => "You prioritize clear, respectful, and open dialogue.",
    "Equity" => "You believe fairness and inclusion are key to collaboration.",
    "Ethics" => "You are guided by strong moral principles and integrity.",
    "Resilience" => "You stay calm and determined under pressure.",
    "Professionalism" => "You show respect, accountability, and composure in all settings."
];

$scores = [                 // All values start at 0
    "Empathy" => 0,
    "Communication" => 0,
    "Equity" => 0,
    "Ethics" => 0,
    "Resilience" => 0,
    "Professionalism" => 0
];

// Tally scores but also makes sure answers are between 1 and 6

foreach ($answers as $ans) {
    if (isset($value[$ans])) {
        $val = $value[$ans];
        $scores[$val]++;
    }
}

// Determine the strongest value and handle ties (if any)

$maxScore = max($scores);
$strongestValues = array_keys($scores, $maxScore);

if (count($strongestValues) > 1) {
    $strongestValue = implode(" and ", $strongestValues);
} else {
    $strongestValue = $strongestValues[0];
}

$description = $descriptions[$strongestValue] ?? "";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Charles-Anthony Gregoire">
        <meta name="description" content="Casper Form">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/stylingfile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Casper Quiz Result</title>
        <style>
            @media screen and (max-width: 800px) {
                .casperform_div {
                    max-width: 75%;
                    margin: auto;
                }
            }

            .casperform_div {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem; /* smaller controlled spacing */
                margin-top: 1rem;
                padding: 0.5rem;
        }

            .casperform_div div {
                margin-top: 0px;
                padding: 1rem;
            }

            .casperform_div fieldset {
                background-color: powderblue;
                border: 3px solid #DF00FF;
                border-radius: 8px;
            }

            legend {
                font-weight: bold;
                font-size: 1.2rem;
                color: blue;
            }

            label {
                color: #054bad;
                border-color: powderblue;
            }

            fieldset p{
                font-weight: bold;
            }

            form input[type="submit"] {
                background-color: #28a745;
                color: white;
                font-size: 1.2rem;
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                display: block;
                margin: 20px auto 0 auto;
            }

            form input[type="submit"]:hover {
                background-color: #218838;
            }
            
            .retryButton {
                display: inline-block;
                background-color: #28a745;
                color: white !important;
                font-family: "Arial", monospace;
                font-size: 1.2rem;
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                text-decoration: none;
                margin-bottom: 60px;
                text-align: center;
                transition: background-color 0.2s ease-in-out;
            }

            .retryButton:hover {
                background-color: #218838;
                color: white !important;
                font-size: 1.2rem;
            }
        </style>
    </head>

    <body>
        
        <div class="body_wrapper">

            <?php include_once '../nav.php'; ?>

            <div id="centerdiv">

                <div class="casperform_div">

                    <h1 style="text-align: center;">Quiz Results!</h1>

                    <div style="text-align: left;">

                        <p><strong>Name:</strong> <?php echo $name; ?></p>
                        <p><strong>Email:</strong> <?php echo $email; ?></p>

                        <h2>Your strongest Casper value is:</h2>
                        <h1 style="color: red">
                            <?php echo strtoupper(implode(' & ', $strongestValues)); ?>
                        </h1>
                        <ul style="list-style: none; padding: 0;">
                            <?php foreach ($strongestValues as $val): ?>
                                <p><strong><?php echo $val; ?>:</strong> <?php echo $descriptions[$val]; ?></p>
                            <?php endforeach; ?>
                        </ul>

                        <h2>Score Breakdown:</h2>
                        <ul style="list-style: none; padding: 0;">
                            <?php foreach ($scores as $key => $val): ?>
                                <li><?php echo "$key: $val"; ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <h2>All Possible Casper Values:</h2>
                        <ul style="list-style: none; padding: 0;">
                            <?php foreach ($descriptions as $key => $desc): ?>
                                <li style="margin-bottom: 8px; <?php if (in_array($key, $strongestValues)) echo 'font-weight:bold; color:#DF00FF;'; ?>">
                                    <strong><?php echo $key; ?>:</strong> <?php echo $desc; ?>
                                </li>
                            <?php endforeach; ?>    
                        </ul>

                     </div>
                     <a href="my_form.php" class="retryButton">Take the quiz again</a>
                     
                </div>
            </div>
        </div>

        <?php include_once '../footer.php'; ?>

    </body>
</html>