
function compute_days(){
   
    const dob = get_dob();

    if (!dob) {
        write_answer_days("Invalid input, select a date of birth");
        return;
    }

    const dobConverted = new Date(dob); // Date function converts date into milliseconds
    const today = new Date(); // Today's date in milliseconds

    const ageInMs = today - dobConverted; // Difference in milliseconds
    const ageInDays = Math.floor(ageInMs / (1000 * 60 * 60 * 24)); // Milliseconds into days

    write_answer_days("You are " + ageInDays + " days old.");
}



function compute_circle(){

    const screen = get_screen_dims();
    const radius = Math.min(screen.width, screen.height) / 2;
    const area = Math.PI * radius * radius;

    write_answer_circle("The radius is " + radius + " pixels and the area is " + area.toFixed(0) + " pixels.");
}



function check_palindrome(){

    let text_input = get_palindrome();

    if (text_input.length == 0) {
        write_answer_palindrome("Invalid input, enter text");
        return;
    }

    text_input = text_input.toLowerCase(); // Make everything lowercase
    text_input = text_input.replace(/[^a-z0-9]/gi,''); // Remove anything that is not a letter or number

    let isPalindrome = true;
    for (let i = 0; i < (text_input.length/2); i++) {
        if (text_input[i] !== text_input[text_input.length - 1 - i]){ // First character is 0, so last character is length-1
            isPalindrome = false;
            break;
        }
    }

    if (isPalindrome == true) {
            write_answer_palindrome("Yes! It's a palindrome.");
        } else {
            write_answer_palindrome("No, it's not a palindrome.");
        }
}



function create_fibo(){    

    const fibo_length = get_fibo_length();

    if (fibo_length <= 0) {
        write_answer_fibo("Invalid input, enter a positive integer");
        return;
    }

    let fibo_sequence = [0, 1];
    if (fibo_length > 2) {
        for (let i = 2; i < fibo_length; i++) {
            fibo_sequence[i] = fibo_sequence[i - 1] + fibo_sequence[i - 2];
        }
    }

    write_answer_fibo("Fibonacci sequence of length " + fibo_length + ":<br> " + fibo_sequence.slice(0, fibo_length).join(", "));
}
