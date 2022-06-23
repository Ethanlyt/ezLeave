<?php
    $message = null;
    $message_type = null;

    if ( isset($_GET['message_warning']) ) {
        $message = $_GET['message_warning'];
        $message_type = "message-warning";
    }
    else if ( isset($_GET['message_success']) ) {
        $message = $_GET['message_success'];
        $message_type = "message-success";
    }
    else if ( isset($_GET['message_danger']) ) {
        $message = $_GET['message_danger'];
        $message_type = "message-danger";
    }

    if ( !is_null($message) ) echo "
        <div class='message $message_type'>
            $message
        </div>
    ";
?>