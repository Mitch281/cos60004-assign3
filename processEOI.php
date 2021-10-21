<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Job application form." />
    <meta name="keywords" content="apply, vacancies, job, career" />
    <meta name="author" content="Mitchell Anton" />
    <title>Form confirmation | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
</head>

<body>
    <?php
        function sanitise_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function getAge($dateOfBirth) {
            $dayToday = intval(date("d")); // dd format
            $monthToday = intval(date("m")); // mm format
            $yearToday = intval(date("Y"));  // yyyy format

            $birthArray = explode("/", $dateOfBirth);
            $dayOfBirth = intval($birthArray[0]);
            $monthOfBirth = intval($birthArray[1]);
            $yearOfBirth = intval($birthArray[2]);

            if ($monthToday === $monthOfBirth) {
                // Birthday this year has happened.
                if ($dayOfBirth <= $dayToday) {
                    $age = $yearToday - $yearOfBirth;
                }
        
                // Birthday this year has not happened yet.
                else if ($dayOfBirth > $dayToday) {
                    $age = $yearToday - $yearOfBirth - 1;
                }
            }
        
            // Birthday this year has happened.
            else if ($monthOfBirth <= $monthToday) {
                $age = $yearToday - $yearOfBirth;
            }
        
            // Birthday this year has not happened yet.
            else if ($monthOfBirth > $monthToday) {
                $age = $yearToday - $yearOfBirth - 1;
            }
            return $age;
        }

        // Checks if the postcode entered matches the corresponding state selected.
        function checkPostcode($postcode, $state) {
            $validPostcode = true;
            $errorMessage = "";

            $firstNumber = $postcode[0];
            switch($state) {
                case "VIC":
                    if ($firstNumber !== "3" && $firstNumber !== "8") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in Victoria start with either a 3 or an 8!</p>\n";
                    }
                    break;
                case "NSW":
                    if ($firstNumber !== "1" && $firstNumber !== "2") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in New South Wales start with either a 1 or a 7!</p>\n";
                    }
                    break;
                case "QLD":
                    if ($firstNumber !== "4" && $firstNumber !== "9") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in Queensland start with either a 4 or a 9!</p>\n";
                    }
                    break;
                case "NT":
                    if ($firstNumber !== "0") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in Northen Territory start with a 0!</p>\n";
                    }
                    break;
                case "WA":
                    if ($firstNumber !== "6") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in Western Australia start with a 6!</p>\n";
                    }
                    break;
                case "SA":
                    if ($firstNumber !== "5") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in South Australia start with a 5!</p>\n";
                    }
                    break;
                case "TAS":
                    if ($firstNumber !== "7") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in Tasmania start with a 7!</p>\n";
                    }
                    break;
                case "ACT":
                    if ($firstNumber !== "0") {
                        $validPostcode = false;
                        $errorMessage .= "<p>The postcode of suburbs/towns in Australian Capital Territory start with a 0!</p>\n";
                    }
                    break;
                }
            return $errorMessage;
        }

        function validateForm() {
            $valid = true;

            // Check job reference number.
            if (isset($_POST["reference_number"]) && $_POST["reference_number"] !== "") {
                $jobReferenceNumber = sanitise_input($_POST["reference_number"]);
                $jobReferenceNumberRE = "/^[a-zA-Z0-9]{5}$/";

                if (!preg_match($jobReferenceNumberRE, $jobReferenceNumber)) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
                header("location: apply.php");
            }

            // Check first name.
            if (isset($_POST["first_name"]) && $_POST["first_name"] !== "") {
                $firstName = sanitise_input($_POST["first_name"]); 

                if (!preg_match("/^[A-Za-z]{1,20}$/", $firstName)) {
                    $valid = false;
                    echo "<p>Your first name can only contain alpha characters and be of length 1 to 20 characters!</p>";
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter a first name.</p>\n";
            }

            // Check last name.
            if (isset($_POST["last_name"]) && $_POST["last_name"] !== "") {
                $lastName = sanitise_input($_POST["last_name"]);

                if (!preg_match("/^[A-Za-z]{1,20}$/", $lastName)) {
                    $valid = false;
                    echo "<p>Your last name can only contain alpha characters and be of length 1 to 20 characters!</p>";
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter a last name.</p>\n";
            }

            // Check age.
            if (isset($_POST["dob"]) && $_POST["dob"] !== "") {
                $dateOfBirth = sanitise_input($_POST["dob"]);
                $dateOfBirthRE = "/^([0]?[1-9]|[12][0-9]|[3][01])\/([0]?[1-9]|[1][0-2])\/[0-9]{4}$/";

                if (!preg_match($dateOfBirthRE, $dateOfBirth)) {
                    $valid = false;
                    echo "<p>Your date of birth must be in the format dd/mm/yy.</p>\n";
                }
                else {
                    $age = getAge($dateOfBirth);
                    if ($age < 15 || $age > 80) {
                        $valid = false;
                        echo "<p>You must be between the ages of 15 and 80 years old to apply for a job!</p>\n";
                    }
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter a date of birth.</p>\n";
            }

            // Check gender.
            if (!isset($_POST["gender"])) {
                $valid = false;
                echo "<p>Please select a gender!</p>\n";
            }

            // Check street address.
            if (isset($_POST["street_address"]) && $_POST["street_address"] !== "") {
                $streetAddress = sanitise_input($_POST["street_address"]);
                // Not needed because max length is 40 in html but whatever.
                if (strlen($streetAddress) > 40) {
                    $valid = false;
                    echo "<p>Your street address must be less than or equal to 40 characters!</p>\n";
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter a street address.</p>\n";
            }

            // Check suburb.
            if (isset($_POST["suburb"]) && $_POST["suburb"] !== "") {
                $suburb = sanitise_input($_POST["suburb"]);
                // Noy needed beause max length is 40 in html but whatever.
                if (strlen($suburb) > 40) {
                    $valid = false;
                    echo "<p>Your suburb must be less than or equal to 40 characters!</p>\n";
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter a suburb.</p>\n";
            }

            // Check state.
            if (isset($_POST["state"]) && $_POST["state"] !== "") {
                $state = sanitise_input($_POST["state"]);
            }
            else {
                $valid = false;
                echo "<p>Please select a state.</p>\n";
            }

            //Check postcode.
            if (isset($_POST["postcode"]) && $_POST["postcode"] !== "") {
                $postcode = sanitise_input($_POST["postcode"]);
                if (!preg_match("/^[0-9]{4}$/", $postcode)) {
                    $valid = false;
                    echo "<p>Your postcode must be 4 digits!</p>\n";
                }
                // A state has also been entered.
                else if (isset($_POST["state"]) && $_POST["state"] !== "") {
                    $state = sanitise_input($_POST["state"]);
                    $postcodeErrorMessage = checkPostcode($postcode, $state);
                    if ($postcodeErrorMessage != "") {
                        $valid = false;
                        echo $postcodeErrorMessage;
                    }
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter a postcode.</p>\n";
            }

            // Check email
            if (isset($_POST["email"]) && $_POST["email"] !== "") {
                $email = sanitise_input($_POST["email"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $valid = false;
                    echo "<p>Please enter your email in the appropriate format.</p>\n";
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter your email.<p>\n";
            }

            // Check phone number
            if (isset($_POST["phone_number"]) && $_POST["phone_number"] !== "") {
                $phoneNumber = sanitise_input($_POST["phone_number"]);

                if (!preg_match("/^[0-9' ']{8,12}$/", $phoneNumber)) {
                    $valid = false;
                    echo "<p>Your phone number must only contain digits and spaces, and must be between 8 and 12 characters.</p>\n";
                }
            }
            else {
                $valid = false;
                echo "<p>Please enter your phone number!</p>\n";
            }

            // Check if other skills textbox empty if other skills checkbox checked.
            if (isset($_POST["skills"])) {
                $skills = $_POST["skills"]; // Array of skill checkboxes ticked.

                // If other_skills checkbox was ticked, then check if other skills text box has something written.
                if (in_array("other_skills", $skills)) {
                    if (!isset($_POST["other_skills"]) || $_POST["other_skills"] === "") {
                        $valid = false;
                        echo "<p>You have selected that you have other skills. Please specify these skills in the textbox below.</p>\n";
                    }
                }
            }
            
            return $valid;
        }

        function sendDataToEOI() {
            require_once("settings.php");
            $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");

            // All of the data is valid and our connection is working. Thus, we can proceed putting data into database.
            if (validateForm()) {
                $sqlTable = "eoi";

                $eoiNumber = null;
                $jobReferenceNumber = sanitise_input($_POST["reference_number"]);
                $firstName = sanitise_input($_POST["first_name"]);
                $lastName = sanitise_input($_POST["last_name"]);
                $streetAddress = sanitise_input($_POST["street_address"]);
                $suburb = sanitise_input($_POST["suburb"]);
                $state = $_POST["state"];
                $postcode = sanitise_input($_POST["postcode"]);
                $email = sanitise_input($_POST["email"]);
                $phoneNumber = sanitise_input($_POST["phone_number"]);

                // We still need to check this because other skills is not compulsory for the form to be validated.
                if (isset($_POST["skills"])) {
                    $skills = "";
                    // Put the skills checked into a string $skills.
                    for ($i = 0; $i < count($_POST["skills"]); $i++) {
                        $skills .= sanitise_input($_POST["skills"][$i]);
                        if ($i != count($_POST["skills"]) - 1) {
                            $skills .= ",";
                        }
                    }
                } 
                else {
                    $skills = null;
                }  

                // Note: If nothing is entered in other skills, then it is an empty string (not null).
                $otherSkills = sanitise_input($_POST["other_skills"]);
                $status = "New";

                // Create eoi table if it is not already created
                if (!mysqli_query($connection, "describe $sqlTable")) {
                    $createQuery = "create table eoi (
                        eoiNumber int not null auto_increment primary key,
                        JobReferenceNumber char(5) not null,
                        FirstName varchar(20) not null,
                        LastName varchar(20) not null,
                        StreetAddress varchar(40) not null,
                        Suburb varchar(40) not null,
                        StateLocation varchar(3) not null,
                        Postcode char(4) not null,
                        EmailAddress varchar(30) not null,
                        PhoneNumber varchar(12) not null,
                        Skills varchar(100),
                        OtherSkills varchar(1000),
                        Status varchar(7) not null default 'New'
                    )";

                    $result = mysqli_query($connection, $createQuery);

                    if (!$result) {
                        echo"<p>Oh no! Something went wrong!.</p>";
                    }
                }

                $query = "insert into $sqlTable values 
                ('$eoiNumber', '$jobReferenceNumber', '$firstName', '$lastName', '$streetAddress', '$suburb',
                '$state', '$postcode', '$email', '$phoneNumber', '$skills', '$otherSkills', '$status')";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    echo"<p>Oh no! Something went wrong!.</p>";
                }

                // Display confirmation message.
                else {
                    echo "<h1>Job Application Confirmation</h1>";
                    $currentEoiNumber = mysqli_insert_id($connection); // Last entered eoiNumber.
                    echo "<h2>Congratulations, your job application was received. Your expression of interest number is
                    $currentEoiNumber.</h2>";
                }

                mysqli_close($connection);
            }
        }

        sendDataToEOI();
    ?>
</body>