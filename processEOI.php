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
            }
            else {
                $valid = false;
                echo "<p>Please enter a job reference number.</p>";
            }

            // Check first name.
            if (isset($_POST["first_name"]) && $_POST["first_name"] != "") {
                $firstName = sanitise_input($_POST["first_name"]); 

                if (!preg_match("/^[A-Za-z]{1,20}$/", $firstName)) {
                    $valid = false;
                    echo "<p>first name error.</p>";
                }
            }
            else {
                echo "<p>Please enter a first name.</p>";
                $valid = false;
            }

            // Check last name.
            if (isset($_POST["last_name"]) && $_POST["first_name"] != "") {
                $lastName = sanitise_input($_POST["last_name"]);

                if (!preg_match("/^[A-Za-z]{1,20}$/", $lastName)) {
                    $valid = false;
                    echo "<p>last name error</p>";
                }
            }
            else {
                $valid = false;
                echo "<p>no last name.</p>";
            }

            // Check age.
            if (isset($_POST["dob"]) && $_POST["dob"] != "") {
                $dateOfBirth = sanitise_input($_POST["dob"]);
                $dateOfBirthRE = "/^([0]?[1-9]|[12][0-9]|[3][01])\/([0]?[1-9]|[1][0-2])\/[0-9]{4}$/";

                if (!preg_match($dateOfBirthRE, $dateOfBirth)) {
                    $valid = false;
                    echo "<p>Wrong dob format.</p>";
                }
                else {
                    $age = getAge($dateOfBirth);
                    if ($age < 15 || $age > 80) {
                        $valid = false;
                        echo"<p>Age not in range.</p>";
                    }
                }
            }
            else {
                $valid = false;
                echo"<p>enter age.</p>";
            }

            // Check gender.
            if (!isset($_POST["gender"])) {
                $valid = false;
                echo"<p>Select gender.</p>";
            }

            // Check street address.
            if (isset($_POST["street_address"]) && $_POST["street_address"] != "") {
                $streetAddress = sanitise_input($_POST["street_address"]);
                // Not needed because max length is 40 in html but whatever.
                if (strlen($streetAddress) > 40) {
                    $valid = false;
                    echo "<p>Street address too long.</p>";
                }
            }
            else {
                $valid = false;
                echo "<p> Enter street address</p>";
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
                echo"<p>Enter suburb</p>";
            }

            // Check state.
            if (isset($_POST["state"]) && $_POST["state"] != "") {
                $state = sanitise_input($_POST["state"]);
            }
            else {
                $valid = false;
                echo"<p>select state</p>";
            }

            //Check postcode.
            if (isset($_POST["postcode"]) && $_POST["postcode"] != "") {
                $postcode = sanitise_input($_POST["postcode"]);
                if (!preg_match("/^[0-9]{4}$/", $postcode)) {
                    $valid = false;
                    echo"<p>postcode in wrong format.</p>";
                }
                // A state has also been entered.
                else if (isset($_POST["state"]) && $_POST["state"] != "") {
                    $state = sanitise_input($_POST["state"]);
                    if (!checkPostcode($postcode, $state)) {
                        $valid = false;
                        echo"<p>postcode and state do not match</p>";
                    }
                }
            }
            else {
                $valid = false;
                echo "<p> enter postcode </p>";
            }

            // Check email
            if (isset($_POST["email"]) && $_POST["email"] != "") {
                $email = sanitise_input($_POST["email"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $valid = false;
                    echo"<p>email in wrong format.</p>";
                }
            }
            else {
                $valid = false;
                echo"<p>enter email</p>";
            }

            // Check if other skills textbox empty if other skills checkbox checked.
            if (isset($_POST["skills"])) {
                $skills = $_POST["skills"]; // Array of skill checkboxes ticked.

                // If other_skills checkbox was ticked, then check if other skills text box has something written.
                if (in_array("other_skills", $skills)) {
                    if (isset($_POST["other_skills"]) && $_POST["other_skills"] != "") {
                        $otherSkills = sanitise_input($_POST["other_skills"]);
                    }
                    else {
                        $valid = false;
                        echo"<p>enter stuff in textbox.</p>";
                    }
                }
            }
        }

        validateForm();
    ?>
</body>