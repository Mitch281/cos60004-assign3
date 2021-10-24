<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Enhancements 2 page" />
    <meta name="keywords" content="Anton & Turing Technologies, jobs, hire" />
    <meta name="author" content="Mitchell Anton" />
    <title>Enhancements 2 | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
    <!-- Description: This page describes the assignment 2 enhacements implemented. -->
    <!-- Author: Mitchell Anton -->
    <!-- Date: 15/10/2021 -->
    <!-- Validated: OK (15/10/2021) -->
</head>

<body>
    <?php
        $page = "enhancements2Page";
        include_once("menu.inc"); 
    ?>
    <h1>Enhancements 2</h1>
    <h2><a href="apply.html">Enhancement 1</a></h2>
    <ul>
        <li>
            The interaction required to trigger this enhancement is for the user to visit the apply.html page.
            Note that if the user refreshes the apply.html page, the timer resets. Once the timer hits 30 seconds,
            it will go red and start flashing. Once the timer hits 0, the user will be redirected to index.html.
        </li>
        <li>
            To implement the enhancement, the first thing to do was to implement a timer. This was done by simply
            decrementing a time variable every 1 second using the setInterval() method. The colour change was done by
            using the style.color property in javascript. This was changed when the time variable hit 30 seconds. The
            flashing was again implemented using the setInterval() method. I made an array of display modes and set a
            variable "mode" which switches between the two modes in the array. Finally, once the timer hit 00:00, I used
            the location property of window to redirect the user to index.html.
        </li>
    </ul>
    <h2><a href="index.html">Enhancement 2</a></h2>
    <ul>
        <li>
            To interact with this enhancement, the user first has to visit the home page. There, a slideshow will start
            with a link which directs the user to the corresponding page on each slideshow. The user can jump to any
            point of the slideshow by pressing any of the white circles at the bottom of the slideshow.
        </li>
        <li>
            To implement the enhancement, the first thing to do was set an array of all possible images. An interval is 
            then set which calls cycleImage every 5 seconds. This changes the image and link every 5 seconds (by calling 
            the relevant functions). Additionally, if the user clicked the screen, a function (getButtonClicked()) was 
            used to detect if the user clicked a button to change the image. Finally, a function 
            (highlightCurrentButton()) was added to check which image the slideshow was currently focusing on so the 
            corresponding button could be highlighted in white. It is important that if the user manually changes the 
            slideshow, the interval is reset. This provides a better user experience. This was done in the 
            getButtonClicked function.
        </li>
    </ul>
    <hr />
    <?php
        include_once("footer.inc");
    ?>
</body>