
<?php

// ? This php consist of utility functions like input validation and such ?//

function validatePassword(string $password) {
    if (strlen($password) === 0) return "Password cannot be blank!";
    if (strlen($password) < 6) return "Password length must be at least 6 characters!";

    return true;
}

function validateUsername(string $username) {
    if (strlen($username) === 0) return "Username cannot be blank!";
    if (strlen($username) < 3) return "Username length must be at least 4 characters!";
    if (preg_match('/[^a-z_\-0-9]/i', $username)) return "Username can only consist of alphanumeric characters, '-' and '_'";

    return true;
}

function validateFullName(string $fullname) {
    if (strlen($fullname) === 0) return "Full name cannot be blank!";
    if (strlen($fullname) > 100) return "Full name cannot exceed 100 characters!";
    if (preg_match('/[^a-z ]/i', $fullname)) return "Full name can only consist of alphabetic characters";

    return true;
}

function validateIC(string $ic) {
    if (strlen($ic) === 0) return "IC/Passport cannot be blank!";
    if (strlen($ic) > 30) return "IC/Passport cannot exceed 30 characters!";
    if (preg_match('/[^\-0-9]/i', $ic)) return "IC/Passport can only consist of digits and '-' character";

    return true;
}

function validateStaffID(string $id) {
    if (strlen($id) === 0) return "Staff ID cannot be blank!";
    if (strlen($id) > 10) return "Staff ID cannot exceed 10 characters!";
    if (!preg_match('/^[A-Z]{2}\d+$/', $id)) return "Staff ID must be prefixed with 2 alphabetic characters followed by 1 or more digits. Eg: AB123";

    return true;
}

function validateContactNo(string $contact) {
    if (strlen($contact) === 0) return "Contact Number cannot be blank!";
    if (strlen($contact) > 20) return "Contact Number cannot exceed 20 characters!";
    if (preg_match('/[^\-0-9]/i', $contact)) return "Contact Number can only consist of digits and '-' character";

    return true;
}

function validateEmail(string $email) {
    if (strlen($email) === 0) return "Email cannot be blank!";
    if (strlen($email) > 50) return "Email cannot exceed 50 characters!";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Invalid email format";

    return true;
}


function redirectTo(string $url) {
    header("Location: $url");
    die();
}

?>