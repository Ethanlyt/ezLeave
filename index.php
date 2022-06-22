<!DOCTYPE html>
<html lang="en">
<head>
    <title>EzLeave</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/jumbotron.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/dateclock.css">


    <script src="javascript/timeclock.js"></script>

    <!-- Line Awesome -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">  

</head>

<body>
    <!-- Navigation -->
    <?php include_once("php/components/nav.php"); ?>

    <div class="jumbotron">

        <div class="jumbotron_content">

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
            

            <a href="loginform.html" class="button jumbotron_content_button">
                <i class="las la-sign-in-alt"></i> Login
            </a>    
        </div>
    </div>


</body>
</html>