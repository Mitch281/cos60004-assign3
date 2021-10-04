/*  Filename: apply.js
    Target html: apply.html
    Purpose: This file provides additional validation to the job application form as well as storing and retreiving
    applicant details from session storage.
    Author: Mitchell Anton
    Date written: 16/09/2021 (completed 26/09/2021) */

"use strict";

// Checks that the postcode obeys the rules of the corresponding state selected.
function checkPostcode(postcode, state) {
    var errorMessage = "";

    // Only checks if we have already entered a postcode and state.
    if (postcode != "" && state != "") {
        var firstNumber = postcode.charAt(0);
        switch(state) {
            case "VIC":
                if (firstNumber != "3" && firstNumber != "8") {
                    errorMessage = "The postcode of suburbs/towns in Victoria start with either a 3 or an 8.\n";
                }
                break;
            case "NSW":
                if (firstNumber != "1" && firstNumber != "2") {
                    errorMessage = "The postcode of suburbs/towns in New South Wales start with either a 1 or a 2.\n";
                }
                break;
            case "QLD":
                if (firstNumber != "4" && firstNumber != "9") {
                    errorMessage = "The postcode of suburbs/towns in Queensland start with either a 4 or a 9.\n";
                }
                break;
            case "NT":
                if (firstNumber != "0") {
                    errorMessage = "The postcode of suburbs/towns in Northen Territory start with a 0.\n";
                }
                break;
            case "WA":
                if (firstNumber != "6") {
                    errorMessage = "The postcode of suburbs/towns in Western Australia start with a 6.\n";
                }
                break;
            case "SA":
                if (firstNumber != "5") {
                    errorMessage = "The postcode of suburbs/towns in South Australia start with a 5.\n";
                }
                break;
            case "TAS":
                if (firstNumber != "7") {
                    errorMessage = "The postcode of suburbs/towns in Tasmania start with a 7.\n";
                }
                break;
            case "ACT":
                if (firstNumber != "0") {
                    errorMessage = "The postcode of suburbs/towns in Australian Capital Territory start with a 0.\n";
                }
                break;
        }
    }
    return errorMessage;
}

//Checks if other skills checkbox is checked.
function isOtherSkillsChecked() {
    //Get array of all label elements inside fieldset element with id skills.
    var skillsArray = document.getElementById("skills").getElementsByTagName("input");

    var numCheckboxes = skillsArray.length;
    if (skillsArray[numCheckboxes - 1].checked) {
        return true;
    }
    return false;
}

function resetErrorMessages() {
    var errorMessages = document.getElementsByClassName("error_message");
    for (var i = 0; i < errorMessages.length; i++) {
        errorMessages[i].textContent = "";
    }
}

// Get age of the applier.
function getAge(dateOfBirth) {
    var age;
    var today = new Date();
    var dayToday = today.getDate(); // Day number\
    var monthToday = today.getMonth() + 1; // Month number
    var yearToday = today.getFullYear();  // Year in "yyyy" format. 

    var birthArray = dateOfBirth.split("/"); // Puts the day, month and year of date of birth into an array.
    var dayOfBirth = parseInt(birthArray[0]);
    var monthOfBirth = parseInt(birthArray[1]);
    var yearOfBirth = parseInt(birthArray[2]);

    if (monthToday == monthOfBirth) {
        // Birthday this year has happened.
        if (dayOfBirth <= dayToday) {
            age = yearToday - yearOfBirth;
        }

        // Birthday this year has not happened yet.
        else if (dayOfBirth > dayToday) {
            age = yearToday - yearOfBirth - 1
        }
    }

    // Birthday this year has happened.
    else if (monthOfBirth <= monthToday) {
        age = yearToday - yearOfBirth;
    }

    // Birthday this year has not happened yet.
    else if (monthOfBirth > monthToday) {
        age = yearToday - yearOfBirth - 1;
    }
    return age;
}

// Number of times a form is submitted (not necessarily successfully).
var numTimesSubmitted = 0;

function validateForm() {
    numTimesSubmitted++;
    if (numTimesSubmitted >= 1) {
        resetErrorMessages();
    }

    var valid = true;
    var dateOfBirth = document.getElementById("dob").value.trim();
    var postcode = document.getElementById("postcode").value.trim();
    var state = document.getElementById("state").value;
    var otherSkills = document.getElementById("other_skills").value;

    var dateOfBirthRE = /^([0]?[1-9]|[12][0-9]|[3][01])\/([0]?[1-9]|[1][0-2])\/[0-9]{4}$/;

    if (!dateOfBirth.match(dateOfBirthRE)) {
        valid = false;
        document.getElementById("invalid_dob").textContent = "Please enter the date of birth in dd/mm/yyyy format.";
    }

    // Only compute the age if it is possible (i.e. date of birth in the appropriate format).
    else {
        var age = getAge(dateOfBirth);
        if (age < 15 || age > 80) {
            valid = false;
            document.getElementById("invalid_age").textContent = "Your age must be between 15 and 80.";
        }
    }

    if (checkPostcode(postcode, state) != "") {
        valid = false;
        document.getElementById("invalid_postcode").textContent = checkPostcode(postcode, state);
    }

    if (isOtherSkillsChecked()) {
        if (otherSkills == "") {
            valid = false;
            document.getElementById("empty_skills").textContent = "You have stated that you have other skills.\
            Please specify these skills in the textbox.";
        }
    }

    if (valid) {
        storePersonalDetails(dateOfBirth, state, postcode);
    }

    return valid;
}

// Gets the job reference number from local storage and displays it as read only.
function prefillJobReferenceNumber() {
    if (typeof(Storage) !== undefined) {
        var jobReferenceNumber = localStorage.getItem("jobReferenceNumber");
        var jobReferenceNumberField = document.getElementById("reference_number");
        jobReferenceNumberField.value = jobReferenceNumber;
        jobReferenceNumberField.setAttribute("readonly", true);

        // Make it obvious that the job reference field is read only.
        jobReferenceNumberField.style.backgroundColor = "lightgrey";
    }
}   

// Gets the gender of the applicant
function getGender() {
    var gender = "unknown";
    var genders = document.getElementById("gender").getElementsByTagName("input");

    for (var i = 0; i < genders.length; i++) {
        if (genders[i].checked) {
            gender = genders[i].value;
        }
    }
    return gender;
}

// Gets the skills of the applicant.
function getSkills() {
    var skillsArray = document.getElementById("skills").getElementsByTagName("input");
    var skillsChecked = [];

    for (var i = 0; i < skillsArray.length; i++) {
        if (skillsArray[i].checked) {
            skillsChecked.push(skillsArray[i].value);
        }
    }
    return skillsChecked;
}

/* This function will store the personal details of a person once they apply for a job using session storage. Personal
details include feverything except for the job reference number. */
function storePersonalDetails(dateOfBirth, state, postcode) {
    if (typeof(Storage) !== undefined) {
        sessionStorage.setItem("firstName", document.getElementById("first_name").value.trim());
        sessionStorage.setItem("lastName", document.getElementById("last_name").value.trim());
        sessionStorage.setItem("dateOfBirth", dateOfBirth);
        sessionStorage.setItem("gender", getGender());
        sessionStorage.setItem("streetAddress", document.getElementById("street_address").value.trim());
        sessionStorage.setItem("suburb", document.getElementById("suburb").value.trim());
        sessionStorage.setItem("state", state);
        sessionStorage.setItem("postcode", postcode);
        sessionStorage.setItem("email", document.getElementById("email").value.trim());
        sessionStorage.setItem("otherSkills", document.getElementById("other_skills").value.trim());

        // Storage for skill checkboxes
        var skillsChecked = getSkills();
        for (var i = 0; i < skillsChecked.length; i++) {
            // First element of array.
            if (i == 0) {
                sessionStorage.skills = skillsChecked[i] + ",";
            }

            // We have reached the end of the array.
            else if (i == skillsChecked.length - 1) {
                sessionStorage.skills += skillsChecked[i];
            }

            else {
                sessionStorage.skills += skillsChecked[i] + ",";
            }
        }
    }
}

function prefillForm() {
    if (sessionStorage.getItem("firstName") != undefined) {
        document.getElementById("first_name").value = sessionStorage.getItem("firstName");
        document.getElementById("last_name").value = sessionStorage.getItem("lastName");
        document.getElementById("dob").value = sessionStorage.getItem("dateOfBirth");
        document.getElementById("street_address").value = sessionStorage.getItem("streetAddress");
        document.getElementById("suburb").value = sessionStorage.getItem("suburb");
        document.getElementById("state").value = sessionStorage.getItem("state");
        document.getElementById("postcode").value = sessionStorage.getItem("postcode");
        document.getElementById("email").value = sessionStorage.getItem("email");
        document.getElementById("other_skills").value = sessionStorage.getItem("otherSkills");

        // Prefill gender
        switch(sessionStorage.getItem("gender")) {
            case "Male":
                document.getElementById("male").checked = true;
                break;
            case "Female":
                document.getElementById("female").checked = true;
                break;
        }

        // Prefill skills
        var skillsChecked = sessionStorage.getItem("skills").split(","); // These are the values the applicant checked.
        var skillsArray = document.getElementById("skills").getElementsByTagName("input"); // These are all the possible skills that can be checked.
        for (var i = 0; i < skillsChecked.length; i++) {
            for (var j = 0; j < skillsArray.length; j++) {
                if (skillsChecked[i] == skillsArray[j].value) {
                    skillsArray[j].checked = true;
                }
            }
        }
    }
}   

function init() {
    var jobForm = document.getElementById("job_form");
    jobForm.onsubmit = validateForm;

    prefillForm();
}

window.addEventListener("load", init);
window.addEventListener("load", prefillJobReferenceNumber);