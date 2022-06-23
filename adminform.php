<?php 
    session_start();

    include_once('php/session_expiry.php');

    checkExpiredSession("REDIRECT");
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
            <form name="detail form" method="post" action="">
                <h3 class="form_title">Profile</h3>

                <hr class="line">

                <div class="form-group">
                    <label for="name" class="content-type">Name</label>
                    <input type="text" id="name" name="name" class="input_field" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="ic" class="content-type">IC / Passport</label>
                    <input type="text" id="ic" name="ic" class="input_field" placeholder="IC/Passport">
                </div>

                <div class="form-group">
                    <label for="userid" class="content-type">User ID</label>
                    <input type="text" id="userid" name="userid" class="input_field" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="contact" class="content-type">Contact No.</label>
                    <input type="text" id="contact" name="contact" class="input_field" placeholder="Contact">
                </div>

                <div class="form-group">
                    <label for="email" class="content-type">Email</label>
                    <input type="text" id="email" name="email" class="input_field" placeholder="Email">
                </div>

                <div class="form-group">
                    <label for="user_level" class="content-type">User level</label>
                    <select id="user_level" name="user_level">
                        <option value="staff" checked> STAFF</option>
                        <option value="manager"> MANAGER</option>
                    </select> 
                </div>

                

                <hr>
                <div class="edit_type">
                    <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure to delete this user?')" class="button button_delete">
                    <input type="submit" value="Submit" class="button button_submit" >
                </div>
            

            </form>
        </div>
    </main>
</body>
</html>