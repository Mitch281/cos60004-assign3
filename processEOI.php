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
        }

        validateForm();
    ?>
</body>