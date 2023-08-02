<?php
    #Include constantts.php for SITEURL
    include('../config/constants.php');

    #Destroy the Session
    session_destroy(); #$Unset $_SESSION['user'];

    #Redirect to Login page
    header('location:'.SITEURL.'auth/sign-in.php');
?>