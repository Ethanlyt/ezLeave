<?php
    include_once('php/utils.php');

    //? Action: "REDIRECT" - Redirects to login page if the session did expired, with a message_danger set
    //?         "NONE" - Do nothing. Session is destroyed in silence
    
    function checkExpiredSession(string $mode = "NONE") {
        // ? If the session is already expired, expire the session and redirect to login page.
        if (isset($_SESSION) && isset($_SESSION['expire']) && time() >= $_SESSION['expire'] ) {
            session_destroy();

            if ($mode === "REDIRECT") redirectTo('loginform.php?message_danger=Session expired. Please log in again');
        }
    }
?>