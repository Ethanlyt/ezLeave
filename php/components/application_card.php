

<?php
    // If user level is staff, display only its applied application
    if ($user_level === 'STAFF'){
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo
                "<div class='container_item'>

                    <a href='./staffForm.php?application={$row['application_id']}' class='button card application-card'>
                        <h4 class='card-title application-title'>Leave #".$row["application_id"]."</h4>

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

                        <i class='card-icon las la-clock'></i>
                        <p class='card-value application-time'>".$row["date_submitted"]."</p>

                        <i class='card-icon las la-check-circle'></i>
                        <p class='card-value application-status status-pending'>".$row["approval_status"]."</p>
                    </a>
                </div>";

        }
    }

    // else if userlevel is manager, display all application
    else if ($user_level === 'MANAGER'){

    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo
                "<div class='container_item'>
                    <div class='container_item'>
                        <a href='./managerForm.php?application={$row['application_id']}' class='button card application-card'>
                        <h4 class='card-title application-title'>Leave #".$row["application_id"]."</h4>

                        <hr class='card-divider'>

                        <i class='card-icon las la-user'></i>
                        <p class='card-value application-name'>".$row["username"]."</p>

                        <i class='card-icon las la-clock'></i>
                        <p class='card-value application-time'>".$row["date_submitted"]."</p>

                        <i class='card-icon las la-check-circle'></i>
                        <p class='card-value application-status status-pending'>".$row["approval_status"]."</p>
                        </a>
                    </div>
                </div>";
        }
    }
        

    <hr class='card-divider'>
    
    <div class='card-label'>
        <i class='card-icon las la-user'></i>
        Applicant
    </div>
    <p class='card-value application-name'><?php echo $row["username"]; ?></p>

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