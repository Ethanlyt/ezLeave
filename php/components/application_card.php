<!-- This component should display the applicationID, applicant name, application date and application status -->
<!-- Display application card based  -->
<?php

include_once('php/db_connect.php');
    $is_signed_in = isset($_SESSION) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

    if (!$is_signed_in) return;
    else{ 
        $user_level = $_SESSION['user']['user_level'];
        $username = $_SESSION['user']['username'];
        $user_id = $_SESSION['user']['user_id'];

        // If user level is staff, display only its applied application
        if ($user_level === 'STAFF'){
            $sql = 
            "SELECT application_id, date_submitted, approval_status FROM APPLICATION
            WHERE applicant_ID = '$user_id'";

            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo
                    "<div class='container_item'>
                        <a href='#' class='button card application-card'>
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
            else {
              echo 
              "<div class='container_item'>"
              .$_GET['message_warning'] = 'No users found.'.
            "</div>";
            }
        }
        // else if userlevel is manager, display all application
        else if ($user_level === 'MANAGER'){
            $sql = 
            "SELECT APPLICATION.application_id, APPLICATION.date_submitted, APPLICATION.approval_status, STAFF.username 
            FROM APPLICATION 
            INNER JOIN STAFF ON APPLICATION.applicant_ID=STAFF.user_id";

            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo
                    "<div class='container_item'>
                        <div class='container_item'>
                        <a href='#' class='button card application-card'>
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
            else {
                echo 
                "<div class='no_container_item'>
                    <div class='container_item' >
                        <a href='#' class='button card application-card' style='background-color: #414c6b;opacity:0.5;'>
                            <h4 class='card-title application-title'>No Application record found...</h4>
                            <hr class='card-divider'>
                        </a>
                    </div>
                </div>";
            }
        }

    }
    
?>