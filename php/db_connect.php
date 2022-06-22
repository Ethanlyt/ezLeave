<?php

    //!=============================
    //! Change the value as required!
    define("HOSTNAME", "localhost");
    define("USERNAME", "ezleave");
    define("PASSWORD", "123456");
    define("DATABASE", "ezleave");
    //!=============================

    $conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) die("Error in connecting to database. <br> " . $conn->error);
?>