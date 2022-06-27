<?php
    function updateExpiredApplication(mysqli $conn) {
        $stmt = $conn->prepare("
            UPDATE application
            SET approval_status = 'EXPIRED'
            WHERE
                leave_date < NOW() AND
                approval_status = 'PENDING'
        ");
        if (!$stmt->execute()) die("Error 500 - Error while updating application status.");
    }
?>