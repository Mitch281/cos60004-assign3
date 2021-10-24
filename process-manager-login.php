<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Manager login" />
    <meta name="keywords" content="" />
    <meta name="author" content="Mitchell Anton" />
    <title>Login Failed</title>
    <link href="styles/style.css" rel="stylesheet" />
    <!-- Description: This page gets the username and password entered by the manager, and checks if the username and 
    password is valid. -->
    <!-- Author: Mitchell Anton -->
    <!-- Date: 21/10/2021 -->
    <!-- Validated: OK (21/10/2021) -->
</head>

<body>
    <?php
        require_once("settings.php");
        $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
        $sqlTable = "ManagerLogin";
        
        // Boolean to check if the username and password entered is valid.
        $valid = false;

        $username = $_GET["username"];
        $password = $_GET["password"];

        // If the username exists, then this shall only return one username.
        $checkExistQuery = "select * from $sqlTable where username = '$username'";

        $result = mysqli_query($connection, $checkExistQuery);

        // Query successful and username exists.
        if ($result && mysqli_num_rows($result) != 0) {
            $passwordQuery = "select * from $sqlTable where password = '$password'";
            $result = mysqli_query($connection, $passwordQuery);
            while ($row = mysqli_fetch_assoc($result)) {
                // The candidate username is any username where the password matches the password the user has entered.
                // This is then compared to the username entered until there is a match.
                $candidateUsername = $row["Username"];
                if ($username === $candidateUsername) {
                    $valid = true;
                    break;
                }
            }
            mysqli_free_result($result);
        }

        if ($valid) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            header("location: manage.php");
        }
        else {
            echo "<p>Invalid username and/or password</p>";
        }
        mysqli_close($connection);
    ?>
</body>