<?php
        session_start();
        include_once('php/db_connect.php');
        include_once('php/session_expiry.php');
        include_once("php/check_authorize.php");
    
        checkExpiredSession("REDIRECT");
        checkAuthorizeAccess("STAFF");
    if(isset($_GET['submit'])){
        $submission_date = date('Y-m-d H:i:s');
        $applicant_id = '1';//abababababa
        $application_date = $_GET['date'];
        $application_reason = $_GET['leave_reason'];
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

