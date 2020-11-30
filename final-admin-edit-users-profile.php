<?php
include("auth.php");
$loguser=$_SESSION["loguser"];
$_SESSION['holderuser']=$_SESSION['username2'];
$_SESSION['username2'] = "";
$_SESSION['password'] = "";
$_SESSION['password_hint'] = "";
$_SESSION['employeename'] = "";
$_SESSION['employee_id'] = "";
$_SESSION['position'] = "";
$_SESSION['delivery_team'] = "";
$_SESSION['functional_group'] = "";
$_SESSION['email'] = "";
$_SESSION['user_type'] = "";
$_SESSION['additional_details'] = "";
$_SESSION['account_status'] = "";
$_SESSION['usernameholder'] = "";

//==============================Functions Area==============================		
Function update_user()
{ 
	$username1=trim($_POST['username1']);
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
		$username1 = $_POST['username1'];
		$updpass = $_POST['password'];
		$updpasshint = $_POST['password_hint'];
		$updemployeename = $_POST['employeename'];
		$updemployee_id = $_POST['employee_id'];
		$updposition = $_POST['position'];
		$upddelivery_team = $_POST['delivery_team'];
		$updfunctional_group = $_POST['functional_group'];
		$updemail = $_POST['email'];
		$upduser_type = $_POST['user_type'];
		$updadditional_details = $_POST['additional_details'];
		$updaccount_status = $_POST['account_status'];
				
	
	$update = "UPDATE users SET password='$updpass'
	,password_hint='$updpasshint',employeename='$updemployeename'
	,employee_id='$updemployee_id',position='$updposition'
	,delivery_team='$upddelivery_team',functional_group='$updfunctional_group'
	,email='$updemail',user_type='$upduser_type',additional_details='$updadditional_details'
	,account_status='$updaccount_status' WHERE username='$username1'";
	
	$result = mysqli_query( $conn, $update);	
	mysqli_close($conn);
	$_SESSION['usernameholder']= $username1;
	
		echo '<script language="javascript">';
		echo 'alert("Profile updated successfully.")';
		echo '</script>';
}
?>
<?php
Function user_load()
{ 	
	$username2=trim($_POST['username2']);	
	
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
	$query = "select * from users where username = '$username2'";
	$result = mysqli_query($conn,$query);
	$_SESSION['rows'] = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) > 0) {
    	$_SESSION['username2'] = $_SESSION['rows']['username'];
		$_SESSION['password'] = $_SESSION['rows']['password'];
		$_SESSION['password_hint'] = $_SESSION['rows']['password_hint'];
		$_SESSION['employeename'] = $_SESSION['rows']['employeename'];
		$_SESSION['employee_id'] = $_SESSION['rows']['employee_id'];
		$_SESSION['position'] = $_SESSION['rows']['position'];
		$_SESSION['delivery_team'] = $_SESSION['rows']['delivery_team'];
		$_SESSION['functional_group'] = $_SESSION['rows']['functional_group'];
		$_SESSION['email'] = $_SESSION['rows']['email'];
		$_SESSION['user_type'] = $_SESSION['rows']['user_type'];
		$_SESSION['additional_details'] = $_SESSION['rows']['additional_details'];
		$_SESSION['account_status'] = $_SESSION['rows']['account_status'];
		$_SESSION['disable_comment'] = $_SESSION['rows']['disable_comment'];		
	}
mysqli_close($conn);
}
?>
<?php
Function user_load2()
{ 	
	$username2=$_SESSION['usernameholder'];	
	
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
	$query = "select * from users where username = '$username2'";
	$result = mysqli_query($conn,$query);
	$_SESSION['rows'] = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) > 0) {
    	$_SESSION['username2'] = $_SESSION['rows']['username'];
		$_SESSION['password'] = $_SESSION['rows']['password'];
		$_SESSION['password_hint'] = $_SESSION['rows']['password_hint'];
		$_SESSION['employeename'] = $_SESSION['rows']['employeename'];
		$_SESSION['employee_id'] = $_SESSION['rows']['employee_id'];
		$_SESSION['position'] = $_SESSION['rows']['position'];
		$_SESSION['delivery_team'] = $_SESSION['rows']['delivery_team'];
		$_SESSION['functional_group'] = $_SESSION['rows']['functional_group'];
		$_SESSION['email'] = $_SESSION['rows']['email'];
		$_SESSION['user_type'] = $_SESSION['rows']['user_type'];
		$_SESSION['additional_details'] = $_SESSION['rows']['additional_details'];
		$_SESSION['account_status'] = $_SESSION['rows']['account_status'];	
		$_SESSION['disable_comment'] = $_SESSION['rows']['disable_comment'];
	}
mysqli_close($conn);
}
?>
<?php
Function user_load3()
{ 	
	$username=trim($_SESSION['username']);	
	
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
	$query = "select * from users where username = '$username'";
	$result = mysqli_query($conn,$query);
	$_SESSION['rows'] = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) > 0) {
    	$_SESSION['username'] = $_SESSION['rows']['username'];
		$_SESSION['password'] = $_SESSION['rows']['password'];
		$_SESSION['password_hint'] = $_SESSION['rows']['password_hint'];
		$_SESSION['employeename'] = $_SESSION['rows']['employeename'];
		$_SESSION['employee_id'] = $_SESSION['rows']['employee_id'];
		$_SESSION['position'] = $_SESSION['rows']['position'];
		$_SESSION['delivery_team'] = $_SESSION['rows']['delivery_team'];
		$_SESSION['functional_group'] = $_SESSION['rows']['functional_group'];
		$_SESSION['email'] = $_SESSION['rows']['email'];
		$_SESSION['user_type'] = $_SESSION['rows']['user_type'];
		$_SESSION['additional_details'] = $_SESSION['rows']['additional_details'];
		$_SESSION['account_status'] = $_SESSION['rows']['account_status'];	
		$_SESSION['disable_comment'] = $_SESSION['rows']['disable_comment'];
	}
mysqli_close($conn);
		$_SESSION['username2']=$_SESSION['username'];
}
?>
<?php

Function enable_disable()
{
$username1=trim($_POST['username1']);
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
		$username1 = $_POST['username1'];
		$updpass = $_POST['password'];
		$updpasshint = $_POST['password_hint'];
		$updemployeename = $_POST['employeename'];
		$updemployee_id = $_POST['employee_id'];
		$updposition = $_POST['position'];
		$upddelivery_team = $_POST['delivery_team'];
		$updfunctional_group = $_POST['functional_group'];
		$updemail = $_POST['email'];
		$upduser_type = $_POST['user_type'];
		$updadditional_details = $_POST['additional_details'];
		if($_POST['account_status']=="Enable")
		{
		$updaccount_status = "Disabled";
		}
		else
		{
		$updaccount_status = "Enabled";	
		}
	$update = "UPDATE users SET password='$updpass'
	,password_hint='$updpasshint',employeename='$updemployeename'
	,employee_id='$updemployee_id',position='$updposition'
	,delivery_team='$upddelivery_team',functional_group='$updfunctional_group'
	,email='$updemail',user_type='$upduser_type',additional_details='$updadditional_details'
	,account_status='$updaccount_status' WHERE username='$username1'";
	
	$result = mysqli_query( $conn, $update);	
	mysqli_close($conn);
	$_SESSION['usernameholder']= $username1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <title>LL Admin | Dashboard </title>
  <link rel="shortcut icon" href="image/bacslogo.png" type="image/x-icon">
  
  <!--Font Awesome Icons-->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!--IonIcons-->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!--Theme style-->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--Google Font: Source Sans Pro-->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<style>
	.dropdown-menu-lg {
	max-width: 300px;
   min-width: 0!important;
   padding: 0;
	}
</style>
  
<script>
	$(document).ready(function(){
        $("#myModal").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
	<!--Navbar-->
  	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   	
   	<!--Left Navbar Links-->
    	<ul class="navbar-nav">
      	<li class="nav-item">
        	<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      	</li>
    	</ul> 
    	
		<!--Right Navbar Links-->
     	<ul class="navbar-nav ml-auto">         
      	<!--Notifications Dropdown Menu-->
      	<li class="nav-item dropdown">
        	<a class="nav-link" data-toggle="dropdown" href="#">
         <i class="fas fa-user"></i>       
        	</a>
        	<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <span class="dropdown-item dropdown-header">Admin</span>
         <div class="dropdown-divider"></div>
         <a href="final-admin-profile.php" class="dropdown-item">
         <i class="fas fa-user"></i> My Profile        
         </a>
         <div class="dropdown-divider"></div>
         <a href="all-login.php" class="dropdown-item">
         <i class="fas fa-sign-out-alt"></i> Logout          
         </a>       
      	</li>
      	
      	<li class="nav-item">
        	<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        	<i class="fas fa-th-large"></i></a>
      	</li>
    	</ul>
	</nav>
	<!--/.Navbar-->
	
	<!--Main Sidebar Container-->
  	<aside class="main-sidebar sidebar-dark-primary elevation-4">
   
   <!--BACS Logo-->
   <center>  <a href="#" class="brand-link">
	<img src="dist/img/AdminLTELogo.png" style="width:150px;"alt="" class="" style="opacity: .8">
	</br>
   <span class="brand-text font-weight-light">Quality Lessons Learned IS</span>
  	</a>
   </center>

	<!--Sidebar-->
   <div class="sidebar">
   	<!--Sidebar User Panel-->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      	<div class="image">
         <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        	</div>
        	<div class="info">
         <a href="final-admin-profile.php" class="d-block"><?php echo "Hello, " . $_SESSION["loguser"]."!"; ?></a>
        	</div>
      </div>
      
      <!--Sidebar Menu-->
      <nav class="mt-2">
      	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!--Add icons to the links using the .nav-icon class with font-awesome or any other icon font library-->
         	<li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Admin Panel</p>
            <i class="right fas fa-angle-left"></i> 
            </a>
            	<ul class="nav nav-treeview">
              		              
              		<li class="nav-item">
                	<a href="final-admin-add-new-LL-user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New User Profile</p>
                	</a>
              		</li>
			   		
			   		<li class="nav-item">
                	<a href="final-admin-edit-users-profile.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update User Profile</p>
                	</a>
              		</li> 
              		
              		<li class="nav-item">
                	<a href="final-admin-view-LL-users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User Profiles</p>
                	</a>
              		</li>   
            	</ul>
          	</li>  
        	</ul>
			
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!--Add icons to the links using the .nav-icon class with font-awesome or any other icon font library-->
         	<li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Self Panel</p>
            <i class="right fas fa-angle-left"></i> 
            </a>
            	<ul class="nav nav-treeview">
			 			<li class="nav-item">
                	<a href="final-admin-profile.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Profile</p>
                	</a>
              		</li>		  
            	</ul>
         	</li>  
        	</ul>
		
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!--Add icons to the links using the .nav-icon class with font-awesome or any other icon font library-->
         	<li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Lessons Learned Panel</p>
            <i class="right fas fa-angle-left"></i>
            </a>
            	<ul class="nav nav-treeview">
			 						 			
			 			<li class="nav-item">
                	<a href="admin-ll-create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New LL</p>
                	</a>
              		</li>	
              		
						<li class="nav-item">
                	<a href="admin-LL-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage LLs</p>
                	</a>
              		</li>	
              		
              		<li class="nav-item">
                	<a href="final-admin-LL-view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All LLs</p>
                	</a>
              		</li>	
              		
              		<li class="nav-item">
                	<a href="admin-ll-import.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Import Previous LL</p>
                	</a>
              		</li>						  
            	</ul>
          	</li>  
        	</ul>
			
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!--Add icons to the links using the .nav-icon class with font-awesome or any other icon font library-->
         	<li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Reports</p>
            <i class="right fas fa-angle-left"></i> 
            </a>
            	<ul class="nav nav-treeview">
			 			<li class="nav-item">
                	<a href="reportLLUsers.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customize LL Users Report</p>
                	</a>
              		</li>
              		
						<li class="nav-item">
                	<a href="reportLLdocument.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customize LL Report</p>
                	</a>
              		</li>					  
            	</ul>
          	</li>  
        	</ul>
		</nav><!--/.Sidebar Menu-->
	</div><!--/.Sidebar-->
	</aside>
	
   <div id="myModal" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title">Enable/Disable User Profile</h5>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body  centerthisinner">
<?php				
		if (isset($_POST['confirmaction']))
	{		
		$loguser=$_SESSION["loguser"];
		$userhold=$_SESSION['holderuser'];	
		$reason = trim($_REQUEST['reason']);
		$password = trim($_REQUEST['password']);
		
		$conn=mysqli_connect("localhost","root","","bacs");
		$connectDb = mysqli_select_db($conn,'bacs');
		$query = "select * from users where username = '$loguser' and password='$password'";
		$result = mysqli_query($conn,$query);
		if (mysqli_num_rows($result) > 0) {
		
		$connectDb = mysqli_select_db($conn,'bacs');
		$query = "select * from users where username = '$userhold'";
		$result = mysqli_query($conn,$query);
		$_SESSION['rows'] = mysqli_fetch_array($result);
		$_SESSION['accountstats']=$_SESSION['rows']['account_status'];
		$_SESSION['emailuse']=$_SESSION['rows']['email'];
		
			if($_SESSION['accountstats']=="Enabled")
			{
			$updaccount_status = "Disabled";
			}
			else
			{
			$updaccount_status = "Enabled";
				
			}
			$connectDb = mysqli_select_db($conn,'bacs');
			$query = "UPDATE users SET disable_comment='$reason',account_status='$updaccount_status' where username='$userhold' ";
			$result = mysqli_query($conn,$query);
				
				if($updaccount_status == "Enabled")
				{
					$connectDb = mysqli_select_db($conn,'bacs');
					$query = "UPDATE users SET disable_comment='' where username='$userhold' ";
					$result = mysqli_query($conn,$query);
					
				}			
			
					//$message = '
					//<h3>Admin make changes to your account</h3>
					//</br>
					//<p>Admin message: '.$reason.'</p>
					//<p>Account Status: '.$updaccount_status.'</p>
					//</br>							
					//';
				//require 'class/class.phpmailer.php';
				//$mail = new PHPMailer;
				//$mail->IsSMTP();								//Sets Mailer to send message using SMTP
				//$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
				//$mail->Port = '587';								//Sets the default SMTP server port
				//$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
				//$mail->Username = 'bacsquality@gmail.com';					//Sets SMTP username
				//$mail->Password = 'May312020';					//Sets SMTP password
				//$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
				//$mail->From = $_SESSION['emailuse'];					//Sets the From email address for the message
				//$mail->FromName ='no-reply';				//Sets the From name of the message
				//$mail->AddAddress($_SESSION['emailuse']);//Adds a "To" address
				//$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
				//$mail->IsHTML(true);							//Sets message type to HTML			
				//$mail->Subject = 'BACS LL User Update';				//Sets the Subject of the message
				//$mail->Body = $message;							//An HTML or plain text message body
				//if($mail->Send())								//Send an Email. Return true on success or false on error
				//{
									
				//}	
		}
		else{
			echo '<script language="javascript">';
			echo 'alert("Incorrect Admin Password!")';
			echo '</script>';
			
		}
mysqli_close($conn);				
     }
?> 
	  		<form action="" method="post" enctype="multipart/form-data">
			<input type="text" class="form-control mb-4" name="reason" placeholder="Reason for disabling/enabling account." required />
			<input type="password" class="form-control mb-4" name="password" placeholder="Admin Password"  required />
			</div>
			
			<div class="modal-footer">
			<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Cancel</button>
			<input type="submit" class="btn btn-primary btn-lg centerthisinner" name="confirmaction" value="Confirm" />
			</div>
			</form>
			</div>
		</div>
	</div>
	 
	<!--Content Wrapper. Contains Page Content-->
  	<div class="content-wrapper">
   	<!--Content Header (Page Header)-->
    	<div class="content-header">
      <div class="container-fluid">
      	<div class="row mb-2">
         	<div class="col-sm-6">
            <h1 class="m-0 text-dark">View / Update User Profile </h1>
          	</div><!--/.col-->
          	<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            	<li class="breadcrumb-item"><a href="final-admin-profile.php">LL Admin</a></li>
              	<li class="breadcrumb-item active">Update User Profile</li>
            </ol>
          	</div><!--/.col-->
        	</div><!--/.row-->
      </div><!--/.container-fluid-->
    	</div><!--/.content-header-->
    
	<!--Main content-->
   <div class="content">
   	<div class="container-fluid">
      	<div class="row">        
         <div class="card">		
         <div class="card-header border-0">
         <div class="d-flex justify-content-between">        
			<div style="align:center!important;"class="card-body">
				<?php
					if(isset($_POST["btn-user"]))
				  	{ 
						user_load(); 
				  	}
				  	else if(isset($_POST["btn-updateuser"]))
				  	{
					 	update_user();	
					
					 	user_load2();					
				  	}
				  	else if(isset($_POST["btn-onoff"]))
				  	{
					  enable_disable();
					  
					  user_load2();			 
				  	}
				   else if(isset($_SESSION['username']))
				   {	  
						user_load3(); 
				  	} 
				  	else
				  	{
						echo "No Function Required";  							  
				  	}
				  	?>
				  	<center><form method="POST">
					Enter Username: <input type="text" name="username2" placeholder="" size="30" autocomplete="off" required />			
					<input name="btn-user" class="btn btn-primary" type="submit" value="Show Details" />
					</form></center>
					
					<form class="text-center border border-light p-5" name="form" method="post" action=""> 
					<table style="text-align:left!important;">
					<tr><td>Username:</td><td><input type="text" name="username1" value="<?php echo $_SESSION['username2'] ;?>" placeholder=""  size="50" readonly/></td></tr>
					<tr><td>Password:</td><td><input type="text" name="password" value="<?php echo  $_SESSION['password'] ;?>"placeholder="" size="50" autocomplete="off"/></td></tr>
					<tr><td>Password Hint:</td><td><input type="text" name="password_hint" value="<?php echo  $_SESSION['password_hint'] ;?>"placeholder="" size="50" autocomplete="off"/></td></tr>
					<tr><td>Employee Name:</td><td>  <input type="text" name="employeename" value="<?php echo  $_SESSION['employeename'] ;?>" placeholder="" size="50" autocomplete="off"/></td></tr>
					<tr><td>Employee ID:</td><td>  <input type="text" name="employee_id" value="<?php echo  $_SESSION['employee_id'] ;?>" placeholder="" size="50" autocomplete="off"/></td></tr>
					<tr><td>Position:</td><td>  <input type="text" name="position" value="<?php echo  $_SESSION['position'] ;?>" placeholder=""  size="50" autocomplete="off"/></td></tr>
					<tr><td>Delivery Team:</td><td><input type="text" name="delivery_team" value="<?php echo  $_SESSION['delivery_team'] ;?>" placeholder="" size="50" autocomplete="off"/></td></tr>
					<tr><td>Functional Group:</td><td><input type="text" name="functional_group" value="<?php echo  $_SESSION['functional_group'] ;?>" placeholder=""  size="50" autocomplete="off"/></td></tr>
					<tr><td>Email:</td><td><input type="text" name="email" value="<?php echo  $_SESSION['email'] ;?>" placeholder="" size="50"  /></td></tr>
					<!--<tr><td>User Type:</td><td><input type="text" name="user_type" value="<?php echo  $_SESSION['user_type'] ;?>" placeholder="" size="50" autocomplete="off"  /></td></tr>-->
					
					<tr><td>User Type:</td><td>
               <select style="width: 100%;" class="" name="user_type" value="" placeholder="" size="" autocomplete="off">
					<option selected="true"><?php echo $_SESSION['user_type'] ;?></option>
               <option value="admin">LL Admin</option>
               <option value="reviewer">LL Reviewer</option>
               <option value="user">LL User</option>
               </select></td></tr>					
					
					<tr><td>Additional Details:</td><td><input type="text" name="additional_details" value="<?php echo  $_SESSION['additional_details'] ;?>" size="50" placeholder="" autocomplete="off"/></td></tr>					
					<tr><td>Account Status:</td><td><input type="text" name="account_status" value="<?php echo  $_SESSION['account_status'] ;?>" size="50" placeholder="" readonly/>
					<tr><td>Disable Comment:</td><td><input type="text" name="disable_comment" value="<?php echo  $_SESSION['disable_comment'] ;?>" size="50" placeholder="" readonly/>							
					<!--</select></td></tr>-->
					</table>
					</br>
					</br>
					<input name="btn-updateuser" class="btn btn-primary" style="margin:3px;" type="submit" value="Update" /> 
					<!--<input name="btn-updateuser" class="btn btn-primary" type="button" value="test" data-toggle="modal" data-target="#myModal" />-->
							<?php 
								if($_SESSION['username2'])
								{
									if($_SESSION['account_status']=="Enabled")
									{
										//echo '<input name="btn-onoff" class="btn btn-primary" type="submit" value="Disable">';
										echo '<input name="btn-updateuser" class="btn btn-primary" type="button" value="Disable" data-toggle="modal" data-target="#myModal" /> ';
									}
									else
									{	
										//echo '<input name="btn-onoff" class="btn btn-primary" type="submit" value="Enable">';
										echo '<input name="btn-updateuser" class="btn btn-primary" type="button" value="Enable" data-toggle="modal" data-target="#myModal" /> ';
																		
									}
								}
								else
								{
									echo '</br><br><h6 style="color:red">User data not found. Please try again.</h6>';
									//echo '<input name="btn-onoff" class="btn btn-primary" type="submit" value="disabled"/disabled>';
									//echo '<input name="btn-updateuser" class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal" value="disabled" disabled/> ';	
								}
							?>
					</form>					
					</div>
				   </div>			
				  	</div>	
				</div>
			  	</div><!--/.card-->
			  	</div><!--/.d-flex-->
		   </div>
		   </div>
			</div><!--/.col-md-6-->
		</div><!--/.row-->
		</div><!--/.container-fluid-->
		</div><!--/.content-->
	</div><!--/.Content Wrapper-->
  	
  	<!--Control Sidebar-->
  	<aside class="control-sidebar control-sidebar-dark">
   <!--Control sidebar content goes here-->
  	</aside>
  	<!--/.Control Sidebar-->

  	<!--Main Footer-->
  	<footer class="main-footer">
   <strong>Copyright &copy; 2020 <a href="https://sa.linkedin.com/in/michael-joseph-mangulabnan-48200598">M.J.S. Mangulabnan</a>.</strong>
   All rights reserved.
   <div class="float-right d-none d-sm-inline-block">
   Internal Release Number: <b>M-BAC-000000-GQ00-SRS-000001 Rev. 001</b>
   </div>
  	</footer>
  	
</div>
<!--./Wrapper-->

<!--REQUIRED SCRIPTS-->
<!--jQuery-->
<script src="plugins/jquery/jquery.min.js"></script>
<!--Bootstrap-->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--AdminLTE-->
<script src="dist/js/adminlte.js"></script>

<!--OPTIONAL SCRIPTS-->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
</body>
</html>