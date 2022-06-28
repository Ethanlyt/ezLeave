<?php 
    session_start();

    include_once('php/db_connect.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("LOGGEDIN");
    


    $user_id = isset($_GET['id'])? $_GET['id']: '';
    $user_level = isset($_GET['user_level'])? $_GET['user_level']: '';

    // Invalid user_level value
    if (!in_array($user_level, array("MANAGER", "STAFF", "") ) ) die("Error 400 - Invalid user level: " . $user_level);

    // Default form values
    $f_user_id = null;
    $f_username = '';
    $f_full_name = '';
    $f_password = '';
    $f_ic = '';
    $f_staff_id = '';
    $f_contact = '';
    $f_email = '';
    $f_user_level = null;

    


    //* Case 1 - Insert a new user (Admin only)
    if ($user_id === '') {
        checkAuthorizeAccess("ADMIN");
        $display_mode = 'INSERT';
    }
    //* Case 2 - Modify an existing user (Admin, Personal details)
    else { 
        $stmt = $conn->prepare("SELECT * FROM " . strtolower($user_level) . " WHERE user_id = $user_id");
        if (!$stmt->execute()) die("Error 500 - Error while querying database");
        $result = $stmt->get_result();
        if ($result->num_rows === 0) die("Error 400 - Invalid user id. Non existent user id $user_id");
        $user = $result->fetch_assoc();

        // If non-admin, query the database and see if the non-admin 
        if ($_SESSION['user']['user_level'] !== 'ADMIN' && ($user['user_level'] !== $_SESSION['user']['user_level'] || $user['user_id'] !== $_SESSION['user']['user_id']) )
            die("Error 400 - Unauthorized access: You are not an ADMIN to modify other user's profile");

        $display_mode = 'UPDATE';

        $f_user_id = $user['user_id'];
        $f_username = $user['username'];
        $f_full_name = $user['full_name'];
        $f_password = $user['password'];
        $f_ic = $user['ic_passport'];
        $f_staff_id = $user['staff_id'];
        $f_contact = $user['contact_no'];
        $f_email = $user['email'];
        $f_user_level = $user['user_level'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Staff details</title>

    <?php include_once('php/components/head.php'); ?>
    
    <link rel="stylesheet" href="css/jumbotron.css">
    <link rel="stylesheet" href="css/adminform.css">
</head>



<body>
    <!-- Navigation -->
    <?php include_once("php/components/nav.php"); ?>
    

    <main>
        <h1 class="page-title"><i class="las la-user-edit"></i> USER MANAGEMENT</h1>

        <div class="staff-details">
            <form name="detail form" method="post" action="adminupdate.php">
                <h3 class="form_title">Profile</h3>

                <?php include_once('php/components/messagebox.php'); ?>

                <hr class="line">

                <input type="text" name="user_id" style='display: none;' value='<?php echo $f_user_id; ?>' />

                <div class="form-group">
                    <label for="username" class="content-type">Username</label>
                    <input type="text" id="username" name="username" class="input_field" placeholder="Username"  value='<?php echo $f_username; ?>' >
                </div>

                <div class="form-group">
                    <label for="full_name" class="content-type">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="input_field" placeholder="Full Name"  value='<?php echo $f_full_name; ?>' >
                </div>

                <div class="form-group">
                    <label for="password" class="content-type">Password</label>
                    <input type="text" id="password" name="password" class="input_field" placeholder="Password" value='<?php echo $f_password; ?>' >
                </div>

                <div class="form-group">
                    <label for="ic" class="content-type">IC / Passport</label>
                    <input type="text" id="ic" name="ic" class="input_field" placeholder="IC/Passport" value='<?php echo $f_ic; ?>' >
                </div>

                <div class="form-group">
                    <label for="staff_id" class="content-type">Staff ID</label>
                    <input type="text" id="staff_id" name="staff_id" class="input_field" placeholder="ID" value='<?php echo $f_staff_id; ?>' >
                </div>

                <div class="form-group">
                    <label for="contact" class="content-type">Contact No.</label>
                    <input type="text" id="contact" name="contact" class="input_field" placeholder="Contact" value='<?php echo $f_contact; ?>' >
                </div>

                <div class="form-group">
                    <label for="email" class="content-type">Email</label>
                    <input type="text" id="email" name="email" class="input_field" placeholder="Email" value='<?php echo $f_email; ?>' >
                </div>

                <div class='form-group' style='<?php echo ($display_mode === 'INSERT'? '': 'display: none;'); ?>'>
                    <label for='user_level' class='content-type'>User level</label>
                    <select id='user_level' name='user_level'>
                        <option value='STAFF' <?php echo ($f_user_level !== 'MANAGER'? 'selected': '') ?> > STAFF</option>
                        <option value='MANAGER' <?php echo ($f_user_level === 'MANAGER'? 'selected': '') ?> > MANAGER</option>
                    </select> 
                </div>


                <hr>
                <div class="edit_type">
                    <?php
                    if ($display_mode === 'INSERT') echo "
                        <input type='submit' value='Insert' name='insert' class='button button_submit' >
                    ";
                    else echo "
                        <input type='submit' name='delete' value='Delete' class='button button_delete'>
                        <input type='submit' name='update' value='Update' class='button button_submit' >
                    ";
                    ?>
                </div>
            </form>
        </div>
    </main>
    


    <script>
        // Make a final confirmation before deleting the user.
        document.querySelector("input[name='delete']").addEventListener('click', (e)=> {
            if ( !window.confirm("Are you sure you want to delete the user? This action is inreversible") ) 
                e.preventDefault();
        });
    </script>
</body>
</html>