<?php
    /* Description: This page performs the manager logout function by clearing session storage then redirecting the user
    to the login page.
    Author: Mitchell Anton
    Date: 18/10/2021
    Validated: OK (18/10/2021)
    */
    session_start();
    session_destroy();
    header("Location: manager-login.php");
    die;
?>
