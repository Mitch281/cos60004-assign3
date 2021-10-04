<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Home page" />
    <meta name="keywords" content="Anton & Turing Technologies, jobs, hire" />
    <meta name="author" content="Mitchell Anton" />
    <title>Home Page | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
    <script src="scripts/enhancements.js"></script>
</head>

<body id="index_page">
    <?php
        $page = "homePage";
        include_once("menu.inc"); 
    ?>
    <h1 id="welcome_message">Welcome to Anton & Turing Technologies</h1>
    <section id="company_info">
        <section id="slideshow">
            <img id="slideshow_image" src="styles/images/slideshow-picture1.jpg" alt="slideshow-pic-1"/>
            <div id="slideshow_navigator">
                <button type="button" id="image1"></button>
                <button type="button" id="image2"></button>
                <button type="button" id="image3"></button>
            </div>
            <a href=#about_us class="slideshow_link">About Us</a>
        </section>
        <h2 id="about_us">About us</h2>
        <p> Here at Anton & Turing Technologies, we provide a wide range of technology and services for your business
            needs!
            Our services ranges from data analysing to cybersecurity. We cover a whole range of technological services
            tailored to you!
        </p>
        <h2>Why Work With Us?</h2>
        <p> We pride ourselves in our friendly and collaborative work environment. Here at Anton & Turing Technologies,
            you
            will find yourself in an accepting environment, ready to tackle any problem!
        </p>
    </section>
    <!-- Enhancement 1 -->
    <a id="jobs" href="jobs.html">Check Out Job Openings Now!</a>
    <a id="apply" href="apply.html">Apply For Jobs Now!</a>
    <br>
    <!-- References -->
    <a href="https://www.freelogodesign.org/manager/signin?r=https%3A%2F%2Fwww.freelogodesign.org%2Fmanager">Logo source</a>
    <a href="https://unsplash.com/photos/kUHfMW8awpE">Background image source</a>
    <h3>Slideshow Images: </h3>
    <ul>
        <li><a href="https://unsplash.com/photos/aWf7mjwwJJo">Image 1</a></li>
        <li><a href="https://pixabay.com/photos/hiring-recruitment-career-business-2575036/">Image 2</a></li>
        <li><a href="https://unsplash.com/photos/IUY_3DvM__w">Image 3</a></li>
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


</html>