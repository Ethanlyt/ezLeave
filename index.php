<?php 
    session_start();

    include_once('php/session_expiry.php');

    checkExpiredSession();



    $homepage = "loginform.php";
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        if ($_SESSION['user']['user_level'] === 'ADMIN') $homepage = 'adminHome.php';
        else if ($_SESSION['user']['user_level'] === 'MANAGER') $homepage = 'managerHome.php';
        else if ($_SESSION['user']['user_level'] === 'STAFF') $homepage = 'staffHomepage.php'; 
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>EzLeave</title>

    <?php include_once('php/components/head.php'); ?>

    <link rel="stylesheet" href="css/jumbotron.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/dateclock.css">
    <link rel="stylesheet" href="css/jumbotron.css">

    <script src="javascript/timeclock.js"></script>
</head>

<body>
    <?php include_once("php/components/nav.php"); ?>


    <div class="jumbotron">
        <div class="jumbotron_content">

            <?php include_once('php/components/messagebox.php'); ?>

            <h3 class="brand-title">
                <i class="lab la-envira"></i>
                EzLeave
            </h3>
                
            <p class="brand-desc">
                Apply leaves with ease
            </p>


            <div class="dateclock">
                <div class="date">
                    <span class="date-day" id="date-day">28</span>
                    <span class="date-mon" id="date-mon">January</span>
                    <span class="date-dow" id="date-dow">(Monday)</span>
                </div>
    
                <div class="clock">
                    <span class="clock-hr" id="clock-hr">88</span>
                    <span class="clock-colon">:</span>
                    <span class="clock-min" id="clock-min">88</span>
                    <span class="clock-colon">:</span>
                    <span class="clock-sec" id="clock-sec">88</span>
                    <span class="clock-ampm" id="clock-ampm">AM</span>
                </div>
            </div>
            
            <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) echo "
                <a href='$homepage' class='button jumbotron_content_button'>
                    <i class='las la-home'></i> Home
                </a>
                ";
                else echo "
                <a href='$homepage' class='button jumbotron_content_button'>
                    <i class='las la-sign-in-alt'></i> Login
                </a>
                ";
            ?>
        </div>
    </div>


</body>
</html>