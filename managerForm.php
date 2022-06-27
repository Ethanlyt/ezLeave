<?php 
    session_start();
    include_once('php/db_connect.php');
    include_once('php/utils.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");
    include_once("php/update_expired_application.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("MANAGER");
    updateExpiredApplication($conn);


    //* Retrieve application data and join with staff info
    if (!isset($_GET['application'])) redirectTo("managerHome.php?message_warning=No application ID provided.");
    $application_id=$_GET['application'];


    //* Handle managerForm Approval and Rejections
    if (isset($_POST['APPROVED']) || isset($_POST['REJECTED'])) {
        $new_status = isset($_POST['APPROVED'])? 'APPROVED': "REJECTED";

        $query = "
            UPDATE application
            SET 
                last_modify = NOW(),
                approval_time = NOW(),
                manager_remark = ?,
                approval_manager_ID = ?,
                approval_status = ?
            WHERE
                application_id = ?
                AND approval_status = 'PENDING'
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $_POST['remark'], $_SESSION['user']['user_id'], $new_status, $application_id);
        
        if ( $stmt->execute() && $stmt->affected_rows === 1 ) $_GET['message_success'] = "Successfully " . strtolower($new_status) . " the application";
        else $_GET['message_danger'] = "Failed to " . strtolower($new_status) . " the application. Please contact adminstrator";
    }


    //* Retrieve the application data
    $query = "
        SELECT 
            APPLICATION.*, 
            STAFF.username AS applicant_name,
            STAFF.staff_id
        FROM APPLICATION
        INNER JOIN 
            STAFF ON APPLICATION.applicant_ID = STAFF.user_id
        WHERE application_id = $application_id
    ";
    $stmt = $conn->prepare($query);
    if (!$stmt->execute() ) die("Error 500 - Error while querying database");
    $result = $stmt->get_result();

    if ( $result->num_rows === 0 ) redirectTo("managerHome.php?message_danger=No application with ID $application_id found");
    $application = $result->fetch_assoc();
    $applicant_name = $application['applicant_name'];
    $application_status = $application['approval_status'];
    $applicant_id = $application['staff_id'];
    $date_submitted = $application['date_submitted'];
    $last_modified = $application['last_modify'];
    $leave_date = $application['leave_date'];
    $leave_reason = $application['leave_reason'];
    $manager_remark = isset($application['manager_remark'])? $application['manager_remark']: '';
    $approval_manager=$application['approval_manager_ID'];

    $is_pending = $application_status === 'PENDING';

    //* The application has been reviewed by manager. Retrieve manager's full name
    if ( $approval_manager !== null ){
        $query = "
            SELECT full_name
            FROM manager
            WHERE user_id = ?
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $approval_manager);
        if (!$stmt->execute() ) die("Error 500 - Failed to fetch manager information");
        $result = $stmt->get_result();
        if ($result->num_rows === 0) die("Error 500 - Failed to fetch manager information");

        $approval_manager = $result->fetch_assoc()['full_name'];
    } 
    else $approval_manager = "N/A";
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

            <?php include_once('php/components/messagebox.php'); ?>

            <form name="view form" method="POST" action="managerForm.php?application=<?php echo $application_id; ?>">

                <div class="form_parameter"><i class="las la-info"></i> Application Info: </div>
                <hr>

                <table class="leave_detail">
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Application ID: </th>
                        <td class="content"><?php echo $application_id; ?>
                         </td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Application Status: </th>
                        <td class="content"><strong><?php echo $application_status; ?></strong></td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Applicant's Name: </th>
                        <td class="content"><?php echo $applicant_name; ?></td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Applicant's ID: </th>
                        <td class="content"><?php echo $applicant_id; ?></td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Date submitted: </th>
                        <td class="content"><?php echo $date_submitted; ?></td>
                    </tr>
                    <tr class="leave_detail_parameter">
                        <th class="leave_detail_parameter_cont">Approval manager: </th>
                        <td class="content"><?php echo $approval_manager; ?></td>
                    </tr>
                    <tr class="leave_detail_parameter">
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
                <div>
                    <textarea name="remark" from="view form" class="leave_reason" placeholder="Remarks..." <?php echo ($is_pending)? '': 'disabled'; ?>><?php echo $manager_remark; ?></textarea>
                </div>
                <hr>

                <div class="option">
                    <?php
                        if ($is_pending) echo "
                        <button type='submit' name='APPROVED' class='button button_form'>
                            <i class='las la-check-circle'></i> Approve
                        </button>
                        <button type='submit' name='REJECTED' class='button button_form'>
                            <i class='las la-times-circle'></i> Reject
                        </button>
                        ";
                        else echo "
                        <a href='managerHome.php' class='button button_form'>
                            <i class='las la-arrow-left'></i> Back
                        </a>
                        ";
                    ?>
                    
                </div>
        
            </form>
        </div>
    </main>

</body>
</html>