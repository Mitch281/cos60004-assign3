<section id="main_menu">
    <a id="logo" href="index.html"><img src="styles/images/logo2.png" alt="Company Logo"></a>
    <nav>
        <a class="nav_bar" href="index.php" <?php echo ($page=="homePage")? "id='highlighted'" : "" ; ?> >Home Page</a> |
        <a class="nav_bar" href="jobs.php" <?php echo ($page=="jobDescriptions")? "id='highlighted'" : "" ; ?> >Job Descriptions</a> |
        <a class="nav_bar" href="apply.php" <?php echo ($page=="applyPage")? "id='highlighted'" : "" ; ?> >Apply for a Job</a> |
        <a class="nav_bar" href="about.php" <?php echo ($page=="aboutPage")? "id='highlighted'" : "" ; ?> >About Me</a> |
        <a class="nav_bar" href="enhancements.php" <?php echo ($page=="enhancements1Page")? "id='highlighted'" : "" ; ?> >Enhancements</a> |
        <a class="nav_bar" href="enhancements2.php" <?php echo ($page=="enhancements2Page")? "id='highlighted'" : "" ; ?> >Enhancements2</a>
    </nav>
</section>