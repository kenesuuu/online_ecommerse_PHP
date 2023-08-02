<?php
    // Start Session
    session_start();


    //Create Constant to Store Non Repeating Values
    define('SITEURL','https://localhost/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'amari-softdesk');
    
    #Connection of admin to mysql
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selection Database

?>