<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Job application form." />
    <meta name="keywords" content="" />
    <meta name="author" content="Mitchell Anton" />
    <title>Manager Page | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
</head>

<body>
    <?php
        $page = "managerPage";
        include_once("menu.inc"); 
        
        // Display username of manager currently logged in.
        $username = $_SESSION["username"];
        echo "<p id='user_logged_in'>user: $username</p>";
    ?>
    <a href="logout.php" id="logout_button">Logout</a>
    <fieldset class="manager_request">
        <legend>Get All Job Applications</legend>
        <form id="get_all_applications" method="get" action="process-manager-request.php">
            <input class="form_action" type="submit" name="get_all_applications" value="Get All Applications">
        </form>
    </fieldset>

    <fieldset class="manager_request">
        <legend>Get Job Applications by Job Reference Number</legend>
        <form id="get_eois_given_ref" method="get" action="process-manager-request.php">
            <label for="reference_number">Job Reference Number</label>
            <input type="text" name="reference_number" id="reference_number" required="required" pattern="[a-zA-Z0-9]{5}" />
            <input class="form_action" type="submit" name="get_eois_given_ref" value="Get Applications">
        </form>
    </fieldset>

    <fieldset class="manager_request">
        <legend>Get Job Applications By Name</legend>
        <form id="get_eois_given_name" method="get" action="process-manager-request.php">
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
            <input type="text" name="status" required="required" pattern="[a-zA-Z]{3,7}" />
            <input class="form_action" type="submit" name="change_status_given_eoi_number" id="status" value="Change Status">
        </form>
    </fieldset>

    <hr />
    <?php
        include_once("footer.inc");
    ?>
</body>