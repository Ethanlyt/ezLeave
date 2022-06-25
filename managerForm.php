<?php 
    session_start();
    include_once('php/db_connect.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("MANAGER");

    $application_id=$_GET['application'];

    $sql = 
    "SELECT APPLICATION.*,STAFF.username AS applicant_name
    FROM APPLICATION
    INNER JOIN STAFF ON APPLICATION.applicant_ID=STAFF.user_id
    WHERE application_id=$application_id
    ";


    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // $_SESSION['user']['user_level']

    // if ($row['manager_name']===null) $approval_manager="NA";


    if ( $result->num_rows === 0 ) $_GET['message_danger'] = "Error displaying application!";
    while($row) {
        $application_id=$application_id;
        $applicant_name=$row['applicant_name'];
        $applicant_id=$row['applicant_ID'];
        $date_submitted=$row['date_submitted'];
        // $approval_manager=$row['manager_name'];//session manager
        // $approval_time=$row['approval_time'];//session time
        $last_modified=$row['last_modify'];
        $leave_date=$row['leave_date'];
        $leave_reason=$row['leave_reason'];
    }
    
    // application_id,username,applicant_ID,date_submitted,username,approval_time,
    // last_modify,leave_reason,
    // manager_remark
    // null manager_name
    echo $applicant_name;
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
                        <td class="content">fgdfg</td>
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