<?php

require('db.php');
include("auth.php");
$usernamecheck = ""; 
$usernamesuggestion ="";
$checkresult = "";
$username="";
$employeename = "";
$email = "";
$loguser=$_SESSION["loguser"];
error_reporting(E_ALL);

Function Loaddata()
	{    
	  $username = $_SESSION["loguser"];
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
?>

<?php
Function Loaddata2()
	{    
		$username = $_SESSION["loguser"];
      $conn=mysqli_connect("localhost","root","","bacs");
      if (!$conn)
      {
        die('Connection error'.mysqli_connect_error);
      }
      $connectDb = mysqli_select_db($conn,'bacs');
      $query = "select * from users where username='$username' ";
      $result = mysqli_query($conn,$query);
      $_SESSION['rows'] = mysqli_fetch_array($result);
 
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
?>		
<?php

//==============================Functions Area==============================
Function update_user()
{ 
	$username=trim($_POST['username']);
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
		$username = $_POST['username'];
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
	,account_status='$updaccount_status' WHERE username='$username'";
	
	$result = mysqli_query( $conn, $update);	
	mysqli_close($conn);
	$_SESSION['usernameholder']= $username;

			echo '<script language="javascript">';
			echo 'alert("Profile updated successfully.")';
			echo '</script>';
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
	.dropdown-menu-lg
	{
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
	</nav>
  	<!--/.Navbar-->

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
         	<li class="nav-item has-treeview menu-close">
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
         	<li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Self Panel</p>
            <i class="right fas fa-angle-left"></i> 
            </a>
            	<ul class="nav nav-treeview">
			 			<li class="nav-item">
                	<a href="final-admin-profile.php" class="nav-link active">
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
                	<a href="final-admin-LL-view.php" class="nav-link ">
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
			</nav>
      	<!--/.Sidebar Menu-->
    	</div>
   	<!--/.Sidebar-->
	</aside>
	
	<!--Content Wrapper. Contains Page Content-->
  	<div class="content-wrapper">
   	<!--Content Header (Page header)-->
    	<div class="content-header">
      <div class="container-fluid">
        	<div class="row mb-2">
          	<div class="col-sm-6">
            <h1 class="m-0 text-dark">My Profile</h1>
          	</div><!--/.col-->
          	<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="final-admin-profile.php">LL Admin</a></li>
              <li class="breadcrumb-item active">My Profile</li>
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
      
      <!--Main Row-->
      <div class="row" style="max-width:55%!important;">
      	<!--Left col-->
         <section class="col">
         	<!--Custom tabs-->
            <div class="card">
            <div class="card-header">
            <h3 class="card-title">
            <i class="fas fa-user"></i>
            User Information
            </h3>
               
            </div><!--/.card-header-->
            <div class="card-body">
            <div class="tab-content p-0">
                  
            <!--User Data Table-->
            <div class="chart tab-pane active" id="" style="position: relative; height: 700px;">
                       
					<?php
				 	if(isset($_POST["btn-update"]))
				  	{
						update_user();	
						Loaddata2();				
				  	} 
				  	else if(isset($_SESSION['loguser']))
				  	{	  
						Loaddata2(); 
				  	} 
				  	else
				  	{
						//echo "No Function Required.";  							  
				  	}
					?>
						<form class="text-center border border-light p-5" name="profile" action="" method="post">			
						<center><table>
						<tr><td>Username:</td><td><input type="text" class="" name="username" placeholder="Username" value="<?php echo $_SESSION['username']; ?>"autocomplete="off" size="50" readonly/></td></tr>
						<tr><td>Password:</td><td><input type="text" class="" name="password" value="<?php echo $_SESSION['password']; ?>" autocomplete="off" size="50"/></td></tr>
						<tr><td>Password Hint:</td><td><input type="text" class="" name="password_hint" value="<?php echo $_SESSION['password_hint']; ?>" autocomplete="off" size="50"/></td></tr>	
						<tr><td>Email:</td><td><input type="email" class="" name="email" value="<?php echo $_SESSION['email']; ?>" autocomplete="off" size="50"/></td></tr>						
						<tr><td>Employee Name:</td><td><input type="text" class="" name="employeename" value="<?php echo $_SESSION['employeename']; ?>" autocomplete="off" size="50" /></td></tr>
						<tr><td>Employee ID:</td><td><input type="text" class="" name="employee_id" value="<?php echo $_SESSION['employee_id']; ?>"  autocomplete="off" size="50"/></td></tr>
						<tr><td>Position:</td><td><input type="text" class="" name="position" value="<?php echo $_SESSION['position']; ?>"autocomplete="off" size="50"/></td></tr>
                  <tr><td>Delivery Team:</td><td><input type="text" class="" name="delivery_team" value="<?php echo $_SESSION['delivery_team']; ?>"autocomplete="off" size="50"/></td></tr>
						<tr><td>Functional Group:</td><td><input type="text" class="" name="functional_group" value="<?php echo $_SESSION['functional_group']; ?>"autocomplete="off" size="50"/></td></tr>
                  <tr><td>User Type:</td><td> <input type="text" class="" name="user_type" value="<?php echo $_SESSION['user_type']; ?>"autocomplete="off" size="50" readonly/></td></tr>	
						<tr><td>Additional Details:</td><td> <input type="text" class="" name="additional_details" value="<?php echo $_SESSION['additional_details']; ?>"autocomplete="off" size="50" readonly/></td></tr>	
						<tr><td>Account Status:</td><td> <input type="text" class="" name="account_status" value="<?php echo $_SESSION['account_status']; ?>"autocomplete="off" size="50" readonly/></td></tr>	
						</table></center> 
						</br>
						</br>
						<input type="submit" class="btn btn-primary btn-lg" name="btn-update" value="Update"/>
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
            	<!--The Calendar-->
            	<div id="calendar" style="width: 100%"></div>
            	</div><!--/.card-body-->
            	</div><!--/.card-->
          	</section>
  				<!--right col-->
      	</div><!--/.row (main row)-->
      </div><!--/.container-fluid-->
    	</section>
    	<!--/.content-->
  	</div>
	<!--/.Content Wrapper-->

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
  	<!--/.Control Sidebar-->

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