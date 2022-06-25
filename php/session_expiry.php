<?php
    include_once('php/utils.php');

    //? Action: "REDIRECT" - Redirects to login page if the session did expired, with a message_danger set
    //?         "NONE" - Do nothing. Session is destroyed in silence
    
    function checkExpiredSession(string $mode = "NONE") {
        // If the user is logged in and the 'remember_me' is not checked
        if (isset($_SESSION) && isset($_SESSION['expire']) ) {

            // If already expire
            if (time() >= $_SESSION['expire']) {
                session_destroy();
                // If mode is set to redirect
                if ($mode === "REDIRECT") redirectTo('loginform.php?message_danger=Session expired. Please log in again');
            }
            // Otherwise, not yet expire - Refresh the expiry time
            else $_SESSION['expire'] = time() + (10 * 60);
        }
    }
?>