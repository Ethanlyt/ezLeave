<?php 
    session_start();

    include_once('php/utils.php');
    include_once('php/db_connect.php');
    include_once('php/session_expiry.php');
    include_once("php/check_authorize.php");

    checkExpiredSession("REDIRECT");
    checkAuthorizeAccess("ADMIN");
    
    setDefaultCookie();
    checkSetCookie();




    $search = isset($_GET['search'])? $_GET['search']: '';
    $searchparam = $search === ''? '': "search=$search";
    $filter = isset($_COOKIE['ADMINHOME_FILTER'])? $_COOKIE['ADMINHOME_FILTER']: '';
    $sort = isset($_COOKIE['ADMINHOME_SORT'])? $_COOKIE['ADMINHOME_SORT']: '';


    //* Retrieve a list of users.
    $filterstmt = $filter === 'ALL' || $filter === ''? '': "user_level = '$filter'";
    $searchstmt = $search === ''? '': "(full_name LIKE '%$search%' OR staff_id LIKE '%$search%')";
    $wherestmt = ($filterstmt . $searchstmt === '')? '': 'WHERE ' . 
                    $filterstmt . 
                    ($filterstmt !== '' && $searchstmt !== ''? ' AND ': '') . 
                    $searchstmt;
 
    if ($sort === 'NAME_DESC') $sortstmt = 'ORDER BY full_name DESC';
    else if ($sort === 'ID_ASC') $sortstmt = "ORDER BY staff_id ASC";
    else if ($sort === 'ID_DESC') $sortstmt = "ORDER BY staff_id DESC";
    else $sortstmt = 'ORDER BY full_name ASC';

    $query = "
        SELECT user_id, user_level, full_name, staff_id
        FROM staff $wherestmt
        UNION
        SELECT user_id, user_level, full_name, staff_id
        FROM manager $wherestmt
        $sortstmt
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt->execute()) die("Error 500 - Failed to query database");
    $result = $stmt->get_result();

    if ($result->num_rows === 0) $_GET['message_warning'] = 'No users found.';
?>



<?php 
    function setDefaultCookie() {
        if (!isset($_COOKIE['ADMINHOME_FILTER'])) {
            setcookie('ADMINHOME_FILTER', 'ALL');
            $_COOKIE['ADMINHOME_FILTER'] = "ALL";
        }
        if (!isset($_COOKIE['ADMINHOME_SORT'])) {
            setcookie('ADMINHOME_SORT', 'NAME_ASC');
            $_COOKIE['ADMINHOME_SORT'] = "NAME_ASC";
        }
    }

    function checkSetCookie() {
        if (isset($_GET['filter'])) {
            setcookie('ADMINHOME_FILTER', $_GET['filter']);
            $_COOKIE['ADMINHOME_FILTER'] = $_GET['filter'];
        }
        if (isset($_GET['sort'])) {
            setcookie('ADMINHOME_SORT', $_GET['sort']);
            $_COOKIE['ADMINHOME_SORT'] = $_GET['sort'];
        }
    }
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


    <div>
        <div class="topic">
            <h1><i class="las la-user-cog"></i> LEAVE APPLICATION USER MANAGEMENT</h1>
        </div>


        <div class="container_nav">
            <h2><i class="las la-user-edit "></i> Choose a staff / manager</h2>
            <form class="searchfield" method='GET' action='adminHome.php'>
                <input type="text" name="search" class="searchparameter" placeholder="Search ID/Name..." value='<?php echo $search; ?>'/>
                <button type='submit' class="button searchbutton"><i class="las la-search"></i> Search</button>
            </form>
        </div>
        
        <div class="staff_list_container">
            <div class="staff_list">
                <h4><i class="las la-bars"></i> Staff / Manager List</h4>

                <a href="adminform.php" title='Add new user' class="add_button"><i class="las la-plus-circle"></i></a>
                
                <div class="dropdown">
                    <button class="button dropbtn" title='Filter'><i class="las la-filter"></i></button>
                    <div class="dropdown-content">
                        <a href='adminHome.php?<?php echo $searchparam; ?>&filter=ALL'>
                            <button class="button <?php echo $filter === 'ALL'? 'selected': ''; ?>"><i class="las la-user-friends"></i> All</button>
                        </a>
                        <a href='adminHome.php?<?php echo $searchparam; ?>&filter=MANAGER'>
                            <button class="button <?php echo $filter === 'MANAGER'? 'selected': ''; ?>"><i class="las la-user-tie"></i> Manager</button>
                        </a>
                        <a href='adminHome.php?<?php echo $searchparam; ?>&filter=STAFF'>
                            <button class="button <?php echo $filter === 'STAFF'? 'selected': ''; ?>"><i class="las la-user"></i> Staff</button>
                        </a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="button dropbtn" title='Sort'><i class="las la-sort"></i></button>
                    <div class="dropdown-content">
                        <a href='adminHome.php?<?php echo $searchparam; ?>&sort=NAME_ASC'>
                            <button class="button <?php echo $sort === 'NAME_ASC'? 'selected': ''; ?>">Name (Asc)</button>
                        </a>
                        <a href='adminHome.php?<?php echo $searchparam; ?>&sort=NAME_DESC'>
                            <button class="button <?php echo $sort === 'NAME_DESC'? 'selected': ''; ?>">Name (Desc)</button>
                        </a>
                        <a href='adminHome.php?<?php echo $searchparam; ?>&sort=ID_ASC'>
                            <button class="button <?php echo $sort === 'ID_ASC'? 'selected': ''; ?>">Staff ID (Asc)</button>
                        </a>
                        <a href='adminHome.php?<?php echo $searchparam; ?>&sort=ID_DESC'>
                            <button class="button <?php echo $sort === 'ID_DESC'? 'selected': ''; ?>">Staff ID (Desc)</button>
                        </a>
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

                <?php
                    $index = 1;
                    while ($user = $result->fetch_assoc() ) {
                        echo "
                        <tr class='table_item'>
                            <td class='item_index item_index_first'>" . $index++ . "</td>
                            <td class='item_name item_name_first'>{$user['full_name']}</td>
                            <td class=' item_id item_id_first'>{$user['staff_id']}</td>
                            <td class=' item_level item_level_first'>{$user['user_level']}</td>
                            <td class='item_id_first edit_icon'>
                                <a href='adminform.php?id={$user['user_id']}&user_level={$user['user_level']}'><i class='las la-user-edit'></i></a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>
    
        

</body>
</html>


