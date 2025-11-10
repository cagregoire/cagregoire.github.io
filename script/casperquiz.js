function validate(event) {
    
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();

    const q1 = document.querySelector('input[name="q1"]:checked');
    const q2 = document.querySelector('input[name="q2"]:checked');
    const q3 = document.querySelector('input[name="q3"]:checked');
    const q4 = document.querySelector('input[name="q4"]:checked');
    const q5 = document.querySelector('input[name="q5"]:checked');
    const q6 = document.querySelector('input[name="q6"]:checked');
    const q7 = document.querySelector('input[name="q7"]:checked');
    const q8 = document.querySelector('input[name="q8"]:checked');

    const answers = [q1, q2, q3, q4, q5, q6, q7, q8];

    const resultDiv = document.getElementById("result");

    resultDiv.textContent = ""; // If quiz is done multiple times, clears previous result

    // Simple email and name verification

    if (name === "" || email === "") {

        alert("Please enter your first name and email.");
        return false;
    }
    else {
        if (!email.includes("@") || !email.includes(".")) {
            alert("Please enter a valid email address.");
            return false;
        }

        if (name === "") {
            alert("Please enter your first name.");
            return false;
        }
    }

    // Loop through all answers to see if they all have a value so theres is no null answers

    for (let i = 0; i < answers.length; i++) {
        if (!answers[i]) {
            alert(`Please answer all the questions.`);
            return false;
        }
    }
    
    // Scoring

    const value = {         // Each value has a number assigned
        1: "Empathy",
        2: "Communication",
        3: "Equity",
        4: "Ethics",
        5: "Resilience",
        6: "Professionalism"
    };

    let scores = {        // All values start at 0
        "Empathy": 0,
        "Communication": 0,
        "Equity": 0,
        "Ethics": 0,
        "Resilience": 0,
        "Professionalism": 0
    };

    answers.forEach(ans => {
        if (ans) {
            scores[value[ans.value]]++;
        }
    });

    // Determining highest score

    let highestScore = -1;
    let strongestValue = "";

    for (const casperValue in scores) {

        const currentScore = scores[casperValue];

        if (currentScore > highestScore) {
            highestScore = currentScore;
            strongestValue = casperValue;
        }
    }

    resultDiv.textContent = `Your strongest Casper value is: ${strongestValue.toUpperCase()}!`;

    return true;
}
