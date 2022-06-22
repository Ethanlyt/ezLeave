<!DOCTYPE html>
<html lang="en">

<head>
    <title>Leave Application form</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="css/staffForm.css">

    <script src="javascript/staffForm.js"></script>
    <script src="javascript/calendar.js"></script>

    <!-- External -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">  


</head>

<body>

    <nav class="nav padded-container">
        <a href="index.html" class="nav-brand">
            <i class="nav-brand-img lab la-envira"></i>
            <span class="nav-brand-title">EzLeave</span>
        </a>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="adminform.html">AdmiJW</a>
            </li>
            <li class="nav-item">
                <a href="index.html"><i class="las la-sign-out-alt"></i>Log out</a>
            </li>
        </ul>
    </nav>

    <main>
        <h1 class="topic"><i class="las la-file-alt"></i> LEAVE APPLICATION FORM</h1>

        <form name="leave_form" method="GET" action="" class="calendar_area">
            <label for="calendar-input" class="form_parameter"><i class="las la-calendar"></i> Calendar (Choose a date to apply leave): </label>

            <hr>

            <?php include_once("php/components/calendar.php") ?>

            <label class="form_parameter"><i class="las la-question-circle"></i> Leave reason : </label>
            
            <hr>

            <textarea name="leave_reason" class="leave_reason" id="leave_reason" form="leave_form" placeholder="Write your leave reason here..."></textarea>
            
            <hr>

            <div class="option">
                <input type="submit" value="Submit" class="button button_form">
                <input type="reset" value="Clear" class="button button_form">
            </div>
        </form>
    </main>

    <div class="details_area">
        <div class="form_parameter"><i class="las la-info"></i> Leave Details </div><hr>

        <table class="leave_detail">
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Approval manager: </th>
                <td class="content">N/A</td>
            </tr>
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Approval time: </th>
                <td class="content">N/A</td>
            </tr>
            <tr class="leave_detail_parameter">
                <th class="leave_detail_parameter_cont">Last modified: </th>
                <td class="content">N/A</td>
            </tr>
        </table>
    </div>

</body>

</html>