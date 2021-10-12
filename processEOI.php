<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Job application form." />
    <meta name="keywords" content="apply, vacancies, job, career" />
    <meta name="author" content="Mitchell Anton" />
    <title>Form confirmation | Anton & Turing Technologies</title>
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

            if ($monthToday == $monthOfBirth) {
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

            $firstNumber = $postcode[0];
            switch($state) {
                case "VIC":
                    if ($firstNumber != "3" && $firstNumber != "8") {
                        $validPostcode = false;
                    }
                    break;
                case "NSW":
                    if ($firstNumber != "1" && $firstNumber != "2") {
                        $validPostcode = false;
                    }
                    break;
                case "QLD":
                    if ($firstNumber != "4" && $firstNumber != "9") {
                        $validPostcode = false;
                    }
                    break;
                case "NT":
                    if ($firstNumber != "0") {
                        $validPostcode = false;
                    }
                    break;
                case "WA":
                    if ($firstNumber != "6") {
                        $validPostcode = false;
                    }
                    break;
                case "SA":
                    if ($firstNumber != "5") {
                        $validPostcode = false;
                    }
                    break;
                case "TAS":
                    if ($firstNumber != "7") {
                        $validPostcode = false;
                    }
                    break;
                case "ACT":
                    if ($firstNumber != "0") {
                        $validPostcode = false;
                    }
                    break;
                }
            return $validPostcode;
        }

        function validateForm() {
            $valid = true;

            // Check job reference number.
            if (isset($_POST["reference_number"]) && $_POST["reference_number"] != "") {
                $jobReferenceNumber = sanitise_input($_POST["reference_number"]);
                $jobReferenceNumberRE = "/^[A-Z]{1}[0-9]{4}$/";

                if (!preg_match($jobReferenceNumberRE, $jobReferenceNumber)) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
            }

            // Check first name.
            if (isset($_POST["first_name"]) && $_POST["first_name"] != "") {
                $firstName = sanitise_input($_POST["first_name"]); 

                if (!preg_match("/^[A-Za-z]{1,20}$/", $firstName)) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
                header("location: apply.php");
            }

            // Check last name.
            if (isset($_POST["last_name"]) && $_POST["first_name"] != "") {
                $lastName = sanitise_input($_POST["last_name"]);

                if (!preg_match("/^[A-Za-z-]{1,20}$/", $lastName)) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
            }

            // Check age.
            if (isset($_POST["dob"]) && $_POST["dob"] != "") {
                $dateOfBirth = sanitise_input($_POST["dob"]);
                $dateOfBirthRE = "/^([0]?[1-9]|[12][0-9]|[3][01])\/([0]?[1-9]|[1][0-2])\/[0-9]{4}$/";

                if (!preg_match($dateOfBirthRE, $dateOfBirth)) {
                    $valid = false;
                }
                else {
                    $age = getAge($dateOfBirth);
                    if ($age < 15 || $age > 80) {
                        $valid = false;
                    }
                }
            }
            else {
                $valid = false;
            }

            // Check gender.
            if (!isset($_POST["gender"])) {
                $valid = false;
            }

            // Check street address.
            if (isset($_POST["street_address"]) && $_POST["street_address"] != "") {
                $streetAddress = sanitise_input($_POST["street_address"]);
                // Not needed because max length is 40 in html but whatever.
                if (strlen($streetAddress) > 40) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
            }

            // Check suburb.
            if (isset($_POST["suburb"]) && $_POST["suburb"] != "") {
                $suburb = sanitise_input($_POST["suburb"]);
                // Noy needed beause max length is 40 in html but whatever.
                if (strlen($suburb) > 40) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
            }

            // Check state.
            if (isset($_POST["state"]) && $_POST["state"] != "") {
                $state = sanitise_input($_POST["state"]);
            }
            else {
                $valid = false;
            }

            //Check postcode.
            if (isset($_POST["postcode"]) && $_POST["postcode"] != "") {
                $postcode = sanitise_input($_POST["postcode"]);
                if (!preg_match("/^[0-9]{4}$/", $postcode)) {
                    $valid = false;
                }
                // A state has also been entered.
                else if (isset($_POST["state"]) && $_POST["state"] != "") {
                    $state = sanitise_input($_POST["state"]);
                    if (!checkPostcode($postcode, $state)) {
                        $valid = false;
                    }
                }
            }
            else {
                $valid = false;
            }

            // Check email
            if (isset($_POST["email"]) && $_POST["email"] != "") {
                $email = sanitise_input($_POST["email"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
            }

            // Check phone number
            if (isset($_POST["phone_number"]) && $_POST["phone_number"] != "") {
                $phoneNumber = sanitise_input($_POST["phone_number"]);

                if (!preg_match("/^[0-9' ']{8,12}$/", $phoneNumber)) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
            }

            // Check if other skills textbox empty if other skills checkbox checked.
            if (isset($_POST["skills"])) {
                $skills = $_POST["skills"]; // Array of skill checkboxes ticked.

                // If other_skills checkbox was ticked, then check if other skills text box has something written.
                if (in_array("other_skills", $skills)) {
                    if (!isset($_POST["other_skills"]) || $_POST["other_skills"] == "") {
                        $valid = false;
                    }
                }
            }
            
            return $valid;
        }

        function sendDataToEOI() {
            require_once("settings.php");
            $connection = @mysqli_connect($host, $user, $pwd, $sql_db);

            if (!$connection) {
                echo "<p>Database connection failure.</p>";
            }

            // All of the data is valid. Thus, we can proceed putting data into database.
            else if (validateForm()) {
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
                        $skills .= $_POST["skills"][$i];
                        if ($i != count($_POST["skills"]) - 1) {
                            $skills .= ",";
                        }
                    }
                } 
                else {
                    $skills = null;
                }  

                $otherSkills = sanitise_input($_POST["other_skills"]);
                $status = "New";

                $query = "insert into $sqlTable values 
                ('$eoiNumber', '$jobReferenceNumber', '$firstName', '$lastName', '$streetAddress', '$suburb',
                '$state', '$postcode', '$email', '$phoneNumber', '$skills', '$otherSkills', '$status')";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    echo"<p>Oh no! Something went wrong!.</p>";
                }

                else {
                    echo "<p>Success!</p>";
                }
            }

            mysqli_close($connection);
        }

        validateForm();
        sendDataToEOI();
    ?>
</body>