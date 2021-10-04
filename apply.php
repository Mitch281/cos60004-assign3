<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Job application form." />
    <meta name="keywords" content="apply, vacancies, job, career" />
    <meta name="author" content="Mitchell Anton" />
    <title>Job Application Form | Anton & Turing Technologies</title>
    <link href="styles/style.css" rel="stylesheet" />
    <script src="scripts/apply.js"></script>
    <script src="scripts/enhancements.js"></script>
</head>

<body>
    <?php
        $page = "applyPage";
        include_once("menu.inc"); 
    ?>
    <h2 id="form_header">Application Form</h2>
    <p id="timer"></p>
    <form id="job_form" method="post" action="https://mercury.swin.edu.au/it000000/formtest.php" >
        <p><label for="reference_number">Job Reference Number</label>
            <input type="text" name="reference_number" id="reference_number" required="required" pattern="[^' ']{5}" />
        </p>
        <p><label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" required="required" pattern="[A-Za-z^' ']{1,20}" />
        </p>
        <p><label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" required="required" pattern="[A-Za-z^' ']{1,20}" />
        </p>
        <p><label for="dob">Date of Birth</label>
            <input type="text" name="dob" id="dob" required="required" placeholder="dd/mm/yyyy" />
            <span id="empty_dob" class="error_message"></span>
            <span id="invalid_dob" class="error_message"></span>
            <span id="invalid_age" class="error_message"></span>
        </p>
        <fieldset id="gender">
            <legend>Gender</legend>
            <label><input type="radio" name="gender" value="Male" id="male" checked>Male</label>
            <label><input type="radio" name="gender" value="Female" id="female">Female</label>
        </fieldset>
        <p><label for="street_address">Street Address</label>
            <input type="text" name="street_address" id="street_address" required="required" maxlength=40 minlength=1 />
        </p>
        <p><label for="suburb">Suburb/Town</label>
            <input type="text" name="suburb" id="suburb" required="required" maxlength=40 minlength=1 />
        </p>
        <p><label for="state">State</label>
            <select name="state" id="state" required="required">
                <option value="">Please Select</option>
                <option value="VIC">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="TAS">TAS</option>
                <option value="ACT">ACT</option>
            </select>
        </p>
        <p><label for="postcode">Postcode</label>
            <input type="text" name="postcode" id="postcode" required="required" pattern=[0-9]{4}>
            <span id="empty_postcode" class="error_message"></span>
            <span id="invalid_postcode" class="error_message"></span>
        </p>
        <p><label for="email">Email Address</label>
            <!-- regex taken from https://www.w3.org/ -->
            <input type="text" name="email" id="email" required="required" 
            pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*"/>
        </p>
        <fieldset id="skills">
            <legend>Skills</legend>
            <label><input type="checkbox" name="skills[]" value="technical_writing" />Technical Writing</label>
            <label><input type="checkbox" name="skills[]" value="leadership" />Leadership</label>
            <label><input type="checkbox" name="skills[]" value="problem_solving" />Problem Solving</label>
            <label><input type="checkbox" name="skills[]" value="innovative_thinking" />Innovative Thinking</label>
            <label><input type="checkbox" name="skills[]" value="other_skills" />Other Skills</label>
        </fieldset>
        <!-- Keep textarea tags on same line or else plaeholder text will not appear! -->
        <p><textarea id="other_skills" name="other_skills" rows="10" cols="60" placeholder="Enter other skills here"></textarea>
            <span id="empty_skills" class="error_message"></span></p>
        <input class="form_action" type="submit" value="Apply" />
        <input class="form_action" type="reset" value="Reset form" />
    </form>
    <hr />
    <?php
        include_once("footer.inc");
    ?>

</body>


</html>