<?php
    session_start();

    include_once('php/db_connect.php');
    include_once('php/utils.php');
    include_once('php/session_expiry.php');
    include_once('php/check_authorize.php');


    checkExpiredSession('REDIRECT');
    checkAuthorizeAccess('LOGGEDIN');

    if (!isset($_POST['username']) ) die("Error 400 - No username");
    if (!isset($_POST['full_name']) ) die("Error 400 - No full_name");
    if (!isset($_POST['password']) ) die("Error 400 - No password");
    if (!isset($_POST['ic']) ) die("Error 400 - No ic/passport");
    if (!isset($_POST['staff_id']) ) die("Error 400 - No staff id");
    if (!isset($_POST['contact']) ) die("Error 400 - No contact number");
    if (!isset($_POST['email']) ) die("Error 400 - No email");


    $user_id = isset($_POST['user_id'])? (int)$_POST['user_id']: null;
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];
    $ic = $_POST['ic'];
    $staff_id = $_POST['staff_id'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $user_level = isset($_POST['user_level'])? $_POST['user_level']: null;

    $error_msg = '';
    if (validateUsername($username) !== true) $error_msg = validateUsername($username);
    else if (validateFullName($full_name) !== true) $error_msg = validateFullName($full_name);
    else if (validatePassword($password) !== true) $error_msg = validatePassword($password);
    else if (validateIC($ic) !== true) $error_msg = validateIC($ic);
    else if (validateStaffID($staff_id) !== true) $error_msg = validateStaffID($staff_id);
    else if (validateContactNo($contact) !== true) $error_msg = validateContactNo($contact);
    else if (validateEmail($email) !== true) $error_msg = validateEmail($email);



    //* INSERT
    if ( isset($_POST['insert']) ) {
        checkAuthorizeAccess("ADMIN");
        
        if (!in_array($user_level, array('MANAGER', 'STAFF'))) $error_msg = "User level must be either MANAGER or STAFF only";
        if ($error_msg !== '') redirectTo("adminform.php?message_danger=$error_msg");

        $stmt = $conn->prepare("
            INSERT INTO $user_level
            (username,password,user_level,full_name,ic_passport,contact_no,email,staff_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssssss", $username, $password, $user_level, $full_name, $ic, $contact, $email, $staff_id);

        if (!$stmt->execute()) die("Error 500 - Error while querying database: " . $stmt->error);
        if ($stmt->affected_rows === 1) redirectTo("adminform.php?message_success=Successfully added new user " . $username);
        else redirectTo("adminform.php?message_danger=Unknown error when adding user. Please contact adminstrator");
    }

    //* UPDATE
    else if ( isset($_POST['update']) ) {
        if ($user_id === null) die("Error 400 - Bad request: No user id provided");
        if (!in_array($user_level, array('MANAGER', 'STAFF'))) $error_msg = "User level must be either MANAGER or STAFF only";

        if ($_SESSION['user']['user_level'] === "ADMIN") $redirecturl = 'adminHome.php';
        else $redirecturl = 'index.php';
        if ($error_msg !== '') redirectTo("$redirecturl?message_danger=$error_msg");

        if ($_SESSION['user']['user_level'] !== 'ADMIN' && ($user_level !== $_SESSION['user']['user_level'] || $_SESSION['user']['user_id'] !== $user_id) )
            redirectTo("$redirecturl?message_danger=Unauthorized. You cannot update users other than your own");

        $stmt = $conn->prepare("
            UPDATE $user_level
            SET
                username = ?,
                password = ?,
                full_name = ?,
                ic_passport = ?,
                contact_no = ?,
                email = ?,
                staff_id = ?
            WHERE user_id = ?
        ");
        $stmt->bind_param("ssssssss", $username, $password, $full_name, $ic, $contact, $email, $staff_id, $user_id);
        if (!$stmt->execute()) die("Error 500 - Error while querying database: " . $stmt->error);
        
        // We need to update the session's user account
        $stmt = $conn->prepare("SELECT * FROM $user_level WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        if (!$stmt->execute()) die("Error 500 - Error while querying database: " . $stmt->error);
        $_SESSION['user'] = $stmt->get_result()->fetch_assoc();

        redirectTo("$redirecturl?message_success=Successfully updated user");
    }

    //* DELETION
    else if ( isset($_POST['delete']) ) {
        if ($user_id === null) die("Error 400 - Bad request: No user id provided");
        if (!in_array($user_level, array('MANAGER', 'STAFF'))) $error_msg = "User level must be either MANAGER or STAFF only";

        if ($_SESSION['user']['user_level'] === "ADMIN") $redirecturl = 'adminHome.php';
        else $redirecturl = 'index.php';
        if ($error_msg !== '') redirectTo("$redirecturl?message_danger=$error_msg");

        if ($_SESSION['user']['user_level'] !== 'ADMIN' && ($user_level !== $_SESSION['user']['user_level'] || $user_id !== $_SESSION['user']['user_id']) )
            redirectTo("$redirecturl?message_danger=Unauthorized. You cannot delete users other than your own");

        $stmt = $conn->prepare("
            DELETE FROM $user_level
            WHERE user_id = ?
        ");
        $stmt->bind_param("s", $user_id);
        if (!$stmt->execute()) die("Error 500 - Error while querying database: " . $stmt->error);
        if ($stmt->affected_rows !== 1) redirectTo("$redirecturl?message_danger=Unknown error when deleting user. Please contact adminstrator");
        
        // User destroyed its own account.
        if ($_SESSION['user']['user_level'] !== "ADMIN") session_destroy();
        
        redirectTo("$redirecturl?message_success=Successfully deleted user");
    }
    else die("Error 400 - Bad request. No user operation specified.");
?>
