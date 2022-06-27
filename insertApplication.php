<?php
        session_start();
        include_once('php/db_connect.php');
        include_once('php/session_expiry.php');
        include_once("php/check_authorize.php");
    
        checkExpiredSession("REDIRECT");
        checkAuthorizeAccess("STAFF");
        
    if(isset($_POST['submit'])){
        $submission_date = date('Y-m-d H:i:s');
        $applicant_id = $_SESSION['user']['user_id'];//abababababa
        $application_date = $_POST['date'];
        $application_reason = $_POST['leave_reason'];
        $applicaiton_status = 'PENDING';
    
        $sql="INSERT INTO APPLICATION(applicant_ID,date_submitted,leave_date,leave_reason,approval_status,last_modify)
        VALUES('$applicant_id','$submission_date','$application_date','$application_reason','$applicaiton_status',NOW())";

        if($conn->query($sql)===TRUE){
            echo "Application submitted.";
        }else{
            echo "Error submitting the application. Please try agian later.";
        }
        redirectTo("staffHomepage.php");
    }
?>

<?php 
    if(isset($_POST['delete'])){
        
        $delete_this_application = $_REQUEST['delete_application'];
        
 
        $sql="DELETE FROM APPLICATION WHERE application_id=$delete_this_application";
        if($conn->query($sql)===TRUE){
            echo " Application deleted";
        }else{
            echo "Error.";
        }
        redirectTo("staffHomepage.php");
    }
?>

<?php 
    if(isset($_POST['update'])){
        
        $update_this_application = $_REQUEST['delete_application'];
        
 
        $sql=
        "UPDATE APPLICATION
        SET last_modify=NOW(), leave_reason='$_POST[leave_reason]','leave_reason=$_POST[date]';
        WHERE application_id=$delete_this_application";


        if($conn->query($sql)===TRUE){
            echo " Application updated";
        }else{
            echo "Error.";
        }
        redirectTo("staffHomepage.php");
    }
?>

