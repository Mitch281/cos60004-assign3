<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Jobs available and their descriptions." />
    <meta name="keywords" content="hiring, jobs, vacant" />
    <meta name="author" content="Mitchell Anton" />
    <title>Job Descriptions | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
    <script src="scripts/jobs.js"></script>
    <!-- Description: This page displays jobs available and their descriptions. -->
    <!-- Author: Mitchell Anton -->
    <!-- Date: 12/10/2021 -->
    <!-- Validated: OK (12/10/2021) -->
</head>

<body>
    <?php
        $page = "jobDescriptions";
        include_once("menu.inc"); 
    ?>
    <aside>
        <a href=""><img src="styles/images/facebook.png" alt="Facebook icon" /></a>
        <a href=""><img src="styles/images/linkedin.png" alt="Linkedin icon" /></a>
        <a href=""><img src="styles/images/twitter.png" alt="Twitter icon" /></a>
        <a href=""><img src="styles/images/flickr.png" alt="Flickr icon" /></a>
        <p>Icons taken from <a
                href="https://www.land-of-web.com/freebies/icons/freebie-circle-flat-icons-retina-ready.html">Land of
                Web</a></p>
    </aside>
    <section id="first_job">
        <h1>Big Data Analyst</h1>
        <p><strong>Reference Number: </strong><span id="reference_number_0">B3748</span></p>
        <p><strong>Job Description:</strong> At Anton & Turing Technologies, we are proud to stand at the forefront of
            the big data revolution. Using the latest statistical and analytical tools, you will analyse and convert
            information into powerful quantitative tools to aid business decisions. The ideal candidate should be highly
            skilled in all aspects of data analytics.</p>
        <p><strong>Salary Range:</strong> 100,000 - 120,000</p>
        <p><strong>Key Responsibilities:</strong></p>
        <ol>
            <li>Work closely with project managers to understand and maintain focus on their analytical needs, including
                identifying critical metrics and KPIs, and deliver actionable insights to relevant decision-makers</li>
            <li>Proactively analyze data to answer key questions from stakeholders or out of self-initiated curiosity
                with an eye for what drives business performance, investigating and communicating areas for improvement
                in efficiency and productivity</li>
            <li>Create and maintain rich interactive visualizations through data interpretation and analysis integrating
                various reporting components from multiple data sources</li>
            <li>Define and implement data acquisition and integration logic, selecting appropriate combination of
                methods and tools within defined technology stack to ensure optimal scalability and performance of the
                solution</li>
            <li>Develop and maintain databases by acquiring data from primary and secondary sources, and build scripts
                that will make our data evaluation process more flexible or scalable across data sets</li>
        </ol>
        <p><strong>Essential Skills and Qualifications: </strong></p>
        <ul>
            <li>Bachelor’s degree in Mathematics, Computer Science, Economics, or Statistics</li>
            <li>3+ years experience mining data as a data analyst</li>
            <li>Strong SQL or Excel skills with the ability to learn other analytic tools</li>
        </ul>
        <p><strong>Preferred Skills and Qualifications: </strong></p>
        <ul>
            <li>Prior experience with database and model design and segmentation techniques</li>
            <li>Strong programming experience with frameworks including XML, Javascript, and ETL</li>
            <li>Practical experience in statistical analysis through the use of statistical packages including Excel,
                SPSS, and SAS</li>
        </ul>
        <a class="apply_button" href="apply.php">Apply</a>
        <p>Taken from<a
                href="https://business.linkedin.com/talent-solutions/resources/talent-engagement/job-descriptions/data-analyst">&nbsp;linkedin</a>
        </p>
    </section>
    <section id="second_job">
        <h1>Cybersecurity Specialist</h1>
        <p><strong>Reference Number:</strong><span id="reference_number_1"> C4729</span></p>
        <p><strong>Job Description:</strong>At Anton & Turing Technologies, we value our cybersecurity team as the first
            - and last- line of defense against protecting our sensitive data from cyber attack. We're seeking an
            experienced
            and vigilant cybersecurity specialist who can proactively prevent breaches of all sizes, understand when
            they occur,
            and take immediate steps to remediate them.</p>
        <p><strong>Salary Range:</strong>140,000 - 180,000</p>
        <p><strong>Key Responsibilities:</strong>
        </p>
        <ol>
            <li>Collect data on current security measures for risk analysis and write regular systems-status reports
            </li>
            <li>Constantly monitor for attack and run appropriate defensive protocols if breaches occur</li>
            <li>Conduct vulnerability testing to identify weaknesses and collaborate with cybersecurity team to update
                defensive protocols as necessary</li>
            <li>Configure anti-virus systems, firewalls, data centers and software updates with a security-first mindset
            </li>
            <li>Grant credentials to authorized users, monitor access-related activities and check for unregistered
                information changes</li>
            <li>Help lead employee training against phishing and other forms of cyberattack</li>
        </ol>
        <p><strong>Essential Skills and Qualifications:</strong></p>
        <ul>
            <li>Degree in information systems, information technology or related field</li>
            <li>3-5 years experience in cybersecurity at a mid- to large-size business</li>
            <li>Strong knowledge of IT, including hardware software and networks</li>
            <li>A meticulous eye for detail and ability to multitask in a fast-paced environmen</li>
        </ul>
        <p><strong>Preferred Skills and Qualifications</strong></p>
        <ul>
            <li>Excellent verbal and written communication skills</li>
            <li>Strong critical thinking, problem-solving, logic, and forensics skills</li>
            <li>Ability to work successfully in both individual and team settings</li>
            <li>Ability to think like a hacker in order to stay one step ahead</li>
        </ul>
        <a class="apply_button" href="apply.php">Apply</a>
        <p>Taken from<a
                href=https://business.linkedin.com/talent-solutions/resources/talent-engagement/job-descriptions/cybersecurity-specialist>&nbsp;linkedin</a>
        </p>
    </section>
    <hr />
    <?php
        include_once("footer.inc");
    ?>
</body>

</html>