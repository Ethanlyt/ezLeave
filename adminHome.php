<?php 
    session_start();

    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("ADMIN");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>

    <?php include_once('php/components/head.php'); ?>
    
    <link rel="stylesheet" href="css/dateclock.css">
    <link rel="stylesheet" href="css/adminHome.css">
    
    <script src="javascript/timeclock.js"></script>
</head>


<body>

    <!-- Navigation -->
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


    <!--  -->
    <div>
        <div class="topic">
            <h1><i class="las la-user-cog"></i> LEAVE APPLICATION USER MANAGEMENT</h1>
        </div>


        <div class="container_nav">
            <h2><i class="las la-user-edit "></i> Choose a staff / manager</h2>
            <div class="searchfield">
                <input type="text" name="search_paramter" class="searchparameter" placeholder="Search ID/Name..."/>
                <button class="button searchbutton"><i class="las la-search"></i> Search</button>
            </div>
        </div>
        
        <div class="staff_list_container">
            <div class="staff_list">
                <h4><i class="las la-bars"></i> Staff / Manager List</h4>

                <a href="adminform.html" class="add_button"><i class="las la-plus-circle"></i></a>
                
                <div class="dropdown">
                    <button class="button dropbtn"><i class="las la-filter"></i></button>
                    <div class="dropdown-content">
                        <button class="button"><i class="las la-sort-alpha-down"></i> Alphabatic</button>
                        <button class="button"><i class="las la-calendar-plus"></i> Date added</button>
                        <button class="button"><i class="las la-calendar-day"></i> Leave date</button>
                    </div>
                </div>
            </div>
                
            <hr class="line"> 


            <table class="table_staff">
                <tr class="table_header">
                    <th class="header_index">No.</th>
                    <th class="header_name">Staff Name</th>
                    <th class="header_id">Staff ID</th>
                    <th class="header_level">User Level</th>
                    <th class="empty_cell"></th>
                </tr>
                
                <tr class="table_item">
                    <td class="item_index item_index_first">1</td>
                    <td class="item_name item_name_first">SOH JUN WEI </td>
                    <td class=" item_id item_id_first">EZ#8276493</td>
                    <td class=" item_level item_level_first">STAFF</td>
                    <td class="item_id_first edit_icon">
                        <a href="#"><i class="las la-user-edit"></i></a>
                    </td>
                </tr>
                <tr class="table_item">
                    <td class="item_index">2</td>
                    <td class="item_name">ETHAN LEONG YI THIAN </td>
                    <td class="item_id">EZ#8415643</td>
                    <td class="item_level">STAFF</td>
                    <td class="edit_icon"><a href="#"><i class="las la-user-edit"></i></a></td>
                </tr>
                <tr class="table_item">
                    <td class="item_index">3</td>
                    <td class="item_name">ZHU YI CHEN </td>
                    <td class="item_id">EZ#2823145</td>
                    <td class="item_level">MANAGER</td>
                    <td class="edit_icon"><a href="#"><i class="las la-user-edit"></i></a></td>
                </tr>
            </table>

            
        </div>
    </div>
    
        

</body>
</html>


