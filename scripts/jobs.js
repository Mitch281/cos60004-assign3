/*  Filename: jobs.js
    Target html: jobs.html
    Purpose: This file stores the job reference number in local storage when the corresponding apply button is clicked.
    Author: Mitchell Anton
    Date written: 16/09/2021 (completed 22/09/2021) */

"use strict";

function storeJobReferenceNumber(applyButtonNumber) {
    if (typeof(Storage) !== "undefined") {
        var jobReferenceNumber = document.getElementById("reference_number_" + applyButtonNumber).textContent;
        localStorage.setItem("jobReferenceNumber", jobReferenceNumber);
    }
}

function checkApplyButtonClick(){
    var applyButton0 = document.getElementsByClassName("apply_button")[0];
    var applyButton1 = document.getElementsByClassName("apply_button")[1];

    // The bind function allows us to add parameters to the event handler.
    applyButton0.addEventListener("click", storeJobReferenceNumber.bind(Event, 0));
    applyButton1.addEventListener("click", storeJobReferenceNumber.bind(Event, 1));
}

window.addEventListener("load", checkApplyButtonClick);