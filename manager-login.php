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
    <title>Manager Login | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
</head>
<!--TODO: Check if we still need to name this page manager-login.php instead of manager-login.html -->
<body>
    <?php
        // User already logged in.
        if (isset($_SESSION["username"])) {
            header("location: manage.php");
        }
    ?>
    <section id="manager_login">
        <h1>Login</h1>
        <form method="get" action="process-manager-login.php">
            <p><label for="username">Username</label>
            <input type="text" name="username" id="username" required="required" />
            </p>

            <p><label for="password">Password</label>
            <input type="password" name="password" id="password" required="required" />
            </p>

            <input class="form_action" type="submit" value="Login">
        </form>
    </section>
</body>