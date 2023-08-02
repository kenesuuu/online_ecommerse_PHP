<?php
include('../config/constants.php');

$success = 0;
$user = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $name = $_POST['customer_name'];
   $username = $_POST['username'];
   $email = $_POST['customer_email'];
   $phone_no = $_POST['phone_no'];
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];

   $sql = "SELECT * FROM tbl_user WHERE customer_email='$email' AND username = '$username' AND id='$id'";
   $res = mysqli_query($conn, $sql);

   if ($res) {
      $count = mysqli_num_rows($res);

      if ($count > 0) {
         $user = 1;
      } else {
         if ($password === $cpassword) {
            $hash = password_hash($password, PASSWORD_BCRYPT);

            $insert = "INSERT INTO tbl_user (customer_name, username, customer_email, phone_no, password) 
            VALUES ('$name', '$username', '$email', '$phone_no', '$hash')";
            $res2 = mysqli_query($conn, $insert);

            if ($res2) {
               $success = 1;
               $id = mysqli_insert_id($conn); // Get the last inserted user ID
               // Store the user ID in a session or a cookie for future use

               header('location:' . SITEURL . 'auth/sign-in.php');
            }
         } else {
            $invalid = 1;
         }
      }
   }
}
?>




<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sign-up</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../img/logo.png" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../css/libs.min.css">
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../css/sign-up.css">  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="container-fluid bg-circle-login">
         <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 col-xl-4">               
               <div class="d-flex justify-content-center mb-0">
                  <div class="card-body mt-5">
                     <a href="../index.php">
                        <img src="../img/logo.png" class="img-fluid logo-img" alt="img5">
                     </a>
                     <h2 class="mb-2 text-center">Sign Up</h2>
                     <p class="text-center">Create your Amari's Account.</p>
                     <form method="POST">
                     <?php
                        if($success)
                        {
                           echo"<div><p>You are Successfully Signed up.</p></div>";
                        }
                        ?>
                        <?php
                        if($invalid)
                        {
                           echo"<div><p><strong>Password did not Match.</strong></p></div>";
                        }
                        ?>
                        <div class="row">
                        <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="full-name" class="form-label">Full Name</label>
                                 <input type="text" class="form-control form-control-sm" name="customer_name" placeholder=" ">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="full-name" class="form-label">Username</label>
                                 <input type="text" class="form-control form-control-sm" name="username" placeholder=" ">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="email" class="form-label">Email</label>
                                 <input type="email" class="form-control form-control-sm" name="customer_email" placeholder=" ">
                              </div>
                           </div>

                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="tel" class="form-label">Phone No.</label>
                                 <input type="tel" class="form-control form-control-sm" name="phone_no" placeholder=" ">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="password" class="form-label">Password</label>
                                 <input type="password" class="form-control form-control-sm" name="password" placeholder=" ">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="confirm-password" class="form-label">Confirm Password</label>
                                 <input type="password" class="form-control form-control-sm" name="cpassword" placeholder=" ">
                              </div>
                           </div>
                        </div>
                        <div class="d-flex justify-content-center">
                           <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                        <p class="mt-3 text-center">
                           Already have an Account? <a href="../auth/sign-in.php" class="text-underline">Sign In</a>
                        </p>
                     </form>
                  </div>
               </div>          
            </div>  
            <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
               <img src="../img/logo.png" class="img-fluid sign-in-img" alt="images">
            </div>
         </div>
      </section>
      </div>


    <!-- Required Library Bundle Script -->
    <script src="/js/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="/js/external.min.js"></script>
    
    <!-- Mapchart JavaScript -->
    <script src="/js/dashboard.js"></script>
    
    <!-- fslightbox JavaScript -->
    <script src="/js/fslightbox.js"></script>
    
    <!-- app JavaScript -->
    <script src="/js/app.js"></script>
    
    <!-- moment JavaScript -->
    <script src="/js/moment.min.js"></script>  </body>
</html>