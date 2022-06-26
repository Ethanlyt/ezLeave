<?php 
    session_start();
    include_once('php/db_connect.php');
    include_once('php/utils.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("MANAGER");

    $application_id=$_GET['application'];
    // , MANAGER.username AS manager_name
    // INNER JOIN MANAGER ON APPLICATION.approval_manager_ID=MANAGER.user_id
    $sql =  
    "SELECT APPLICATION.*, STAFF.username AS applicant_name,STAFF.staff_id
    FROM APPLICATION
    INNER JOIN STAFF ON APPLICATION.applicant_ID=STAFF.user_id
    WHERE application_id=$application_id
    ";

    $result = $conn->query($sql);


    if ( $result->num_rows === 0 ) redirectTo("managerHome.php?message_danger=Error displaying application");
    else{
        $application=$result->fetch_assoc();
        $application_ID=$application_id;
        $applicant_name=$application['applicant_name'];
        $applicant_id=$application['staff_id'];
        $date_submitted=$application['date_submitted'];
        $last_modified=$application['last_modify'];
        $leave_date=$application['leave_date'];
        $leave_reason=$application['leave_reason'];

        $approval_manager="N/A";
        $approval_time="N/A";

        if ($application['approval_manager_ID'] !== null){
            // query here
        }
       
        if ($application['approval_time'] !== null){
            // query here
        }
    }


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
                        <td class="content"><?php echo $application_ID?>
                         </td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Applicant's Name: </th>
                        <td class="content"><?php echo $applicant_name?></td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Applicant's ID: </th>
                        <td class="content"><?php echo $applicant_id?></td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Date submitted: </th>
                        <td class="content"><?php echo $date_submitted?></td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Approval manager: </th>
                        <td class="content">NA</td>
                    </tr>
                    <tr>
                        <th class="leave_detail_parameter_cont">Approval time: </th>
                        <td class="content">NA</td>
                    </tr>
                    <tr>
                        <th class="leave_detail_parameter_cont">Last modified: </th>
                        <td class="content"><?php echo $last_modified?></td>
                    </tr>
                </table>


                <div class="form_parameter"><i class="las la-calendar"></i> Applicant's leave is on : </div>
                <hr>
                
                <?php include_once("php/components/calendar.php"); ?>

                <div class="form_parameter"><i class="las la-question"></i> Applicant's leave reason : </div>
                <hr>
                <div class="text"> 
                    <textarea disabled name="leave reason" from="view form" class="leave_reason"><?php echo $leave_reason?></textarea> 
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