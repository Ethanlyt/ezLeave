<?php
    $is_signed_in = isset($_SESSION) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>


<nav class="nav padded-container">
    <a href="." class="nav-brand">
        <i class="nav-brand-img lab la-envira"></i>
        <span class="nav-brand-title">EzLeave</span>
    </a>
    <ul class="nav-menu">

        <?php
            //* Navigation menu items are generated based on whether user is logged in, and what's the user level
            if ($is_signed_in) {
                $username = $_SESSION['user']['username'];
                $user_level = $_SESSION['user']['user_level'];

                echo "
                <li class='nav-item'>
                    <a href='adminform.php'>$username</a>
                </li>
                ";
                if ($user_level === 'STAFF') echo '
                <li class="nav-item">
                    <a href="staffForm.php"><i class="las la-copy"></i>Apply</a>
                </li>
                ';
                echo '
                <li class="nav-item">
                    <a href="logout.php"><i class="las la-sign-out-alt"></i>Log out</a>
                </li>
                ';
            }
            else echo '
            <li class="nav-item">
                <a href="loginform.php"><i class="las la-sign-in-alt"></i>Sign in</a>
            </li>
            ';
        ?>

    </ul>
</nav>