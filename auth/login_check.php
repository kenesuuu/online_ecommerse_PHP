<?php 
if(!isset($_SESSION['e-mail'])){ // if user is not logged in
   $_SESSION['no-login-message'] = '<div><p>Please login first!</p></div>'; // set message to display
   header('location:'.SITEURL.'auth/sign-in.php'); // redirect to login page
}
?>