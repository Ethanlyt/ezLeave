<?php 
    session_start();

    include_once('php/session_expiry.php');

    checkExpiredSession("REDIRECT");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manager form</title>

    <?php include_once('php/components/head.php'); ?>

    <link rel="stylesheet" href="css/staffForm.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="css/managerForm.css">
    
    <script src="javascript/calendar.js"></script>
</head>


<body>

    <?php include_once("php/components/nav.php"); ?>


    
    <main>
        <h1 class="topic"><i class="las la-file-alt"></i> STAFF LEAVE APPLICATION</h1>

        <div class="calendar_area">
            <form name="view form" method="POST" action="">
                <div class="form_parameter"><i class="las la-info"></i> Application Info: </div>
                <hr>

                <table class="leave_detail">
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Application ID: </th>
                        <td class="content">IT101023</td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Applicant's Name: </th>
                        <td class="content">Ethan Leong Yi Thian</td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Applicant's ID: </th>
                        <td class="content">HS010402</td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Date submitted: </th>
                        <td class="content">2022-3-23 10:00:00A.M.</td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Approval manager: </th>
                        <td class="content">Soh Jun Wei</td>
                    </tr>
                    <tr>
                        <th class="leave_detail_parameter_cont">Approval time: </th>
                        <td class="content">2022-4-1 10:00:00A.M.</td>
                    </tr>
                    <tr>
                        <th class="leave_detail_parameter_cont">Last modified: </th>
                        <td class="content">2022-4-3 10:00:00A.M.</td>
                    </tr>
                </table>


                <div class="form_parameter"><i class="las la-calendar"></i> Applicant's leave is on : </div>
                <hr>
                
                <?php include_once("php/components/calendar.php"); ?>

                <div class="form_parameter"><i class="las la-question"></i> Applicant's leave reason : </div>
                <hr>
                <div class="text"> 
                    <textarea disabled name="leave reason" from="view form" class="leave_reason">I have to attend my friend's wedding on that day.</textarea> 
                </div>

                <div class="form_parameter">Remark of the leave application :</div>
                <hr>
                <div><textarea name="remark" from="view form" class="leave_reason" placeholder="Remarks..."></textarea></div>
                <hr>

                <div class="option">
                    <button type="submit" value="Approve" class="button button_form">
                        <i class="las la-check-circle"></i> Approve
                    </button>
                    <button type="submit" value="Reject" class="button button_form">
                        <i class="las la-times-circle"></i> Reject
                    </button>
                </div>
        
            </form>
        </div>
    </main>

</body>
</html>