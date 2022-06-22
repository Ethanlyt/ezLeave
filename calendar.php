<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>

    <!-- Styles -->
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/calendar.css">

    <script src="/javascript/calendar.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">  

     <!-- Line Awesome -->
     <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">


</head>
<body>
    <div class="calendar">

        <!-- The input element that should get submitted along with the form -->
        <input type="date" name="date" class="calendar-input" id="calendar-input" required/>

        <!-- Overlay to select the year month -->
        <div class="calendar-overlay">
            <div class="calendar-header">
                <button type="button" class="button calendar-header-btn" id="calendar-yr-left"><i class="las la-chevron-left"></i></button>
                <span class="calendar-header-text" id="calendar-overlay-year-text">N/A</span>
                <button type="button" class="button calendar-header-btn" id="calendar-yr-right"><i class="las la-chevron-right"></i></button>
            </div>

            <button type="button" class="button calendar-mon calendar-mon1">Jan</button>
            <button type="button" class="button calendar-mon calendar-mon2">Feb</button>
            <button type="button" class="button calendar-mon calendar-mon3">Mar</button>
            <button type="button" class="button calendar-mon calendar-mon4">Apr</button>
            <button type="button" class="button calendar-mon calendar-mon5">May</button>
            <button type="button" class="button calendar-mon calendar-mon6">Jun</button>
            <button type="button" class="button calendar-mon calendar-mon7">Jul</button>
            <button type="button" class="button calendar-mon calendar-mon8">Aug</button>
            <button type="button" class="button calendar-mon calendar-mon9">Sep</button>
            <button type="button" class="button calendar-mon calendar-mon10">Oct</button>
            <button type="button" class="button calendar-mon calendar-mon11">Nov</button>
            <button type="button" class="button calendar-mon calendar-mon12">Dec</button>
        </div>

        <!-- Section for selecting months -->
        <div class="calendar-header">
            <button type="button" class="button calendar-header-btn" id="calendar-left"><i class="las la-chevron-left"></i></button>
            <button type="button" class="button calendar-header-text" id="calendar-header-text">N/A</button>
            <button type="button" class="button calendar-header-btn" id="calendar-right"><i class="las la-chevron-right"></i></button>
        </div>

        <!-- "Actual calendar grid" -->
        <span class="calendar-dow calendar-sunday">Sun</span>
        <span class="calendar-dow calendar-monday">Mon</span>
        <span class="calendar-dow calendar-tuesday">Tue</span>
        <span class="calendar-dow calendar-wednesday">Wed</span>
        <span class="calendar-dow calendar-thursday">Thur</span>
        <span class="calendar-dow calendar-friday">Fri</span>
        <span class="calendar-dow calendar-saturday">Sat</span>

        <span class="calendar-grid calendar-grid1"></span>
        <span class="calendar-grid calendar-grid2"></span>
        <span class="calendar-grid calendar-grid3"></span>
        <span class="calendar-grid calendar-grid4"></span>
        <span class="calendar-grid calendar-grid5"></span>
        <span class="calendar-grid calendar-grid6"></span>
        <span class="calendar-grid calendar-grid7"></span>
        <span class="calendar-grid calendar-grid8"></span>
        <span class="calendar-grid calendar-grid9"></span>
        <span class="calendar-grid calendar-grid10"></span>
        <span class="calendar-grid calendar-grid11"></span>
        <span class="calendar-grid calendar-grid12"></span>
        <span class="calendar-grid calendar-grid13"></span>
        <span class="calendar-grid calendar-grid14"></span>
        <span class="calendar-grid calendar-grid15"></span>
        <span class="calendar-grid calendar-grid16"></span>
        <span class="calendar-grid calendar-grid17"></span>
        <span class="calendar-grid calendar-grid18"></span>
        <span class="calendar-grid calendar-grid19"></span>
        <span class="calendar-grid calendar-grid20"></span>
        <span class="calendar-grid calendar-grid21"></span>
        <span class="calendar-grid calendar-grid22"></span>
        <span class="calendar-grid calendar-grid23"></span>
        <span class="calendar-grid calendar-grid24"></span>
        <span class="calendar-grid calendar-grid25"></span>
        <span class="calendar-grid calendar-grid26"></span>
        <span class="calendar-grid calendar-grid27"></span>
        <span class="calendar-grid calendar-grid28"></span>
        <span class="calendar-grid calendar-grid29"></span>
        <span class="calendar-grid calendar-grid30"></span>
        <span class="calendar-grid calendar-grid31"></span>
        <span class="calendar-grid calendar-grid32"></span>
        <span class="calendar-grid calendar-grid33"></span>
        <span class="calendar-grid calendar-grid34"></span>
        <span class="calendar-grid calendar-grid35"></span>
        <span class="calendar-grid calendar-grid36"></span>
        <span class="calendar-grid calendar-grid37"></span>
        <span class="calendar-grid calendar-grid38"></span>
        <span class="calendar-grid calendar-grid39"></span>
        <span class="calendar-grid calendar-grid40"></span>
        <span class="calendar-grid calendar-grid41"></span>
        <span class="calendar-grid calendar-grid42"></span>
    </div>

</body>
</html>