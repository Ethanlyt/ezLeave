
<?php
    //! Use this component only when you have retrieve applications from the Application table,
    //! and have assigned each row as a associative array into a variable named $row.
    //!
    //! Like: while ($row = $result->fetch_assoc() ) { 
    //!     include_once('application_card.php');
    //! }
    
    if ($user_level === "STAFF") $redirecturl = "staffForm.php?application={$row['application_id']}";
    else if ($user_level === "MANAGER") $redirecturl = "managerForm.php?application={$row['application_id']}";
    else $redirecturl = "index.php?message_warning=Application Card Warning: not staff nor manager user";

    $status = $row["approval_status"];
    if ($status === 'PENDING') $status_cls = 'status-pending';
    else if ($status === 'VERIFIED') $status_cls = 'status-verified';
    else if ($status === 'REJECTED') $status_cls = 'status-rejected';
    else if ($status === 'EXPIRED') $status_cls = 'status-expired';
    else $status_cls = '';
?>


<a href='<?php echo $redirecturl; ?>' class='button card application-card'>
    <h4 class='card-title application-title'><i class="lab la-wpforms"></i> Leave #<?php echo $row["application_id"]; ?></h4>

    <hr class='card-divider'>
    
    <?php if (isset($row['username'])) echo "
    <div class='card-label'>
        <i class='card-icon las la-user'></i>
        Applicant
    </div>
    <p class='card-value application-name'>{$row["username"]}</p>
    "; 
    ?>

    <div class='card-label'>
        <i class='card-icon las la-clock'></i>
        Submitted at
    </div>
    <p class='card-value application-time'><?php echo $row["date_submitted"]; ?></p>

    <div class='card-label'>
        <i class="card-icon las la-calendar"></i>
        Leave date
    </div>
    <p class='card-value leave-date'><?php echo $row["leave_date"]; ?></p>

    <div class='card-label'>  
        <i class='card-icon las la-check-circle'></i>
        Status
    </div>
    <p class='card-value application-status <?php echo $status_cls; ?>'><?php echo ucfirst(strtolower($row["approval_status"])); ?></p>
</a>