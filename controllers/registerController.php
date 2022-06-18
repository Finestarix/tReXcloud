<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/core/userController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/models/User.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/file.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/validator.php");

session_start();

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["register"]))) {

    $firstName = $_POST["firstname"];               // empty, alpha
    $lastName = $_POST["lastname"];                 // empty, alpha
    $username = $_POST["username"];                 // 5-20ch, unique, alphanumeric
    $password = $_POST["password"];                 // >=8ch
    $confirmPassword = $_POST["confirmpassword"];   // ==password
    $phoneNumber = $_POST["phonenumber"];           // numeric, 10-13dgt
    $birthdateDay = $_POST["birthdateday"];         // numeric, 1-31
    $birthdateMonth = $_POST["birthdatemonth"];     // numeric, 1-12
    $birthdateYear = $_POST["birthdateyear"];       // numeric, 1990-curr, checkdate
    $gender = $_POST["gender"];                     // empty, male|female

    if (checkLength($firstName)) {
        $_SESSION["ERROR"] = "First name must not be empty.";
    } else if (checkAlphabeth($firstName)) {
        $_SESSION["ERROR"] = "First name must only consist of letters (without numbers and punctuations).";
    } else if (checkLength($lastName)) {
        $_SESSION["ERROR"] = "Last name must not be empty.";
    } else if (checkAlphabeth($lastName)) {
        $_SESSION["ERROR"] = "Last name must only consist of letters (without numbers and punctuations).";
    } else if (checkLength($username, 5, 20)) {
        $_SESSION["ERROR"] = "Username length must be between 5 and 20 inclusively.";
    } else if (checkAlphanumeric($username)) {
        $_SESSION["ERROR"] = "Username must only consist of letters and numbers (without punctuations).";
    } else if (getUserByUsername($username)) {
        $_SESSION["ERROR"] = "Username must be unique.";
    } else if (checkLength($password, 8)) {
        $_SESSION["ERROR"] = "Password length must be equal or greater than 8.";
    } else if (checkLength($confirmPassword)) {
        $_SESSION["ERROR"] = "Confirm password must not be empty.";
    } else if (checkEqual($password, $confirmPassword)) {
        $_SESSION["ERROR"] = "Password confirmation do not match.";
    } else if (checkNumeric($phoneNumber)) {
        $_SESSION["ERROR"] = "Phone number must only consist of numbers (without letters and punctuations).";
    } else if (checkLength($phoneNumber, 10, 13)) {
        $_SESSION["ERROR"] = "Phone number length must be between 10 and 13 inclusively.";
    } else if (checkNumeric($birthdateDay)) {
        $_SESSION["ERROR"] = "Birthdate day must only consist of numbers (without letters and punctuations).";
    } else if (checkRange($birthdateDay, 1, 31)) {
        $_SESSION["ERROR"] = "Birthdate day must be between 1 and 31 inclusively.";
    } else if (checkNumeric($birthdateMonth)) {
        $_SESSION["ERROR"] = "Birthdate month must only consist of numbers (without letters and punctuations).";
    } else if (checkRange($birthdateMonth, 1, 12)) {
        $_SESSION["ERROR"] = "Birthdate month must be between 1 and 12 inclusively.";
    } else if (checkNumeric($birthdateYear)) {
        $_SESSION["ERROR"] = "Birthdate year must only consist of numbers (without letters and punctuations).";
    } else if (checkRange($birthdateYear, 1990, date("Y"))) {
        $_SESSION["ERROR"] = "Birthdate year must be between 1990 and " . date("Y") . " inclusively.";
    } else if (checkValidDate($birthdateMonth, $birthdateDay, $birthdateYear)) {
        $_SESSION["ERROR"] = "Birthdate must be a valid date.";
    } else if (checkLength($gender)) {
        $_SESSION["ERROR"] = "Gender must not be empty.";
    } else if (checkEqual($gender, "male") && checkEqual($gender, "female")) {
        $_SESSION["ERROR"] = "Gender must be between male and female.";
    } else {
        $user = new User($firstName, $lastName, $username, $password, $phoneNumber, $birthdateDay, $birthdateMonth, $birthdateYear, $gender);
        insertUser($user);
        createRootFolder($user->id);
        header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/login.php");
        die("Oops. Something when wrong.");
    }
} else {
    $_SESSION["ERROR"] = "Invalid request.";
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
die("Oops. Something when wrong.");