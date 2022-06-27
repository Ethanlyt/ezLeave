<?php 
    session_start();

    include_once('php/db_connect.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");
    include_once("php/update_expired_application.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("STAFF");
    updateExpiredApplication($conn);

    $leave_reason='';

    $LastModified='N/A';
    $ApprovalTime ='N/A';
    $ApprovalRemark='N/A';
    $ApprovalManager='N/A';
    
    if(isset($_GET['application'])){
        $application_id=$_GET['application'];

        $sql="SELECT APPLICATION.*, STAFF.username AS applicant_name,STAFF.staff_id
        FROM APPLICATION
        INNER JOIN STAFF ON APPLICATION.applicant_ID=STAFF.user_id
        WHERE application_id=$application_id";
        $result = $conn->query($sql);

        if ($result->num_rows === 0) redirectTo("staffHome.php?message_danger=Error displaying application");
        $row = $result->fetch_assoc();

        $application_ID=$application_id;
        $applicaNT_name=$row['applicant_name'];
        $applicant_id=$row['applicant_ID'];
        $date_submitted=$row['date_submitted'];
        $leave_reason=$row['leave_reason'];
        $leave_date=$row['leave_date'];
        $last_modified=$row['last_modify'];
        $application_status=$row['approval_status'];
        $approval_manager=$row['approval_manager_ID'];
        

        $is_modified = $application_status === "PENDING"; 

        if ( isset($approval_manager) ) {
            $LastModified=$last_modified;
            $ApprovalTime=$row['approval_time'];
            $ApprovalRemark=$row['manager_remark'];

            $sql="SELECT full_name AS manager_name FROM MANAGER WHERE user_id=$approval_manager";
            $result=$conn->query($sql);
            $row = $result->fetch_assoc();
            $ApprovalManager=$row['manager_name'];

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
        
        <?php include_once('php/components/messagebox.php'); ?>

        <form name="leave_form" method="POST" action="insertApplication.php" class="calendar_area">
        
            <label for="calendar-input" class="form_parameter">
                <i class="las la-calendar"></i> Calendar (Choose a date to apply leave): 
            </label>

            <hr>

            <?php include_once("php/components/calendar.php") ?>
            
            <label class="form_parameter"><i class="las la-question-circle"></i> Leave reason : </label>
            <hr>

            <?php 
            if(isset($_GET['application'])){
                if(!$is_modified) echo "<textarea name='leave_reason' class='leave_reason' placeholder='Write your leave reason here...' disabled>$leave_reason</textarea>";
                else echo "<textarea name='leave_reason' class='leave_reason' placeholder='Write your leave reason here...'>$leave_reason</textarea>";
            }
            else echo "<textarea name='leave_reason' class='leave_reason' placeholder='Write your leave reason here...'>$leave_reason</textarea>";
            ?>
            
                
            
            <hr>

            <input type="hidden" name="delete_application" value=<?php if(isset($_GET['application'])) echo $application_ID; ?>>
           
            <div class="option">

            <?php 
            if(isset($_GET['application'])){
                if($is_modified) {
                    echo "<input name='update' type='submit' value='Update' class='button button_form'>";
               
                echo "<input name='delete' type='submit' value='Delete' class='button button_form'>"; }
                else echo "<a href='staffHomepage.php' class='button button_form'> <i class='las la-arrow-left'></i> Back</a>"; 
            }
            else{
            echo "<input name='submit' type='submit' value='Submit' class='button button_form'>";
            echo "<input type='reset' value='Clear' class='button button_form'>";}

            ?>
 

            </div>
        </form>
    </main>
               
                
    <div class="details_area">
        <div class="form_parameter"><i class="las la-info"></i> Leave Details </div><hr>

        <table class="leave_detail">
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Approval manager: </th>
                <td class="content"> <?php echo $ApprovalManager; ?></td>
            </tr>

            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Approval remark: </th>
                <td class="content"><?php echo ($ApprovalRemark === ''? '(No data)': $ApprovalRemark); ?></td>
            </tr>

            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Approval time: </th>
                <td class="content"><?php echo $ApprovalTime; ?></td>
            </tr>
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Last modified: </th>
                <td class="content"><?php echo $LastModified; ?></td>
            </tr>
        </table>
    </div>

</body>

</html>