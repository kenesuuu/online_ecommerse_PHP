<?php include('../config/constants.php'); ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/login.css">
	<link rel="shortcut icon" href="../img/logo.png" />
</head>
<body>
	<header>
		<div class="logo"><img src="logo.png" alt="Logo"></div>
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h1>Login</h1>
      <?php
         if(isset($_SESSION['login']))
         {
            echo$_SESSION['login'];
            unset($_SESSION['login']);
         }
         if(isset($_SESSION['no-login-message']))
         {
            echo$_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
         }
      ?>

		<form action="" method="POST">
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>

			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>

			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>

			<button type="submit" name="submit" value="Login">Login</button>
		</form>
	</main>
	<footer>
		<div class="logo"><img src="logo.png" alt="Logo"></div>
		<p>&copy; 2023 My Company. All rights reserved.</p>
	</footer>
</body>
</html>

<?php

    #Check whther the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        #Process for Login
        #Get the Data from Login Form
        echo $email = $_POST['email'];
        echo $username =$_POST['username']; 
        echo $password =md5($_POST['password']);

        #SQL to check whther the user with user and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE email='$email' AND username='$username' AND password='$password'";
        #Execute the Query
        $res = mysqli_query($conn, $sql);
        #Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            #User available and Log in Success
            $_SESSION['login']="<div class='success'>Login Successfully.</div>";
            #To check whether the user is logged in or not and logout will unset it
            $_SESSION['e_mail'] = $email; 
            #Redirect to Hompage or Dashboard
            header('location:'.SITEURL.'admin/');
        }   
        else
        {
            #User not available and Log in Failed
            $_SESSION['login']="<div class='error text-center'>Username/Email or Password did not match.</div>";
            #Redirect to Hompage or Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

    }


?>