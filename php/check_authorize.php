<?php 
    include_once("php/utils.php");

    //? Redirects the user to their homepage if the visitor is in unauthorized access
    //? Access shall only be "ADMIN", "STAFF" or "MANAGER" or "LOGGEDIN"
    function checkAuthorizeAccess(string $access) {
        $is_logged_in = isset($_SESSION) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
        if (isset($access) && !$is_logged_in) redirectTo("loginform.php?message_danger=401 Unauthorized. Please log in first.");

        $user_level = $_SESSION['user']['user_level'];

        // user level mismatch
        if ($access !== 'LOGGEDIN' && $user_level !== $access) {
            if ($user_level === "MANAGER") redirectTo("managerHome.php?message_danger=401 Unauthorized. You are not " . $access);
            if ($user_level === "ADMIN") redirectTo("adminHome.php?message_danger=401 Unauthorized. You are not " . $access);
            if ($user_level === "STAFF") redirectTo("staffHomepage.php?message_danger=401 Unauthorized. You are not " . $access);
        }
    }
?>