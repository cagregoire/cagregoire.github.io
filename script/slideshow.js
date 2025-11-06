let current_slide = 0; // Must be 0 to match with slides.length

function showSlide(n) {

    // This is to loop back to the first slide if we exceed the number of slides 
    // Also if we add new slides, no need to recode everything

    const slides = document.getElementsByClassName("slideshow_img");

    // Loop forward to first slide
    if (n >= slides.length) {
        current_slide = 0;
    }

    // Loop back to last slide
    if (n < 0) {    
        current_slide = slides.length - 1;
    }

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }

    // Show the current slide
    slides[current_slide].style.display = "block";  
}

function previous() {
    current_slide--;
    showSlide(current_slide);
}

function next() {
    current_slide++;
    showSlide(current_slide);
}

showSlide(current_slide); // current_slide is 0 at the beginning, so the first slide is shown

