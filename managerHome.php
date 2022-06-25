<?php 
    session_start();

    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("MANAGER");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manager Dashboard</title>

    <?php include_once('php/components/head.php'); ?>
    
    <link rel="stylesheet" href="css/jumbotron.css">
    <link rel="stylesheet" href="css/managerHome.css">
    <link rel="stylesheet" href="css/dateclock.css">

    <script src="javascript/managerHome.js"></script>
    <script src="javascript/timeclock.js"></script>
</head>


<body>

    <?php include_once("php/components/nav.php"); ?>

    
    <div class="intro">
        <?php include_once('php/components/messagebox.php'); ?>

        <h3 class="brand-title">
            <i class="lab la-envira"></i>
            EzLeave
        </h3>
            
        <p class="brand-desc">
            Apply leaves with ease
        </p>

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



    <main class="container">
        <div class="container_nav">
            <h2><i class="las la-file-invoice"></i> Leave Applications</h2> 

            <div class="dropdown">
                <button class="button dropbtn"><i class="las la-sort"></i></button>
                <div class="dropdown-content">
                    <button class="button"><i class="las la-calendar-plus"></i> Date added</button>
                    <button class="button"><i class="las la-calendar-day"></i> Leave date</button>
                </div>
            </div>

            <div class="dropdown">
                <button class="button dropbtn"><i class="las la-filter"></i></button>
                <div class="dropdown-content">
                    <button class="button"><i class="las la-calendar-plus"></i> Pending</button>
                    <button class="button"><i class="las la-calendar-day"></i> Verified</button>
                    <button class="button"><i class="las la-calendar-day"></i> Rejected</button>

                </div>
            </div>

        </div>
        
        <hr class="line">

        <div class="container_item">

            <a href="#" class="button card application-card">
                <h4 class="card-title application-title">Leave #HS102834</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Soh Jun Wei</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2022-5-28 10:30:11 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-pending">Pending</p>
            </a>

            <a href="managerForm.html" class="button card application-card">
                <h4 class="card-title application-title">Leave #IT101023</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Ethan Leong Yi Thian</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2022-4-18 12:32:24 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-rejected">Rejected</p>
            </a>

            <a href="#" class="button card application-card">
                <h4 class="card-title application-title">Leave #IT531415</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Zhu Yi Chen</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2022-1-30 07:41:21 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-verified">Verified</p>
            </a>

            <a href="#" class="button card application-card">
                <h4 class="card-title application-title">Leave #IT531411</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Soh Jun Wei</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2021-1-30 07:41:21 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-expired">Expired</p>
            </a>

            <a href="#" class="button card application-card">
                <h4 class="card-title application-title">Leave #HS102834</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Soh Jun Wei</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2022-5-28 10:30:11 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-pending">Pending</p>
            </a>

            <a href="#" class="button card application-card">
                <h4 class="card-title application-title">Leave #IT101023</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Ethan Leong Yi Thian</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2022-4-18 12:32:24 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-rejected">Rejected</p>
            </a>

            <a href="#" class="button card application-card">
                <h4 class="card-title application-title">Leave #IT531415</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Zhu Yi Chen</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2022-1-30 07:41:21 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-verified">Verified</p>
            </a>

            <a href="#" class="button card application-card">
                <h4 class="card-title application-title">Leave #IT531411</h4>

                <hr class="card-divider">

                <i class="card-icon las la-user"></i>
                <p class="card-value application-name">Soh Jun Wei</p>

                <i class="card-icon las la-clock"></i>
                <p class="card-value application-time">2021-1-30 07:41:21 A.M.</p>

                <i class="card-icon las la-check-circle"></i>
                <p class="card-value application-status status-expired">Expired</p>
            </a>

        </div>
    </main>

</body>
</html>