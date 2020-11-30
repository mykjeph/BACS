<?php
require('db.php');
include("auth.php");
$loguser=$_SESSION["loguser"];
$usernamecheck = ""; 
$usernamesuggestion ="";
$checkresult = "";
$username="";
$employeename = "";
$email = "";
error_reporting(E_ALL);

Loaddata(); //Call loading of data

Function Loaddata()
	{    
	  $username = $_SESSION['username'];
      $conn=mysqli_connect("localhost","root","","bacs");
      if (!$conn)
      {
        die('Connection error'.mysqli_connect_error);
      }
      $connectDb = mysqli_select_db($conn,'bacs');
      $query = "select * from users where username='$username' ";
      $result = mysqli_query($conn,$query);
      $_SESSION['rows'] = mysqli_fetch_array($result);
      if (mysqli_num_rows($result) > 0) 
		{
			while($GLOBALS['rows'] = mysqli_fetch_assoc($result)) 
			{
				echo "1 results";
			}
		} 
		else 
		{
			echo "0 results";
		}	
		   mysqli_close($conn);
	}  
//==============================Add New User==============================
Function Insert_LL_USER()
	{
	
	$result = "";
	$conn = "";
	$query = "";
	$x = 0;
	$rule_counter = 0;
		 
	require('db.php');
	include('db.php');
	if (isset($_POST['submit']))
	{
		$username = trim($_REQUEST['username']); //Remove leading and trailing spaces
		$username = mysqli_real_escape_string($con,$username); //Escapes special characters in a string
		$email = trim($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		//$password_hint = trim($_REQUEST['password_hint']);
		$password_hint = "";
		$password = trim($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		$employeename = trim($_REQUEST['employeename']);
		$employeename = mysqli_real_escape_string($con,$employeename);
		$employee_id = trim($_REQUEST['employee_id']);
		$employee_id = mysqli_real_escape_string($con,$employee_id);
		$position = trim($_REQUEST['position']);
		$position = mysqli_real_escape_string($con,$position);
		$delivery_team = trim($_REQUEST['delivery_team']);
		$delivery_team = mysqli_real_escape_string($con,$delivery_team);
		$functional_group = trim($_REQUEST['functional_group']);
		$functional_group = mysqli_real_escape_string($con,$functional_group);
		$user_type = trim($_REQUEST['user_type']);
		$user_type = mysqli_real_escape_string($con,$user_type);
		$conn=mysqli_connect("localhost","root","","bacs");
			
			if (!$conn)
			{
				die('Connection error'.mysqli_connect_error);
			}
			  
			$connectDb = mysqli_select_db($conn,'bacs');
			$query = "INSERT into `users` (username, email, password, password_hint, employeename, employee_id, position, delivery_team, functional_group, user_type , account_status) VALUES ('$username','$email','$password','$password_hint','$employeename', '$employee_id', '$position', '$delivery_team', '$functional_group', '$user_type', 'Enabled')";
			$result = mysqli_query($conn,$query);
			if (mysqli_affected_rows($conn) > 0)
			{
				$message = '
					<h3>Congratulations! Your account has been created.</h3>

					</br>
					<p>Please check your details below: </p>
					</br>
					<p>Employee Name: <b> '.$_POST["employeename"].' </b></p>
					<p>Username: <b> '.$_POST["username"].' </b></p>
					<p>Your Temporary Password: <b>'.$_POST["password"].'</b></p>
					<a href="http://3.21.91.216/BACS/all-login.php">Click here to login.</a>
					';

				require 'class/class.phpmailer.php';
				$mail = new PHPMailer;

				$mail->IsSMTP();								//Sets Mailer to send message using SMTP
				$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
				$mail->Port = '587';								//Sets the default SMTP server port
				$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
				$mail->Username = 'bacsquality@gmail.com';					//Sets SMTP username
				$mail->Password = 'May312020';					//Sets SMTP password
				$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
				$mail->From = $_POST["email"];					//Sets the From email address for the message
				$mail->FromName ='no-reply';				//Sets the From name of the message
				$mail->AddAddress($_POST["email"]);//Adds a "To" address
				$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
				$mail->IsHTML(true);							//Sets message type to HTML
								
				$mail->Subject = 'BACS LL User Creation';				//Sets the Subject of the message
				$mail->Body = $message;							//An HTML or plain text message body
				if($mail->Send())								//Send an Email. Return true on success or false on error
				{
					echo '<script language="javascript">';
					echo 'alert("New user account has been created and temporary password sent to user e-mail successfully.")';
					echo '</script>';
				}	
			} 
			else 
			{	
				$suggestion_set = array();
				$rule_counter = 1;
				$x = 0;
				$string_suggestion = "";
				do 
				{
					switch($rule_counter)
					{
						  case "1":
							  $GLOBALS['usernamecheck'] = $employeename."123";
							  check_username();
							  if ($GLOBALS['checkresult'] == 1)
								{
								  $suggestion_set[$x] = $GLOBALS['usernamecheck'];
								  $x++;
								  $rule_counter++;
								}
							  else
								{
								  $rule_counter++;
								}
							break;
						  case "2":
							  $GLOBALS['usernamecheck'] = $employeename."456";
							  check_username();
							  if ($GLOBALS['checkresult'] == 1)
								  {
									$suggestion_set[$x] = $GLOBALS['usernamecheck'];
									$x++;
									$rule_counter++;
								  }
							  else
								  {
									$rule_counter++;
								  }
							break;
						  case "3":
							$GLOBALS['usernamecheck'] = substr($email, 0, 5)."001";
							check_username();
							if ($GLOBALS['checkresult'] == 1)
								{
								  $suggestion_set[$x] = $GLOBALS['usernamecheck'];
								  $x++;
								  $rule_counter++;
								}
							else
								{
								  $rule_counter++;
								}
						  break;
						  case "4":
							$GLOBALS['usernamecheck'] =substr($email, 0, 3)."12345";
							check_username();
							if ($GLOBALS['checkresult'] == 1)
								{
								  $suggestion_set[$x] = $GLOBALS['usernamecheck'];
								  $x++;
								  $rule_counter++;
								}
							else
								{
								  $rule_counter++;
								}
						  break;
						case "5":
						  $GLOBALS['usernamecheck'] = substr($email, 0, 5)."XYZ";
						  check_username();
						  if ($GLOBALS['checkresult'] == 1)
							  {
								$suggestion_set[$x] = $GLOBALS['usernamecheck'];
								$x++;
								$rule_counter++;
							  }
						  else
							  {
								$rule_counter++;
							  }
						  break;
						default:
							  $x=3; 
							  break;
					}
				} 
				while ($x < 3);
				echo "ID already in use! System Suggestions: $suggestion_set[0] , $suggestion_set[1] , $suggestion_set[2]";
			}
			mysqli_close($conn);
		}
	}
//==============================Functions Area==============================
 Function check_username()
	{
		$usernamecheck = $GLOBALS["usernamecheck"];
		$checkresult = 0;
		$conn=mysqli_connect("localhost","root","","bacs");
		if (!$conn)
        {
          die('Connection error'.mysqli_connect_error);
        }
		$connectDb = mysqli_select_db($conn,'bacs');
		$query = "select * from users where username='$usernamecheck'";
		$result = mysqli_query($conn,$query);
        $_SESSION['rows'] = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0) 
		{
            $GLOBALS['checkresult'] = "0";
		}
        else 
		{
            $GLOBALS['checkresult'] = "1";
		}	
         mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>LL Admin | Dashboard</title>
  <link rel="shortcut icon" href="image/bacslogo.png" type="image/x-icon">
  
  <!--Tell the browser to be responsive to screen width-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--Font Awesome-->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!--Ionicons-->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!--Tempusdominus Bbootstrap 4-->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!--iCheck-->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!--JQVMap-->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!--Theme style-->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--overlayScrollbars-->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!--Daterange picker-->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!--summernote-->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!--Google Font: Source Sans Pro-->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<style>
  .dropdown-menu-lg {
    max-width: 300px;
    min-width: 0!important;
    padding: 0;
}
</style>

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
	</nav><!--/.Navbar-->

	<!--Main Sidebar Container-->
  	<aside class="main-sidebar sidebar-dark-primary elevation-4">
   
   <!--BACS Logo-->
   <center>
   <a href="#" class="brand-link">
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
                	<a href="final-admin-add-new-LL-user.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New User Profile</p>
                	</a>
              		</li>
			   
			   		<li class="nav-item">
                	<a href="final-admin-edit-users-profile.php" class="nav-link">
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
                	<a href="admin-LL-create.php" class="nav-link">
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

	<!--Content Wrapper. Contains Page Content-->
  	<div class="content-wrapper">
   	<!--Content Header (Page Header)-->
    	<div class="content-header">
      <div class="container-fluid">
      	<div class="row mb-2">
         	<div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New User</h1>
          	</div><!--/.col-->
          	<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              	<li class="breadcrumb-item"><a href="final-admin-profile.php">LL Admin</a></li>
              	<li class="breadcrumb-item active">Create New User Profile</li>
            </ol>
          	</div><!--/.col-->
        	</div><!--/.row-->
      </div><!--/.container-fluid-->
    	</div><!--/.content-header-->

	<!--Main content-->
   <section class="content">
   	<div class="container-fluid">
      	<!--Small boxes (Stat box)-->
        	<div class="row">
         	<!--./col-->
        	</div><!--/.row-->
        
        	<!--Main row-->
        	<div class="row" style="max-width:45%!important;">
         	<!--Left col-->
          	<section class="col">
            	<!--Custom tabs (Charts with tabs)-->
            	<div class="card">
              	<div class="card-header">
               </div><!--/.card-header-->
              	
              	<div class="card-body">
               <div class="tab-content p-0">
               
               <!--User Data Form-->
               <div class="chart tab-pane active" id="" style="position: relative; height: 700px;">
					<?php
						if(array_key_exists('submit', $_POST)) 
						{ 
							Insert_LL_USER();
						} 
					?>
					<center><form class="" name="registration" action="" method="post">
					</br>
					</br>
					<table>
						<tr><td>Username:</td><td><input type="text" class="" name="username" placeholder="Username" autocomplete="off" size="50" required /></td></tr>    
						<tr><td>Password:</td><td><input type="text" class="" name="password" placeholder="Password" autocomplete="off" size="50" required /></td></tr>
						<!--<tr><td>Password Hint:</td><td><input type="text" class="" name="password_hint" placeholder="password hint" autocomplete="off" size="50" readonly /></td></tr>-->
						<tr><td>Email:</td><td><input type="email" class="" name="email" placeholder="Email e.g. example@email.com" autocomplete="off" size="50"required /></td></tr>
						<tr><td>Employee Name:</td><td><input type="text" class="" name="employeename" placeholder="Employee Name" autocomplete="off" size="50" required /></td></tr>
						<tr><td>Employee ID:</td><td><input type="text" class="" name="employee_id" placeholder="Employee ID" autocomplete="off" size="50" required /></td></tr>
						<tr><td>Position:</td><td><input type="text" class="" name="position" placeholder="Position" autocomplete="off" size="50" required /></td></tr>
                  <tr><td>Delivery Team:</td><td>
					   <select style=" width: 100%;" class="" name="delivery_team">
						<option value="" disabled selected>Select Delivery Team</option>
                  <option value="At-Grade Works">At-Grade Works</option>
						<option value="Core Team">Core Team</option>
						<option value="Deep Underground Stations">Deep Underground Stations</option>
						<option value="Elevated Stations">Elevated Stations</option>
						<option value="Main Stations">Main Stations</option>
						<option value="Road Works">Road Works</option>
						<option value="Surface Stations">Surface Stations</option>
						<option value="Track and Depots">Track and Depots</option>
                  <option value="Utility Diversions">Utility Diversions</option>
                  <option value="Viaducts">Viaducts</option>
						<option value="Others">Others</option>
                  </select></td></tr>
						<tr><td>Functional Group: </td><td>
						<select style="width: 100%;" class=""  name="functional_group">
						<option selected="true" disabled="disabled">Select Functional Group</option>
                  <option value="Construction">Construction</option>
                  <option value="CMT">CMT</option>
                  <option value="CTMT">CTMT</option>
                  <option value="CWJV Assurance">CWJV Assurance</option>
                  <option value="DCC">DCC</option>
						<option value="Engineering">Engineering</option>
                  <option value="HR and Admin Services">HR and Admin Services</option>
                  <option value="IS&T">IS&T</option>
                  <option value="MEP">MEP</option>
						<option value="Procurement">Procurement</otion>
                  <option value="Project Field Engineering">Project Field Engineering</option>
                  <option value="Quality">Quality</option>
						<option value="Risk Management">Risk Management</option>
                  <option value="Safety">Safety</option>
                  <option value="Subcontracts">Subcontracts</option>
                  <option value="Others">Others</option>
                  </select></td></tr>
						<tr><td>User Type:</td><td>
                  <select style="width: 100%;" class="" name="user_type" >
						<option selected="true" disabled="disabled">Select User Type</option>
                  <option value="admin">LL Admin</option>
                  <option value="reviewer">LL Reviewer</option>
                  <option value="user">LL User</option>
                  </select></td></tr>
						</table>
						</br>
						</br>
						<input style="" type="submit" class="btn btn-primary btn-lg" name="submit" value="Add User" /></center>
						</form>                 
                  </div>
				   
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                  </div>  
                	</div>
              		</div><!--/.card-body-->
            	
            	</div><!--/.card-->
              	<!--/.card-header-->
              	<div class="card-body pt-0">
               <!--Calendar-->
               <div id="calendar" style="width: 100%"></div>
              	</div><!--/.card-body-->
            	</div><!--/.card-->
          	
          	</section>
          	<!--right col-->
        	</div><!--/.row (main row)-->
      </div><!--/.container-fluid-->
    	</section>
 		<!--/.content-->
	</div><!--/.Content Wrapper-->
	
  	<footer class="main-footer">
   <strong>Copyright &copy; 2020 <a href="https://sa.linkedin.com/in/michael-joseph-mangulabnan-48200598">M.J.S. Mangulabnan</a>.</strong>
   All rights reserved.
   <div class="float-right d-none d-sm-inline-block">
   Internal Release Number: <b>M-BAC-000000-GQ00-SRS-000001 Rev. 001</b>
   </div>
  	</footer>

  	<!--Control Sidebar-->
  	<aside class="control-sidebar control-sidebar-dark">
   <!--Control sidebar content goes here-->
  	</aside>
  	<!--/.control-sidebar-->
	
</div>
<!--./Wrapper-->

<!--jQuery-->
<script src="plugins/jquery/jquery.min.js"></script>
<!--jQuery UI 1.11.4-->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!--Resolve conflict in jQuery UI tooltip with Bootstrap tooltip-->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!--Bootstrap 4-->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--ChartJS-->
<script src="plugins/chart.js/Chart.min.js"></script>
<!--Sparkline-->
<script src="plugins/sparklines/sparkline.js"></script>
<!--JQVMap-->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!--jQuery Knob Chart-->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!--daterangepicker-->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!--Tempusdominus Bootstrap 4-->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!--Summernote-->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!--overlayScrollbars-->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!--AdminLTE App-->
<script src="dist/js/adminlte.js"></script>
<!--AdminLTE dashboard demo (This is only for demo purposes)-->
<script src="dist/js/pages/dashboard.js"></script>
<!--AdminLTE for demo purposes-->
<script src="dist/js/demo.js"></script>
</body>
</html>