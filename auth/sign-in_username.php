<?php include('../config/constants.php'); ?>

<?php
$login=0;
$invalid=0;
if($_SERVER['REQUEST_METHOD']=='POST')
{
   $username=$_POST['username'];
   $password=$_POST['password'];

   $sql="SELECT * FROM tbl_user WHERE username ='$username' AND password='$password'";

   $res=mysqli_query($conn,$sql);
   if($res)
   {
      $row=mysqli_fetch_assoc($res);
      if(password_verify($password, $row['password']))
      {
         $login=1;
         $_SESSION['e-mail']=$username;
         header('location:'.SITEURL);
      }
      else
      {
         $invalid=1;
      }
   }
}

?>

<?php
if($invalid)
{
   echo"<div><p><strong>Invalid Password</strong></p></div>";
}
?>
<?php
if($login)
{
   echo"<div><p>You are Sucessfully Logged in.</p></div>";
}

if(isset($_SESSION['no-login-message']))
{
   echo$_SESSION['no-login-message'];
   unset($_SESSION['no-login-message']);
}
?>


<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sign in</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../img/logo.png" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../js/libs.min.css">
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../css/sign-up.css">  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    
      <div class="wrapper">
      <section class="container-fluid bg-circle-login" id="auth-sign">
         <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 col-xl-4">
               <div class="card-body">
                  <a href="../index.php">
                     <img src="../img/logo.png" class="img-fluid logo-img"  alt="logo">
                  </a>
                           <h2 class="mb-2 text-center">Sign In</h2>
                           <p class="text-center">Sign in to stay connected.</p>
                           <form method="POST">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="text" class="form-label">Username</label>
                                       <input type="text" class="form-control form-control-sm" name="username" id="username" aria-describedby="username" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="password" class="form-label">Password</label>
                                       <input type="password" class="form-control form-control-sm" name="password" id="password" aria-describedby="password" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check mb-3">
                                       <input type="checkbox" class="form-check-input" id="customCheck1">
                                       <label class="form-check-label" for="customCheck1">Remember Me</label>
                                    </div>
                                    <a href="recoverpw.html">Forgot Password?</a>
                                 </div>
                              </div>
                              <div class="d-flex justify-content-center">
                                 <button type="submit" class="btn btn-primary">Sign In</button>
                              </div>
                              <p class="mt-3 text-center">
                                 Don’t have an account? <a href="../auth/sign-up.php" class="text-underline">Click here to sign up.</a>
                              </p>
                              <p class="mt-3 text-center">
                                 Log into email? <a href="../auth/sign-in.php" class="text-underline">Click here to sign in.</a>
                              </p>
                           </form>
                        </div>
            </div>
            <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
               <img src="../img/logo.png" class="img-fluid sign-in-img" alt="images">

            </div>
         </div>
      </section>
      </div>

      
    
    <!-- Required Library Bundle Script -->
    <script src="../js/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="../js/external.min.js"></script>
    
    <!-- Mapchart JavaScript -->
    <script src="../js/dashboard.js"></script>
    
    <!-- fslightbox JavaScript -->
    <script src="../js/fslightbox.js"></script>
    
    <!-- app JavaScript -->
    <script src="../js/app.js"></script>
    
    <!-- moment JavaScript -->
    <script src="../js/moment.min.js"></script>  </body>
</html>