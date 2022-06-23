<?php
    session_start();
    include_once('php/db_connect.php');
    include_once('php/utils.php');
    include_once('php/session_expiry.php');

    checkExpiredSession();
    loginFormHandler($conn);
    redirectIfLoggedIn();
?>


<?php 
    function loginFormHandler(mysqli $conn) {
        if (!isset($_POST['login']) || isset($_SESSION['logged_in'])) return;
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember = isset($_POST['remember_me']);
        
        // * Server side input validation
        if ( validateUsername($username) !== true ) return $_GET['message_danger'] = validateUsername($username);
        if ( validatePassword($password) !== true ) return $_GET['message_danger'] = validatePassword($password);

        $stmt = $conn->prepare("
            SELECT user_id, password, user_level FROM `staff` WHERE username = ? UNION
            SELECT user_id, password, user_level FROM `admin` WHERE username = ? UNION
            SELECT user_id, password, user_level FROM `manager` WHERE username = ?
        ");
        $stmt->bind_param('sss', $username, $username, $username);

        if (!$stmt->execute()) die("Error 500: Error occurred during database fetching<br>" . $stmt->error);

        $result = $stmt->get_result();

        // * No user found
        if ( $result->num_rows === 0 ) return $_GET['message_danger'] = "No user with username $username found!";
        $user = $result->fetch_assoc();

        // * Password mismatch
        if ( $user['password'] !== $password ) return $_GET['message_danger'] = "Incorrect password. Please try again";


        // * Login Successful. Check user level and log the user in.
        if ( $user['user_level'] === 'ADMIN') $stmt = $conn->prepare('SELECT * FROM `admin` WHERE user_id = ?');
        else if ( $user['user_level'] === 'MANAGER') $stmt = $conn->prepare('SELECT * FROM `manager` WHERE user_id = ?');
        else $stmt = $conn->prepare('SELECT * FROM `staff` WHERE user_id = ?');
        
        $stmt->bind_param('s', $user['user_id']);
        if (!$stmt->execute()) die("Error 500: Error occurred during database fetching<br>" . $stmt->error);
        $user = $stmt->get_result()->fetch_assoc();

        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $user;
        // * Set session expiry. 10 minutes if not remember me, else forever
        $_SESSION['expire'] = time() + ( $remember? null: (10 * 60) );
    }
?>


<?php
    //* Redirects to the corresponding home page if the user is logged in.
    function redirectIfLoggedIn() {
        if (!isset($_SESSION['logged_in'])) return;
        $user_level = $_SESSION['user']['user_level'];

        if ($user_level === 'ADMIN') redirectTo('adminHome.php');
        else if ($user_level === 'MANAGER') redirectTo('managerHome.php');
        else if ($user_level === 'STAFF') redirectTo('staffHomepage.php');
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login page</title>

    <?php include_once('php/components/head.php'); ?>
    
    <link rel="stylesheet" href="css/loginform.css">

    <script src="javascript/loginform.js"></script>
</head>


<body>
    <form class="login" method="POST" action="/loginform.php">
        <div class="login_head">
            <a href="." class="login_back"><i class="las la-arrow-left"></i></a>
            <h1><i class="lab la-envira"></i> Welcome to EzLeave</h1>
        </div>

        <?php include_once("php/components/messagebox.php"); ?>


        <h2 class="login_title"><i class="las la-sign-in-alt"></i> Log in</h2>

        <div class="login_fields">
            <div class="form-group">
                <input class="login_field text_field" type="text" name="username" id="username" placeholder=" " required 
                    value='<?php echo( isset($_POST['username'])? $_POST['username']: '' ); ?>'>
                <label class="login_label text_overlay" for="username" >Username</label>
            </div>
            <div class="form-group">
                <input class="login_field text_field" type="password" name="password" id="password" placeholder=" " required>
                <label class="login_label text_overlay" for="password">Password</label>
               
                <div style="padding-top:10px;">
                    <input class="checkbox view_password" type="checkbox" onclick="reviewPassword()">
                    <label for="view_password" class="checkbox_label">Show Password</label>
                </div>

            </div>
            <div>
                <input class="checkbox remember_me" type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me" class="checkbox_label">Remember Me</label>
            </div>

            <input type="submit" name='login' class="button login_button" id="login_button"/>

        </div>
    </form>
    
</body>
</html>