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
        require_once("settings.php");
        $connection = mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
        $sqlTable = "eoi";
        function getAllApplications() {
            global $connection;
            global $sqlTable;
            $query = "select * from eoi";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) == 0) {
                echo "<p>There are no job applications yet.</p>";
            }
            else {
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
                    . "<th>Statusth>\n";

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
        }

        // The manager pressed the button to get all form applications.
        if (isset($_GET["get_all_applications"])) {
            getAllApplications();
        }
    ?>
</body>