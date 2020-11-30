<?php
	session_start();
	require('db.php');
	error_reporting(E_ALL);
   // If form is submitted, insert values into the database.
	if (isset($_POST['submit'])){
		$username = stripslashes($_REQUEST['username']); //removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
      $password = mysqli_real_escape_string($con,$password);	
		$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
		{
			die('Connection error'.mysqli_connect_error);
		}
	$connectDb = mysqli_select_db($conn,'bacs');
	
	//Checking if user exists in the database or not
	$query = "SELECT password, user_type FROM `users` WHERE username='$username' and password='$password' and account_status='Enabled'";
	$result = mysqli_query($conn,$query);
	$_SESSION['rows'] = mysqli_fetch_array($result);
	mysqli_close($conn); 
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
		while($GLOBALS['rows'] = mysqli_fetch_assoc($result)) 
		{
			echo "1 results";
		}	   	
		$_SESSION["username"] = $username; //pass to session since it was verified
		
		if ($_SESSION['rows']['user_type']== "admin" ) 
		{
			echo '<script language="javascript">';
			echo 'alert($_SESSION["username"])';
			echo '</script>';
			$_SESSION["loguser"]=$_SESSION["username"];
			header("Location:final-admin-profile.php");
		} 
		elseif ($_SESSION['rows']['user_type']== "reviewer") 
		{
			$_SESSION["loguser"]=$_SESSION["username"];
			header("Location: review-profile.php");
		} 
		elseif ($_SESSION['rows']['user_type']== "user") 
		{
			$_SESSION["loguser"]=$_SESSION["username"];
			header("Location: user-ll-create.php");
		}
	}
	else 
	{
     	echo '<script language="javascript">';
	   echo 'alert("Either your Username/Password is incorrect or your account is disabled! Please try again or contact your System Administrator for assistance.")';
		echo '</script>';
	}	
}	
?>
<?php
function password_hint()
{
	$usernamehint = $_POST['username'];
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
	$query = "select * from users where username = '$usernamehint'";
	$result = mysqli_query($conn,$query);
	$_SESSION['rows'] = mysqli_fetch_array($result);
	
	$hint= $_SESSION['rows']['password_hint'];
	echo "Hint: ".$hint;
	if (mysqli_num_rows($result) > 0) {
	  
	} 
	else 
	{  
	}	
	mysqli_close($conn);		
}
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v4.11.6, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Bluefish 2.2.10" >
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="image/bacslogo.png" type="image/x-icon">
  <meta name="description" content=""> 
  <title>BACS QLL IS Login</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/animatecss/animate.min.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
<style>
.form-control {
   background-color: #f5f5f5;
   box-shadow: none;
   color: #565656;
   line-height: 0.3;
   min-height: .5em;
   padding: .3em .5em;
	width: 100%!important;
}
.mb-4, .my-4 {
   margin-bottom: 1rem!important;
   margin-top: 1rem!important;
   margin: auto;
}
.p-5 {
   padding: 1rem!important;
}
.border-light {
	border-color: #ffffff!important;
}
.border {
   background-color: rgba(14, 13, 13, 0.5);
   border: 1px solid #dee2e6!important;
   border-radius: 20px;
   opacity: 1;
   filter: alpha(opacity=50);
}	
h2 {
	color: white!important;	
}
.btn-lg {
   padding: 0rem 1.2rem;
   border-radius: 3px;
}
a, a:hover {
   color: #ffc823;
}
.media-container-column > * {
   width: 100%;
}
p {
   margin-top: 1rem;
   margin-bottom: 1rem;
}
.cid-qTkAaeaxX5 .media-wrap img {
   height: 4rem!important;
}
.unstyled-button {
  	border: none;
  	padding: 0;
  	background: none;
}
</style>

</head>
<body>
<section class="mbr-fullscreen mbr-parallax-background" id="header2-14"><!--cid-rIzB3UKdR6-->
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35); 
    background-image: url('image/bacsbg.jpg'); background-repeat: no-repeat; background-size: 100% 100%;"></div>
    <div class="container align-center">
    	<div class="row justify-content-md-center">
        <div class="mbr-white col-md-10">
			<div class="container">
        		<div class="row justify-content-center">
            	<div class="media-container-column col-sm-6" data-form-type="formoid">			
					<form class="text-center border border-light p-5" name="login" action="" method="post">
					<h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
					<h1>Sign in</h1>

					<table style=""align="center">
					<tr><td></td><td><input type="text" class="form-control mb-4" name="username" placeholder="Username" required autocomplete="off" /></td>
					</tr><tr><td></td><td><input type="password" class="form-control mb-4" name="password" placeholder="Password"/></td>
					<td><button name="hint" style="color:gold;" class="unstyled-button" title="Hint">?</button></td>
					</tr>
					</table>
					<p style="margin:0;">
						<?php
							if(isset($_POST["hint"])){
							 password_hint(); 
							}
					 	?>
					</p>
					<input name="submit" class="btn btn-primary btn-lg" type="submit" value="Login" />
					<p style="font-size:12px!important;">Not registered yet? Please contact the <a href = "mailto: bacsquality@gmail.com">BACS QLL IS Admin.</a></p>
					<p><a href="forgotpassword.php">Forgot Password? </p></a>
					</form>
					</div>
				</div>               
          </div>
        </div>
    	</div>
    </div>
</section>

  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/nav-dropdown.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
  <script src="assets/parallax/jarallax.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script> 
  
  <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>
  <input name="animation" type="hidden">
</body>
</html>
