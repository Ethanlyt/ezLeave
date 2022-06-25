<?php 
    session_start();
    include_once('php/db_connect.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("STAFF");


    if(isset($_GET['submit'])){
        $date_clicked = date('Y-m-d H:i:s');
        $app_id = '1';//abababababa
        $app_date = $_GET['date'];
        $app_reason = $_GET['leave_reason'];
        $app_status = 'Pending';
    
        $sql="INSERT INTO APPLICATION(applicant_ID,date_submitted,leave_date,leave_reason,approval_status)
        VALUES('$app_id','$date_clicked','$app_date','$leave_reason','$app_status')";
        if($conn->query($sql)===TRUE){
            echo "successful";
        }else{
            echo "error";
        };
    
    }
?>

