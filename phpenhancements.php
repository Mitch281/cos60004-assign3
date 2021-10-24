<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Enhancements" />
    <meta name="keywords" content="Enhancements, php, cos60004, assignment 3" />
    <meta name="author" content="Mitchell Anton" />
    <title>php enhancements | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
    <!-- Description: This page describes the enhancements implemented in assignment 3. -->
    <!-- Author: Mitchell Anton -->
    <!-- Date: 20/10/2021 -->
    <!-- Validated: OK (20/10/2021) -->
</head>

<body>
    <?php
        $page = "phpEnhancementsPage";
        include_once("menu.inc");
    ?>
    <h1>PHP Enhancements</h1>
    <h2><a href="manage.php">Enhancement 1</a></h2>
    <ul>
        <li>The interaction to trigger this enhancement is to visit the manage.php page (manage in nav bar). This will
            automatically redirect the user to a login page. There, the user can log in to access the manage.php page.
            On the manage.php page, you will notice on the top left, it displays the manager's user name and on the
            top right, there is a logout button. If the logout button is pressed, the user is logged out and redirected
            to the login page. Also, unless the user is logged in, the user cannot enter manage.php directly (they will 
            be redirected to the login page). It should be noted that this login button is only visible when the user is
            on the manage page.
        </li>
        <li>The implementation of this enhancement obviously first included the front end design and implmentation.
            After that, using the get method in process-manager-login.php, we can obtain the username and password 
            entered by the user. This is checked against the database to see any matches. If a match is found, the
            user is logged in and the username and password is stored in session storage so the user does not have to 
            login everytime. To check if the user was already logged in, it was simply a matter of checking if there was a
            username in session storage. If there was, then the user has free access to the manage page until the browser 
            is closed. Once the user presses logout, we kill the session using session_destroy and redirect the user to 
            the login page.
        </li>
    </ul>
    <h2><a href="manage.php">Enhancement 2</a></h2>
    <ul>
        <li>The interaction to trigger this enhancement is again to go to the manage page and login. There, the 
            manager has the option to retreive job applications. The enhancement here is the ability to sort job
            applications by certain fields. If "Sort by:" is selected, then the default sorting is applied (sort by
            eoi number). If sorting by first name is selected, it will also sort by last name and vice versa.
        </li>
        <li>The implementation of this enhancement was first to implement the front end. After that, it was simply a
            matter of finding which option was selected in php, and then writing the sql query based on which option was
            selected.
        </li>
    </ul>
    <hr />
    <?php  
        include_once("footer.inc");
    ?>
</body>