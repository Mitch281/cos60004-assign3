<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Manager page" />
    <meta name="keywords" content="" />
    <meta name="author" content="Mitchell Anton" />
    <title>Manager Page | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
    <!-- Description: This is the page where a manager can request data from the database as well as change data in the 
    database -->
    <!-- Author: Mitchell Anton -->
    <!-- Date: 20/10/2021 -->
    <!-- Validated: OK (20/10/2021) -->
</head>

<body>
    <?php
        // Prevents anyone from entering this page directly.
        if (!isset($_SESSION["username"])) {
            header("location: manager-login.php");
        }

        // Display username of manager currently logged in.
        $username = $_SESSION["username"];
        echo "<section id='login_header'>";
        echo "<p id='user_logged_in'>user: $username</p>";
        echo "<a href='logout.php' id='logout_button'>Logout</a>";
        echo "</section>";

        $page = "managerPage";
        include_once("menu.inc"); 
    ?>

    <fieldset class="manager_request">
        <legend>Get All Job Applications</legend>
        <form id="get_all_applications" method="get" action="process-manager-request.php">
            <p class="not_highlighted">
                <select name="manager_sort_request">
                    <option value="none" selected="selected">Sort by:</option>
                    <option value="JobReferenceNumber">Job Reference Number</option>
                    <option value="FirstName">First Name</option>
                    <option value="LastName">Last Name</option>
                    <option value="StreetAddress">Street Address</option>
                    <option value="Suburb">Suburb</option>
                    <option value="StateLocation">State</option>
                    <option value="Postcode">Postcode</option>
                    <option value="Status">Status</option>
                </select>
            </p>
            <input class="form_action" type="submit" name="get_all_applications" value="Get All Applications">
        </form>
    </fieldset>

    <fieldset class="manager_request">
        <legend>Get Job Applications by Job Reference Number</legend>
        <form id="get_eois_given_ref" method="get" action="process-manager-request.php">
            <p class="not_highlighted">
                <select name="manager_sort_request">
                    <option value="none" selected="selected">Sort by:</option>
                    <option value="FirstName">First Name</option>
                    <option value="LastName">Last Name</option>
                    <option value="StreetAddress">Street Address</option>
                    <option value="Suburb">Suburb</option>
                    <option value="StateLocation">State</option>
                    <option value="Postcode">Postcode</option>
                    <option value="Status">Status</option>
                </select>
            </p>
            <label for="reference_number">Job Reference Number</label>
            <input type="text" name="reference_number" id="reference_number" required="required" pattern="[a-zA-Z0-9]{5}" />
            <input class="form_action" type="submit" name="get_eois_given_ref" value="Get Applications">
        </form>
    </fieldset>

    <fieldset class="manager_request">
        <legend>Get Job Applications By Name</legend>
        <form id="get_eois_given_name" method="get" action="process-manager-request.php">
            <p class="not_highlighted">
                <select name="manager_sort_request">
                    <option value="none" selected="selected">Sort by:</option>
                    <option value="JobReferenceNumber">Job Reference Number</option>
                    <option value="FirstName">First Name</option>
                    <option value="LastName">Last Name</option>
                    <option value="StreetAddress">Street Address</option>
                    <option value="Suburb">Suburb</option>
                    <option value="StateLocation">State</option>
                    <option value="Postcode">Postcode</option>
                    <option value="Status">Status</option>
                </select>
            </p>
            <!-- Note that we only require one of first name and last name, so we will not make the fields required.
                 This is why the pattern here is slightly different from the pattern in apply.php. -->
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" pattern="[A-Za-z]{0,20}" />
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" pattern="[A-Za-z]{0,20}" />
            <input class="form_action" type="submit" name="get_eois_given_name" value="Get Applications">
        </form>
    </fieldset>

    <fieldset class="manager_request">
        <legend>Delete Applications Given Job Reference Number</legend>
        <form id="delete_eois_given_ref" method="post" action="process-manager-request.php">
            <label for="job_reference_number">Job Reference Number</label>
            <input type="text" name="job_reference_number" id="job_reference_number" required="required" pattern="[a-zA-Z0-9]{5}" />
            <input class="form_action" type="submit" name="delete_eois_given_ref" value="Delete">
        </form>
    </fieldset>

    <fieldset class="manager_request">
        <legend>Change Status Given EOI Number</legend>
        <form id="change_status_given_eoi_number" method="post" action="process-manager-request.php">
            <label for="eoi_number">EOI Number</label>
            <input type="text" name="eoi_number" id="eoi_number" required="required" pattern="[0-9]*" />

            <label for="status">Status</label>
            <input type="text" name="status"  id="status" required="required" pattern="[a-zA-Z]{3,7}" />
            <input class="form_action" type="submit" name="change_status_given_eoi_number" value="Change Status">
        </form>
    </fieldset>

    <hr />
    <?php
        include_once("footer.inc");
    ?>
</body>