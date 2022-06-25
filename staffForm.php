<?php 
    session_start();

    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("STAFF");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Leave Application form</title>

    <?php include_once('php/components/head.php'); ?>

    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="css/staffForm.css">

    <script src="javascript/staffForm.js"></script>
    <script src="javascript/calendar.js"></script>
</head>


<body>
    <?php include_once("php/components/nav.php"); ?>

    <main>
        <h1 class="topic"><i class="las la-file-alt"></i> LEAVE APPLICATION FORM</h1>

        <form name="leave_form" method="GET" action="" class="calendar_area">
            <label for="calendar-input" class="form_parameter"><i class="las la-calendar"></i> Calendar (Choose a date to apply leave): </label>

            <hr>

            <?php include_once("php/components/calendar.php") ?>

            <label class="form_parameter"><i class="las la-question-circle"></i> Leave reason : </label>
            
            <hr>

            <textarea name="leave_reason" class="leave_reason" id="leave_reason" form="leave_form" placeholder="Write your leave reason here..."></textarea>
            
            <hr>

            <div class="option">
                <input type="submit" value="Submit" class="button button_form">
                <input type="reset" value="Clear" class="button button_form">
                <input type="submit" value="Delete" class="button button_form">
            </div>
        </form>
    </main>

    <div class="details_area">
        <div class="form_parameter"><i class="las la-info"></i> Leave Details </div><hr>

        <table class="leave_detail">
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Approval manager: </th>
                <td class="content">N/A</td>
            </tr>
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Approval time: </th>
                <td class="content">N/A</td>
            </tr>
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Last modified: </th>
                <td class="content">N/A</td>
            </tr>
        </table>
    </div>

</body>

</html>