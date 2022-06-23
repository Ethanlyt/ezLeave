
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


function redirectTo(string $url) {
    header("Location: $url");
    die();
}

?>