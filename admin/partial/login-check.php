

<?php
   #Check whether the user is logged in or not
   #Authorization- Access Control
    if(!isset($_SESSION['e_mail'])) #If user session is not set 
    {
        #user is not logged in
        #redirect to login page with message
        $_SESSION['no-login-message']= "<div class='error text-center'>Please login to access Admin Panel.</div>";
        #Redirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
    }
?>