<?php
    include_once('php/utils.php');

    session_start();
    session_destroy();

    redirectTo('.?message_success=Logged out');
?>