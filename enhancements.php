<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Home page" />
    <meta name="keywords" content="Anton & Turing Technologies, jobs, hire" />
    <meta name="author" content="Mitchell Anton" />
    <title>Enhancements | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" /> 
</head>

<body>
    <?php
        $page = "enhancements1Page";
        include_once("menu.inc"); 
    ?>
    <h1>Enhancements</h1>
    <h2>Enhancement 1</h2>
    <p>In this <a href="index.html">enhancement</a>, I made large buttons to check job openings and to apply for jobs.
        To make this look nice, I added an animation to the buttons. This enhancement was also used to animate the
        underline when the a link in the menu or footer is hovered over by the cursor.</p>
    <ul>
        <li>It goes beyond the the basic requirements of the assignment because animated buttons are not a requirement.
            Moreover, there are already buttons on the menu bar with the exact same functionality, but these big buttons
            just add an extra layer to the home page, as well as making the home page look more complete. For the menu
            bar and footer, the underline animation makes the page more immersive.
        </li>
        <li>The code needed to implement the enhancement is mostly css. The buttons were set adequately large by
            changing the padding of the hyperlink tag. Additionally, I had to ensure that if the page was to shrink, the
            buttons
            would not overlap. This was performed by setting the display of the leftmost hyperlink to inline block.
            Finally, I added the animations by using the transition attribute.
        </li>
    </ul>
    <h2>Enhancement 2</h2>
    <p>In this enhancement, I highlight the link on the menu bar in red if we are currently on this page.</p>
    <ul>
        <li> It goes beyond the basic requirements of the assignment because it is not asked for. It is an extra feature
            that makes navigating the website easier (not important for a small website like this, but very important
            for bigger websites).)
        </li>
        <li>The code needed to implement the enhancement is html and css. Firstly, on every page, I keep track of what
            page we are currently on by adding a unique id to one of the 'a' tags. This is then referenced by css and
            made red in colour.
        </li>
    </ul>
    <hr />
    <footer>
        <nav>
            <a href="index.html">Home</a> |
            <a href="index.html">About Us</a> |
            <a href="mailto:Anton&TuringTechnologies@fakeemail.com">Contact Us</a>
        </nav>
        <a id="footer_logo" href="index.html"><img src="styles/images/logo2.png" alt="Company Logo"></a>
        <p>&copy; Anton & Turing Technologies</p>
    </footer>
</body>