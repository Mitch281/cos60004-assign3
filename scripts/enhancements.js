/*  Filename: enhancements.js
    Target html: apply.html, index.html
    Purpose: This file implements two enhancements. The first one is a timer, and the second one is a slideshow. These
    are further elaborated on below.
    Author: Mitchell Anton
    Date written: 22/09/2021 (completed 26/09/2021) */

/* Enhancement 1 is to implement a timer to the apply.html page. When the timer reaches 30 seconds, a warning visual will
be displayed on the page. When the timer reaches 0:00, the applicant will be redirected to the home page. The timer will
start at 5:00. */

"use strict";

const INTERVAL_TIME = 1000;
const FLASH_INTERVAL_TIME = 500;

// Converts seconds to mm:ss format.
function secondsToMinutes(seconds) {
    var numMinutes = Math.floor(seconds / 60);
    var numSeconds = seconds - (numMinutes * 60)
    var mmssFormat = "";
    if (numMinutes < 10) {
        mmssFormat += "0" + numMinutes.toString();
    }
    else {
        mmssFormat += numMinutes.toString();
    }

    mmssFormat += ":";

    if (numSeconds < 10) {
        mmssFormat += "0" + numSeconds.toString();
    }
    else {
        mmssFormat += numSeconds.toString();
    }
    return mmssFormat;
}

// Displays a warning to the user once the timer hits one minute. We will do this by changing the style of the timer.
function changeTimerColour() {
    var timer = document.getElementById("timer");
    timer.style.color = "red";
}

// Flashes the timer when it reaches 30 seconds.
var mode = 1;
function flashTimer() {
    var timer = document.getElementById("timer");
    if (mode == 0) {
        mode = 1;
    }
    else if (mode == 1) {
        mode = 0;
    }
    var displays = ["none", "inline"]
    timer.style.display = displays[mode];
}

var timeLeft = 300;
function startTimer() {
    var timer = document.getElementById("timer");
    timer.textContent = secondsToMinutes(timeLeft);

    // This is when the flashing starts.
    if (timeLeft == 30) {
        changeTimerColour();
        setInterval(flashTimer, FLASH_INTERVAL_TIME);
    }

    if (timeLeft == 0) {
        clearInterval(tickInterval);
        window.location = "index.php";
    }

    timeLeft--;
}
var tickInterval = setInterval(startTimer, INTERVAL_TIME);
window.addEventListener("load", startTimer);

/* Enhancement 2 is to add a slideshow to the index.hmtl page. This slideshow will have buttons which the user can use
to navigate through it. It will slide every 5 seconds.*/

const IMAGE_CYCLE_TIME = 5000;

var running = setInterval(cycleImage, IMAGE_CYCLE_TIME);

var images = ["styles/images/slideshow-picture1.jpg", "styles/images/slideshow-picture2.jpg", "styles/images/slideshow-picture3.jpg"]
var imagesIndex = 0;
var numImages = images.length;

// Change the image.
function cycleImage() {
    if (imagesIndex < numImages - 1) {
        imagesIndex++;
    }
    else {
        imagesIndex = 0;
    }
    changeImage();
    changeLink();
}

// Change the link.
function changeLink() {
    var link = document.getElementsByClassName("slideshow_link")[0];
    switch (imagesIndex) {
        case 0:
            link.href = "#about_us";
            link.textContent = "About Us";
            break;
        case 1:
            link.href = "jobs.php";
            link.textContent = "Check Out Job Openings Now!";
            break;
        case 2:
            link.href = "apply.php"
            link.textContent = "Start Your Journey With Us Today!";
    }
}

// Changes the image based on the imagesIndex, and then highlights the corresponding button. 
function changeImage() {
    var image = document.getElementById("slideshow_image");
    image.src = images[imagesIndex];
    image.alt = "slideshow-pic-" + (imagesIndex + 1).toString();
    highlightCurrentButton();
}

// Gets the id of the button clicked, and then changes the image based on that id.
function getButtonClicked() {
    var slideshowNavButtons = document.getElementById("slideshow_navigator");
    slideshowNavButtons.addEventListener("click", function(event) {
        var clickedButton = event.target;
        switch (clickedButton.id) {
            case "image1":
                imagesIndex = 0;
                break;
            case "image2":
                imagesIndex = 1;
                break;
            case "image3":
                imagesIndex = 2;
                break;
        }
        changeImage();
        changeLink();

        // Reset the interval once a button is clicked so that if the user clicks a button towards the end of a cycle,
        // it does not suddenly change.
        clearInterval(running);
        running = setInterval(cycleImage, 5000);
    });
}

// Dynamically changes the highlighted button based on what image is being displayed.
function highlightCurrentButton() {
    var buttonHighlighted = [false, false, false];
    var slideshowNavButtons = document.getElementById("slideshow_navigator").getElementsByTagName("button");
    switch (imagesIndex) {
        case 0:
            for (var i = 0; i < buttonHighlighted.length; i++) {
                if (i == 0) {
                    buttonHighlighted[i] = true;
                }
                else {
                    buttonHighlighted[i] = false;
                }
            }
            break;
        case 1: 
            for (var i = 0; i < buttonHighlighted.length; i++) {
                if (i == 1) {
                    buttonHighlighted[i] = true;
                }
                else {
                    buttonHighlighted[i] = false;
                }
            }
            break;
        case 2:
            for (var i = 0; i < buttonHighlighted.length; i++) {
                if (i == 2) {
                    buttonHighlighted[i] = true;
                }
                else {
                    buttonHighlighted[i] = false;
                }
            }
            break;
    }

    // Perform the background colour change.
    for (var i = 0; i < slideshowNavButtons.length; i++) {
        if (buttonHighlighted[i]) {
            slideshowNavButtons[i].style.backgroundColor = "white";
        }
        else {
            slideshowNavButtons[i].style.backgroundColor = "";
        }
    }
}

// This first event listener is necessary to highlight the initial button. After that, the changeImage function calls
// highlightCurrentButton
window.addEventListener("load", highlightCurrentButton);

window.addEventListener("load", getButtonClicked);