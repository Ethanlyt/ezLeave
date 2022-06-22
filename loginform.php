<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login page</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/loginform.css">

    <script src="javascript/loginform.js"></script>

    <!-- Line Awesome -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">  

</head>


<body>
    <form class="login" name="login" method="POST" action="">
        <div class="login_head">
            <a href="index.html" class="login_back"><i class="las la-arrow-left"></i></a>
            <h1><i class="lab la-envira"></i> Welcome to EzLeave</h1>
        </div>

        <h2 class="login_title"><i class="las la-sign-in-alt"></i> Log in</h2>

        <div class="login_fields">
            <div class="form-group">
                <input class="login_field text_field" type="text" name="username" id="username" placeholder=" " required>
                <label class="login_label text_overlay" for="username" >Username</label>
            </div>
            <div class="form-group">
                <input class="login_field text_field" type="password" name="password" id="password" placeholder=" " required>
                <label class="login_label text_overlay" for="password">Password</label>
               
                <div style="padding-top:2% ;">
                    <input class="checkbox view_password" type="checkbox"  onclick="reviewPassword()">
                    <label for="view_password" class="checkbox_label">Show Password</label>
                </div>

            </div>
            <div>
                <input class="checkbox remember_me" type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me" class="checkbox_label">Remember Me</label>
            </div>

            <input type="submit" class="button login_button" id="login_button"/>

        </div>
    </form>
    
</body>
</html>