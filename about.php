<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="About me page" />
    <meta name="keywords" content="Anton & Turing Technologies, jobs, hire" />
    <meta name="author" content="Mitchell Anton" />
    <title>About me | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
    <!-- Description: About me page -->
    <!-- Author: Mitchell Anton -->
    <!-- Date: 04/10/2021 -->
    <!-- Validated: OK (04/10/2021) -->
</head>

<body>
    <?php
        $page = "aboutPage";
        include_once("menu.inc");
    ?>
    <dl>
        <dt>My name:</dt>
        <dd>Mitchell Anton</dd>
        <dt>Student Number:</dt>
        <dd>103750586</dd>
        <dt>Tutor's name:</dt>
        <dd>Bo Li</dd>
        <dt>My course:</dt>
        <dd>Masters of Information Technology</dd>
    </dl>
    <figure id="photo_of_me">
        <img src="styles/images/me.jpg" alt="A photo of me!">
    </figure>

    <table id="timetable">
        <caption>My University Timetable</caption>
        <thead>
            <tr>
                <th></th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>8:00 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>8:30 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>9:00 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>9:30 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>10:00 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>10:30 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="filled top">COS60010 Workshop</td>
            </tr>
            <tr>
                <th>11:00 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="filled"></td>
            </tr>
            <tr>
                <th>11:30 am</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="filled"></td>
            </tr>
            <tr>
                <th>12:00 pm</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="filled"></td>
            </tr>
            <tr>
                <th>12:30 pm</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="filled bottom"></td>
            </tr>
            <tr>
                <th>1:00 pm</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>1:30 pm</th>
                <td></td>
                <td></td>
                <td class="filled top">COS80022 Tutorial</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>2:00 pm</th>
                <td class="filled top">COS60004 Live Online</td>
                <td></td>
                <td class="filled"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>2:30 pm</th>
                <td class="filled"></td>
                <td></td>
                <td class="filled bottom"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>3:00 pm</th>
                <td class="filled bottom"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>3:30 pm</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>4:00 pm</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>4:30 pm</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>5:00 pm</th>
                <td class="filled top">COS60010 Seminar</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>5:30 pm</th>
                <td class="filled"></td>
                <td class="filled top">COS60009 Tutorial</td>
                <td></td>
                <td class="filled top">COS60004 Tutorial</td>
                <td></td>
            </tr>
            <tr>
                <th>6:00 pm</th>
                <td class="filled bottom"></td>
                <td class="filled"></td>
                <td></td>
                <td class="filled"></td>
                <td></td>
            </tr>
            <tr>
                <th>6:30 pm</th>
                <td></td>
                <td class="filled bottom"></td>
                <td></td>
                <td class="filled"></td>
                <td></td>
            </tr>
            <tr>
                <th>7:00 pm</th>
                <td class="filled top">COS60009 Live Online</td>
                <td></td>
                <td></td>
                <td class="filled"></td>
                <td></td>
            </tr>
            <tr>
                <th>7:30 pm</th>
                <td class="filled"></td>
                <td></td>
                <td></td>
                <td class="filled bottom"></td>
                <td></td>
            </tr>
            <tr>
                <th>8:00 pm</th>
                <td class="filled bottom"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <address id="contact_me">
        <a href="mailto:103750586@student.swin.edu.au">Contact me</a>
    </address>
    <hr />
    <?php
        include_once("footer.inc");
    ?>
</body>