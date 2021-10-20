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
<body>
    <?php
    $page = "";
        include_once("menu.inc");
        // User already logged in.
        if (isset($_SESSION["username"])) {
            header("location: manage.php");
        }
    ?>
    <p>Username: Bo Li Password: f$hAVer42</p>
    <section id="manager_login">
        <h1>Manager Login</h1>
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