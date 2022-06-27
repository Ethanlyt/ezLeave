<?php 
    session_start();

    include_once('php/db_connect.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("STAFF");

    $leave_reason='';
    
    if(isset($_GET['application'])){
    $application_id=$_GET['application'];
    $sql="SELECT APPLICATION.*, STAFF.username AS applicant_name,STAFF.staff_id
    FROM APPLICATION
    INNER JOIN STAFF ON APPLICATION.applicant_ID=STAFF.user_id
    WHERE application_id=$application_id";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) redirectTo("staffHome.php?message_danger=Error displaying application");
    while($row = $result->fetch_assoc()) {
        $application_ID=$application_id;
        $applicaNT_name=$row['applicant_name'];
        $applicant_id=$row['applicant_ID'];
        $date_submitted=$row['date_submitted'];
        $leave_reason=$row['leave_reason'];
        $leave_date=$row['leave_date'];
        $last_modified=$row['last_modify'];
    }

    }

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

        <form name="leave_form" method="GET" action="insertApplication.php?<?php $application=$application_id?>" class="calendar_area">
        
      
            <label for="calendar-input" class="form_parameter">
                <i class="las la-calendar"></i> Calendar (Choose a date to apply leave): 
            </label>

            <hr>

            <?php include_once("php/components/calendar.php") ?>
            
            <label class="form_parameter"><i class="las la-question-circle"></i> Leave reason : </label>
            <hr>
            <textarea name="leave_reason" class="leave_reason" placeholder="Write your leave reason here..."><?php if(isset($_GET['application'])) echo "$leave_reason";?></textarea>
            
            <hr>

            <div class="option">
                <input name="submit" type="submit" value="Submit" class="button button_form">
                <input type="reset" value="Clear" class="button button_form">
                <input name="delete" type="submit" value="Delete" class="button button_form">
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

