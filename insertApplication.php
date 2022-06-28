<?php
    session_start();

    include_once('php/db_connect.php');
    include_once("php/utils.php");
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("STAFF");

    // Return true if provided date (YYYY-MM-DD) is not today or in the past.
    function checkDateIsNotPast($datestr) {
        $dateunix = strtotime($datestr);
        if (!$dateunix) redirectTo('staffForm.php?message_danger=Invalid date format. Did you choose a date?');
        $now = date('Y-m-d 23:59:59');
        $nowunix = strtotime($now);

        if ($dateunix <= $nowunix) redirectTo('staffForm.php?message_danger=Invalid date. Cannot choose past date');
    }



    //* Case 1: Submit application (Insert)    
    if(isset($_POST['submit'])) {
        
        $applicant_id = $_SESSION['user']['user_id'];//abababababa
        $application_date = $_POST['date'];

        checkDateIsNotPast($application_date);

        $application_reason = $_POST['leave_reason'];
        $applicaiton_status = 'PENDING';
    
        $sql="INSERT INTO application (applicant_id,date_submitted,leave_date,leave_reason,approval_status,last_modify)
        VALUES('$applicant_id',NOW(),'$application_date','$application_reason','$applicaiton_status',NOW())";

        if($conn->query($sql) ) redirectTo("staffHomepage.php?message_success=Application submitted.");
        else redirectTo("staffHomepage.php?message_danger=Failed to submit application.");
    }
?>

<?php 
    if(isset($_POST['delete'])){
        $delete_this_application = $_REQUEST['delete_application'];
 
        $sql="DELETE FROM application WHERE application_id=$delete_this_application";
        if($conn->query($sql)) redirectTo("staffHomepage.php?message_success=Successfully deleted application.");
        else redirectTo("staffHomepage.php?application=$delete_this_application&message_danger=Failed to delete application.");
    }
?>

<?php 
    if (isset($_POST['update'])) {
        $update_this_application = $_REQUEST['delete_application'];
        
        checkDateIsNotPast( $_POST['date'] );

        $sql = "
        UPDATE application
        SET 
            last_modify=NOW(), 
            leave_reason='{$_POST['leave_reason']}',
            leave_date='{$_POST['date']}'
        WHERE application_id = $update_this_application
        ";

        if($conn->query($sql)) redirectTo("staffHomepage.php?application=$update_this_application&message_success=Successfully updated application.");
        else redirectTo("staffHomepage.php?application=$update_this_application&message_danger=Failed to update application.");
    }
?>

