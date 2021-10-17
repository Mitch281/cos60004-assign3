<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Job application form." />
    <meta name="keywords" content="" />
    <meta name="author" content="Mitchell Anton" />
    <title>Manager Page | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
</head>

<body>
    <?php
        $page = "managerPage";
        include_once("menu.inc"); 
    ?>
    <form id="get_all_applications" method="get" action="process-manager-request.php">
        <input class="form_action" type="submit" name="get_all_applications" value="Get All Applications">
    </form>
    <hr />
    <?php
        include_once("footer.inc");
    ?>
</body>