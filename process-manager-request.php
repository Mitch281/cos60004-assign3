<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Mitchell Anton" />
    <title>Result | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
</head>

<body>
    <?php
        // TODO: Style table.
        // TODO: Check if we need data validation for manager requests???
        // TODO: Add relevant "@" annotations.
        require_once("settings.php");
        $connection = mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
        $sqlTable = "eoi";

        function returnTable($result) {
            echo "<table class='manager_request'>\n";

                // Table headers
                echo "<tr>\n"
                    . "<th>eoi Number</th>\n"
                    . "<th>Job Reference Number</th>\n"
                    . "<th>First Name</th>\n"
                    . "<th>Last Name</th>\n"
                    . "<th>Street Address</th>\n"
                    . "<th>Suburb</th>\n"
                    . "<th>State</th>\n"
                    . "<th>Postcode</th>\n"
                    . "<th>Email</th>\n"
                    . "<th>Phone Number</th>\n"
                    . "<th>Skills</th>\n"
                    . "<th>Other Skills</th>\n"
                    . "<th>Status</th>\n";

                // Table content.
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n"
                        . "<th>" . $row["eoiNumber"] . "</th>\n"
                        . "<th>" . $row["JobReferenceNumber"] . "</th>\n"
                        . "<th>" . $row["FirstName"] . "</th>\n"
                        . "<th>" . $row["LastName"] . "</th>\n"
                        . "<th>" . $row["StreetAddress"] . "</th>\n"
                        . "<th>" . $row["Suburb"] . "</th>\n"
                        . "<th>" . $row["StateLocation"] . "</th>\n"
                        . "<th>" . $row["Postcode"] . "</th>\n"
                        . "<th>" . $row["EmailAddress"] . "</th>\n"
                        . "<th>" . $row["PhoneNumber"] . "</th>\n"
                        . "<th>" . $row["Skills"] . "</th>\n"
                        . "<th>" . $row["OtherSkills"] . "</th>\n"
                        . "<th>" . $row["Status"] . "</th>\n";
                }
                echo "</table>\n";
                mysqli_free_result($result);
        }

        function getAllApplications() {
            global $connection;
            global $sqlTable;
            $query = "select * from eoi";
            $result = mysqli_query($connection, $query);

            if (!$result || mysqli_num_rows($result) == 0) {
                echo "<p>There are no job applications yet.</p>";
            }
            else {
                returnTable($result);
            }
        }

        // Get all of the eoi's corresponding to the entered job reference number.
        function getEOIsGivenRef() {
            global $connection;
            global $sqlTable;
            $jobReferenceNumber = $_GET["reference_number"];

            // DON'T FORGET SINGLE QUOTATION MARKS!
            $query = "select * from eoi where JobReferenceNumber = '$jobReferenceNumber'";
            $result = mysqli_query($connection, $query);

            // Note: !$result is for when query is invalid.
            if (!$result || mysqli_num_rows($result) == 0) {
                echo "<p>There are no job applications for this position yet or this job does not exist.</p>";
            }
            else {
                returnTable($result);
            }
        }

        function getEOIsGivenName() {
            global $connection;
            global $sqlTable;

            $firstName = $_GET["first_name"];
            $lastName = $_GET["last_name"];

            // Both first names and last names empty or both first names and last names filled.
            if (($firstName == "" && $lastName == "") || ($firstName != "" && $lastName != "")) {
                $query = "select * from eoi where FirstName like '$firstName%' and LastName like '$lastName%'";
            }

            // First name is filled but last name is empty.
            else if ($firstName != "" && $lastName == "") {
                $query = "select * from eoi where FirstName like '$firstName%'";
            }
            
            // First name is empty but last name is filled.s
            else {
                $query = "select * from eoi where LastName like '$lastName%'";
            }

            $result = mysqli_query($connection, $query);

             // Note: !$result is for when query is invalid.
             if (!$result || mysqli_num_rows($result) == 0) {
                echo "<p>There are no job applications for this position yet or this job does not exist.</p>";
            }
            else {
                returnTable($result);
            }
        }

        // The manager pressed the button to get all form applications.
        if (isset($_GET["get_all_applications"])) {
            getAllApplications();
        }
        if (isset($_GET["get_eois_given_ref"])) {
            getEOIsGivenRef();
        }
        if (isset($_GET["get_eois_given_name"])) {
            getEOIsGivenName();
        }
    ?>
</body>