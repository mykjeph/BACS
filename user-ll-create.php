<?php
//require('db.php');
include("auth.php");
$usernamecheck = ""; 
$usernamesuggestion ="";
$checkresult = "";
$username="";
error_reporting(E_ALL);
$loguser = $_SESSION["loguser"];
$username = $_SESSION['username'];
$document_no = "";  
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
			// output data of each row
			while($GLOBALS['rows'] = mysqli_fetch_assoc($result)) 
			{
				echo "1 result.";
			}
	  	}
	  	else 
		{
			echo "No result.";
		}
		mysqli_close($conn);   		
			
	//==============================Functions Area==============================
	function Insert_New_LL()
	{
		  $username = $_SESSION['username'];
		  $document_no = $GLOBALS['document_no'];
		  $ref_no = $GLOBALS['document_no'];
		  $delivery_team = trim($_REQUEST['delivery_team']);
		  $location = trim($_REQUEST['location']);
		  $date_issued = trim($_REQUEST['date_issued']);
		  $ll_title = trim($_REQUEST['ll_title']);
		  $ll_description = trim($_REQUEST['ll_description']);
		  $causes_findings = trim($_REQUEST['causes_findings']);
		  $corrective_actions = trim($_REQUEST['corrective_actions']);
		  $submitted_by	= $_SESSION["loguser"];
		  $document_status = "Open";
		  $comments = "Initial Creation";	  
		  $conn=mysqli_connect("localhost","root","","bacs");
		  if (!$conn)
		  {
			die('Connection error'.mysqli_connect_error);
		  }
			$connectDb = mysqli_select_db($conn,'bacs');
			$query = "INSERT into `ll` (document_no, ref_no, document_status, delivery_team, location, date_issued, ll_title, ll_description, causes_findings, corrective_actions, submitted_by) VALUES ('$document_no', '$ref_no', '$document_status','$delivery_team','$location','$date_issued', '$ll_title', '$ll_description', '$causes_findings', '$corrective_actions', '$submitted_by')";
	  		$result = mysqli_query($conn,$query);
			 
			$query2 = "INSERT into `user_comments` (document_no, commentfield, commentby ) VALUES ('$document_no','$comments','$submitted_by')";
			$result2 = mysqli_query($conn,$query2);				

			
			if($result)
			{
				echo $message = "Your LL Document has been submitted successfully. Reference No.: " . $document_no;
				$dir = $GLOBALS['document_no'];
					//$file_to_write = 'test.txt';
					//$content_to_write = "";
					$structure = './attachments/'.$dir;									
					if (!mkdir($structure, 0, true)) 
					{
					die('Failed to create folders...');
					}					
						//name of the uploaded file
    					$filename_before = $_FILES['before_attachment']['name'];
    					$filename_after = $_FILES['after_attachment']['name'];
			
    					//destination of the file on the server
    					$destination1 = './attachments/'.$dir.'/' . $filename_before;
    					$destination2 = './attachments/'.$dir.'/' . $filename_after;
    					//$destination = $structure . $filename_after;

    					//get the file extension
    					$bfile_extension = pathinfo($filename_before, PATHINFO_EXTENSION);
    					$afile_extension = pathinfo($filename_after, PATHINFO_EXTENSION);
    					$bfile_extension = strtolower($bfile_extension);
    					$afile_extension = strtolower($afile_extension);

    					//the physical file on a temporary uploads directory on the server
    					$temp_before_attachment = $_FILES['before_attachment']['tmp_name'];
    					$temp_after_attachment = $_FILES['after_attachment']['tmp_name'];

    					if (!in_array($bfile_extension, ['jpg', 'png'])) 
    					{
        					echo "\r\n Your file must be in .jpg or .png format";
    					} 				
    					elseif ($_FILES['before_attachment']['size'] > 5000000) 
    					{ // file shouldn't be larger than 5Megabyte
        					echo "\r\n File too large!";
    					} 
    					else 
    						{
        					// move the uploaded (temporary) file to the specified destination
        					if (move_uploaded_file($temp_before_attachment, $destination1)) 
        					{
            				$sql = "UPDATE ll SET before_attachment='$filename_before' WHERE document_no='$document_no'";
            				if (mysqli_query($conn, $sql)) 
            				{
                				//echo "File uploaded successfully";
            				}
        					} 			
        					else 
        					{
            				echo "\r\n Failed to upload file.";
        					}
        				}
    					if (!in_array($afile_extension, ['jpg', 'png'])) 
    					{
        					echo "\r\n Your file must be in .jpg or .png format";
    					} 
    					elseif ($_FILES['after_attachment']['size'] > 5000000) 
    					{ // file shouldn't be larger than 5Megabyte
        					echo "\r\n File too large!";
    					} 
    					else 
    					{
        					// move the uploaded (temporary) file to the specified destination    
        					if (move_uploaded_file($temp_after_attachment, $destination2)) 
        					{
            				$sql2 = "UPDATE ll SET after_attachment='$filename_after' WHERE document_no='$document_no'";
            				if (mysqli_query($conn, $sql2)) 
            				{
                				//echo "File uploaded successfully";
            				}
        					} 
        					else 
        					{
            				echo "Failed to upload file.";
        					}
    					}
				mysqli_close($conn);
				}	
}
//==============================LL Document Numbering==============================
	function Create_New_Document_Number()
	{
		//require('db.php');
		$lastdocumentnumber = "";
      $conn=mysqli_connect("localhost","root","","bacs");
      if (!$conn)
        {
          die('Connection error'.mysqli_connect_error);
        }
        $connectDb = mysqli_select_db($conn,'bacs');
        //$query = "select * from users where username='$_SESSION['username']' and password='$_SESSION['pass']'";
        $query = "select document_no from ll order by document_no desc";
        $result = mysqli_query($conn,$query);
		
		if (mysqli_num_rows($result) > 0) 
		{
			$row = mysqli_fetch_row($result);

			$lastdocumentnumber = $row[0] ;
			$newstring = substr($lastdocumentnumber, -6);	
			$new_int =  number_format($newstring);
			$new_int++;
			$newint2 = str_pad($new_int, 6, '0', STR_PAD_LEFT);
			$document_no =  'M-BCW-000000-GQSE-RPT-' . $newint2;	
			$GLOBALS['document_no'] = $document_no;			
		}
		else 
		{
			$lastdocumentnumber = 'M-BCW-000000-GQSE-RPT-000001';
			$GLOBALS['document_no'] =  $lastdocumentnumber;
		}	
		mysqli_close($conn); 
    }	
    
//==============================Create Folder==============================
	//Change the folder name below for the specific folder to be used
	function uploadattach()
	{
		if(isset($_POST['submit'])!="")
		{
			$filename = $_FILES["docu"]["name"];  
  
			move_uploaded_file($_FILES["docu"]["tmp_name"], "attachments/" . $filename);						
		}	
	}	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>LL User | Dashboard</title>
  <link rel="shortcut icon" href="image/bacslogo.png" type="image/x-icon">
  
  <!--Tell the browser to be responsive to the screen width-->
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
	input[type="date" i]
	{
		align-items:left!important;
	}	
	#selectedFiles img
	{
		max-width: 125px;
		max-height: 125px;
		float: left;
		margin-bottom:10px;
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
         <span class="dropdown-item dropdown-header">User</span>
         <div class="dropdown-divider"></div>
         	<a href="user-profile.php" class="dropdown-item">
            <i class="fas fa-user"></i> My Profile</a>
          <div class="dropdown-divider"></div>
          	<a href="all-login.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Logout</a>       
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
   	<!--Sidebar User Panel (Optional)-->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      	<div class="image">
         	<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        	</div>
        	<div class="info">
         	<a href="user-profile.php" class="d-block"><?php echo "Hello, " . $_SESSION["loguser"]."!"; ?></a>
       	</div>
		</div>
		
		<!--Sidebar Menu-->
      <nav class="mt-2">
      	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!--Add icons to the links using the .nav-icon class with font-awesome or any other icon font library-->
         	<li class="nav-item has-treeview menu-close">
            	<a href="#" class="nav-link active">
              	<i class="nav-icon fas fa-tachometer-alt"></i>
              	<p>User Panel</p>
               <i class="right fas fa-angle-left"></i>
            	</a>
            	<ul class="nav nav-treeview">
			 			<li class="nav-item">
                	<a href="user-profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Profile</p>
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
              	<p>Lessons Learned Panel</p>
               <i class="right fas fa-angle-left"></i>
              	</a>
            		<ul class="nav nav-treeview">
              			<li class="nav-item">
                		<a href="user-ll-create.php" class="nav-link   active ">
                  	<i class="far fa-circle nav-icon"></i>
                  	<p>Create New LL</p>
                		</a>
              			</li>              			
              			
			  				<li class="nav-item">
                		<a href="final-user-view_ll.php" class="nav-link ">
                  	<i class="far fa-circle nav-icon"></i>
                  	<p>Manage Submitted LLs</p>
                		</a>
              			</li>
              			
              			<li class="nav-item">
                		<a href="user-view_ll.php" class="nav-link ">
                  	<i class="far fa-circle nav-icon"></i>
                  	<p>View All LLs</p>
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
  	
   	<!--Content Header (Page Header)-->
    	<div class="content-header">
      <div class="container-fluid">
      	<div class="row mb-2">
         	<div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Lessons Learned Document</h1>
          	</div><!--/.col-->
          	<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            	<li class="breadcrumb-item"><a href="user-profile.php">LL User</a></li>
              	<li class="breadcrumb-item active">Create New LL</li>
            </ol>
          	</div><!--/.col-->
        	</div><!--/.row-->
		</div><!--/.container-fluid-->
    	</div>
    	<!--/.Content Header-->

    <!--Main Content-->
    <section class="content">
    	<div class="container-fluid">
      	<!--Small boxes (Stat box)-->
        	<div class="row">
          
          <!--./col-->
        </div>
        <!--/.row-->
        <!--Main row-->
        <div class="row" style="max-width:50%!important;">
          <!--Left col-->
          <section class="col">
            <!--Custom tabs (Charts with tabs)-->
			
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-file"></i>
                   Please complete and submit the form below:
                </h3>
                
              </div><!--/.card-header-->
              <div class="card-body">
					<?php
						if(array_key_exists('submit', $_POST)) 
						{ 
							Create_New_Document_Number();
							Insert_New_LL();				
						} 
					?>
                <div class="tab-content p-0">
                  <!--Lessons Learned Form-->
                  <div class="chart tab-pane active" id="" style="position: relative; height: 800px;">
	
					<form class="text-center border border-light p-5" name="registration" action="" method="post" enctype="multipart/form-data">
			      <h3>
                    PROJECT QUALITY<br>LESSONS LEARNED
               </h3>
					</br>
               <center><table style="text-align:left!important;">
				   <tr><td>Delivery Team:</td><td>
               	<select style="width:100%;" class="" name="delivery_team" required>
							<option value="" disabled selected>Select your Delivery Team</option>
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
                  </select> </td></tr>
					<tr><td>Location:</td><td>
						<select style="width:100%;"class="" name="location" required> 
							<option value="" disabled selected>Select Location</option>
							<option value="East Depot">East Depot</option>	
							<option value="North Depot">North Depot</option>
							<option value="South Depot">South Depot</option>
							<option value="Station 1A1/KAFD">Station 1A1/KAFD</option>
							<option value="Station 1A2">Station 1A2</option>
							<option value="Station 1B1">Station 1B1</option>
							<option value="Station 1B2">Station 1B2</option>
							<option value="Station 1B3/Olaya">Station 1B3/Olaya</option>
							<option value="Station 1B4">Station 1B4</option>
							<option value="Station 1C1">Station 1C1</option>
							<option value="Station 1C2">Station 1C2</option>
							<option value="Station 1C3">Station 1C3</option>
							<option value="Others">Others</option>
						</select></td></tr>				
						<tr><td>Date Issued:</td><td><input type="date" style=" width: 100%;"class="" name="date_issued" value="" min="2018-01-01" max="2025-12-31"  required/></td></tr>						
						
						<tr><td>LL Title:</td><td><textarea style=" width: 100%;" rows="2" name="ll_title" placeholder="Enter a short descriptive title" autocomplete="off" required></textarea></td></tr>						
						<tr><td>LL Description:</td><td><textarea style=" width: 100%;" rows="4" name="ll_description" placeholder="Concisely describe the condition/ situation/ work activity/ work environment" autocomplete="off" required></textarea></td></tr>						
						<tr><td>Causes/Findings:</td><td><textarea style=" width: 100%;" rows="4" name="causes_findings" placeholder="What are the causes or findings for the condition/ situation/ work activity/ work environment" autocomplete="off" required></textarea></td></tr>		
						<tr><td>Corrective Actions/<br>Key Lessons Learned:</td><td><textarea style=" width: 100%;" rows="4" name="corrective_actions" placeholder="What are the corrective action(s) made and key recommendation(s)/ lesson(s) learned" autocomplete="off" required></textarea></td></tr>		
						
						<tr><td>Comment:</td><td><input type="text" style=" width: 100%;" class="" name="commentfield" value="Initial Creation" readonly /></td></tr>
						
						<tr><td>Before Photo:</td><td>
						<input type="file" name="before_attachment" id="" required/></td></tr>
						
						<tr><td>After Photo:</td><td>
						<input type="file" name="after_attachment" id="" required/></td></tr>				 
						
						</table></center>
						
						</br>	
						<input type="submit" class="btn btn-primary btn-lg" name="submit" value="Submit" />
						</form>
						</div>
					  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>    <tr><td>Before Photo:</td><td>
						<input type="file" name="before_attachment" id="" required/></td></tr>
						
						<tr><td>After Photo:</td><td>
						<input type="file" name="after_attachment" id="" required/></td></tr>	                     
                  </div>  
                </div>
              </div><!--/.card-body-->
            </div>
            <!--/.card-->  
              <!--/.card-header-->
              <div class="card-body pt-0">
                <!--The calendar-->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!--/.card-body-->
            </div>
            <!--/.card-->
          </section>
          <!--right col-->
        </div>
        <!--/.row (main row)-->
      </div><!--/.container-fluid-->
    </section>
    <!--/.content-->
  </div>
  <!--/.content-wrapper-->
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

<!--File(s) upload view-->		

<!--End of File(s) upload view-->

<!--./wrapper-->

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