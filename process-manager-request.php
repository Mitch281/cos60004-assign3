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
        // TODO: Add relevant "@" annotations.
        // TODO: HTML VALIDATION.
        require_once("settings.php");
        $connection = mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
        $sqlTable = "eoi";

        function sanitise_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function returnTable($result) {
            echo "<table id='manager_request_table'>\n";

            // Table headers
            echo "<thead>\n"
                . "<tr>\n"
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
                . "<th>Status</th>\n"
                . "</tr>\n"
                . "</thead>\n";

            // Table content.
            echo "<tbody>\n";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>\n"
                    . "<td>" . $row["eoiNumber"] . "</td>\n"
                    . "<td>" . $row["JobReferenceNumber"] . "</td>\n"
                    . "<td>" . $row["FirstName"] . "</td>\n"
                    . "<td>" . $row["LastName"] . "</td>\n"
                    . "<td>" . $row["StreetAddress"] . "</td>\n"
                    . "<td>" . $row["Suburb"] . "</td>\n"
                    . "<td>" . $row["StateLocation"] . "</td>\n"
                    . "<td>" . $row["Postcode"] . "</td>\n"
                    . "<td>" . $row["EmailAddress"] . "</td>\n"
                    . "<td>" . $row["PhoneNumber"] . "</td>\n"
                    . "<td>" . $row["Skills"] . "</td>\n"
                    . "<td>" . $row["OtherSkills"] . "</td>\n"
                    . "<td>" . $row["Status"] . "</td>\n";
            }
            echo "</tbody>\n";
            echo "</table>\n";
            mysqli_free_result($result);
        }

        function getAllApplications() {
            global $connection;
            global $sqlTable;
            $sortRequest = sanitise_input($_GET["manager_sort_request"]);


            if ($sortRequest === "none") {
                $query = "select * from eoi";
            }
            else {
                $query = "select * from eoi order by $sortRequest";

                // If first name or last name is picked, then we want to sort by first name first then last name second
                // or last name first then first name second respectively.

                if ($sortRequest === "FirstName") {
                    $query .= ", LastName";
                }
                else if ($sortRequest === "LastName") {
                    $query .= ", FirstName";
                }
            }

            $result = mysqli_query($connection, $query);

            if (!$result || mysqli_num_rows($result) === 0) {
                echo "<p>There are no job applications yet.</p>";
            }
            else {
                returnTable($result);
            }
            mysqli_close($connection);
        }

        // Get all of the eoi's corresponding to the entered job reference number.
        function getEOIsGivenRef() {
            global $connection;
            global $sqlTable;
            $jobReferenceNumber = sanitise_input($_GET["reference_number"]);
            $sortRequest = sanitise_input($_GET["manager_sort_request"]);

            if ($sortRequest === "none") {
                // DON'T FORGET SINGLE QUOTATION MARKS!
                $query = "select * from eoi where JobReferenceNumber = '$jobReferenceNumber'";
            }
            else {
                $query = "select * from eoi where JobReferenceNumber = '$jobReferenceNumber' order by $sortRequest";

                if ($sortRequest === "FirstName") {
                    $query .= ", LastName";
                }

                else if ($sortRequest === "LastName") {
                    $query .= ", FirstName";
                }
            }

            $result = mysqli_query($connection, $query);

            // Note: !$result is for when query is invalid.
            if (!$result || mysqli_num_rows($result) === 0) {
                echo "<p>There are no job applications for this position yet or this job does not exist.</p>";
            }
            else {
                returnTable($result);
            }
            mysqli_close($connection);
        }

        function getEOIsGivenName() {
            global $connection;
            global $sqlTable;

            $sortRequest = sanitise_input($_GET["manager_sort_request"]);
            $firstName = sanitise_input($_GET["first_name"]);
            $lastName = sanitise_input($_GET["last_name"]);

            if ($firstName === "" && $lastName === "") {
                echo "<p>Please enter a name.</p>";
                $query = "";
            }

            else {
                
                // Both first names and last names empty or both first names and last names filled.
                if ($firstName !== "" && $lastName !== "") {
                    $query = "select * from eoi where FirstName like '$firstName%' and LastName like '$lastName%'";
                }

                // First name is filled but last name is empty.
                else if ($firstName !== "" && $lastName === "") {
                    $query = "select * from eoi where FirstName like '$firstName%'";
                }

                // First name is empty but last name is filled.s
                else {
                    $query = "select * from eoi where LastName like '$lastName%'";
                }

                if ($sortRequest !== "none") {
                    $query .= " order by $sortRequest";

                    if ($sortRequest === "FirstName") {
                        $query .= ", LastName";
                    }

                    if ($sortRequest === "LastName") {
                        $query .= ", FirstName";
                    }
                }

                $result = mysqli_query($connection, $query);

                 // Note: !$result is for when query is invalid.
                 if (!$result || mysqli_num_rows($result) === 0) {
                    echo "<p>There are no job applications under this name yet.</p>";
                }
                else {
                    returnTable($result);
                }
            }
            mysqli_close($connection);
        }

        function deleteEOIsGivenRef() {
            global $connection;
            global $sqlTable;

            $jobReferenceNumber = sanitise_input($_POST["job_reference_number"]);

            $query = "delete from eoi where JobReferenceNumber = '$jobReferenceNumber'";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                echo "<p>Oh no! Something went wrong!</p>";
            }
            // Note: jobReferenceNumber is NOT case sensitive in mysql. In other words, deleting b4729 is same as 
            // deleting B4729.
            else {
                if (mysqli_affected_rows($connection) === 0) {
                    echo "<p>There were no applications deleted. Either the job does not exist or there were no
                    applications for the job.</p>";
                }
                else {
                    echo "<p>" . mysqli_affected_rows($connection) . " jobs were successfully deleted.</p>";
                }
            }
            mysqli_close($connection);
        }

        function changeStatusGivenEOINumber() {
            global $connection;
            global $sqlTable;

            $eoiNumber = sanitise_input($_POST["eoi_number"]);
            $status = sanitise_input($_POST["status"]);

            // Query to check if the eoiNumber exists in the database.
            $checkExistQuery = "select * from eoi where eoiNumber = '$eoiNumber'";
            $checkExist = mysqli_query($connection, $checkExistQuery);

            // The whole row of the select * from eoi number query.
            $result = mysqli_query($connection, $checkExistQuery);
            $row = mysqli_fetch_assoc($result);

            if ($status !== "New" && $status !== "Current" && $status !== "Final") {
                echo "<p>You cannot change a status to this value!</p>";
            }
            // The eoiNumber does not exist.
            else if (mysqli_num_rows($checkExist) === 0) {
                echo "<p>This job application number does not exist!</p>.";
            }
            else if ($row["Status"] == $status) {
                echo "<p>The status is already set to $status!</p>";
            }
            else {
                $query = "update eoi set Status = '$status' where eoiNumber = '$eoiNumber'";
                $result = mysqli_query($connection, $query);

                if (!$result) {
                    echo "<p>Oh no! Something went wrong.!</p>";
                }
                else {
                    echo "<p>Status succesfully changed for job application $eoiNumber";
                }
            }
            mysqli_close($connection);
        }

        // The manager pressed the button to get all form applications.
        if (isset($_GET["get_all_applications"])) {
            getAllApplications();
        }
        
        // The manager pressed the button to get eoi's after giving a job reference number.
        if (isset($_GET["get_eois_given_ref"])) {
            getEOIsGivenRef();
        }

        // The manager pressed the button to get eoi's after giving first name and/or last name.
        if (isset($_GET["get_eois_given_name"])) {
            getEOIsGivenName();
        }

        // The manager pressed the button to delete job applications after giving the job reference number.
        if (isset($_POST["delete_eois_given_ref"])) {
            deleteEOIsGivenRef();
        }

        // The manager wants to change status of a certain job application.
        if (isset($_POST["change_status_given_eoi_number"])) {
            changeStatusGivenEOINumber();
        }
    ?>
</body>