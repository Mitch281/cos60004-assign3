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

        function validateForm() {
            $valid = true;

            if (isset($_POST["reference_number"])) {
                $jobReferenceNumber = $_POST["reference_number"];
                $jobReferenceNumber = sanitise_input($jobReferenceNumber);
            }
            else {
                $valid = false;
                echo "<p>Please enter a job reference number.</p>";
            }

            if (isset($_POST["first_name"]) && $_POST["first_name"] != "") {
                $firstName = $_POST["first_name"];
                $firstName = sanitise_input($firstName); 

                if (!preg_match("/^[A-Za-z]{1,20}$/", $firstName)) {
                    $valid = false;
                    echo "<p>first name error.</p>";
                }
            }
            else {
                echo "<p>Please enter a first name.</p>";
                $valid = false;
            }

            if (isset($_POST["last_name"]) && $_POST["first_name"] != "") {
                $lastName = $_POST["last_name"];
                $lastName = sanitise_input($lastName);

                if (!preg_match("/^[A-Za-z]{1,20}$/", $lastName)) {
                    $valid = false;
                    echo "<p>last name error</p>";
                }
            }
            else {
                $valid = false;
                echo "<p>no last name.</p>";
            }

            if (isset($_POST["dob"]) && $_POST["dob"] != "") {
                $dateOfBirth = $_POST["dob"];
                $dateOfBirth = sanitise_input($dateOfBirth);
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
        }

        validateForm();
    ?>
</body>