<!-- This component should display the applicationID, applicant name, application date and application status -->
<!-- Display application card based  -->
<?php
    // If user level is staff, display only its applied application
    if ($user_level === 'STAFF'){
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo
                "<div class='container_item'>
                    <a href='./staffForm.php' class='button card application-card'>
                        <h4 class='card-title application-title'>Leave #".$row["application_id"]."</h4>

                        <hr class='card-divider'>

                        <i class='card-icon las la-user'></i>
                        <p class='card-value application-name'>".$username."</p>

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
        

    
    
?>