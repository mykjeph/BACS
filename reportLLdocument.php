<?php
//require('db.php');
include("auth.php");
error_reporting(E_ALL);
$loguser =$_SESSION["loguser"];
$username = $_SESSION['username'];

//loadname();	
		
//=================================Functions Area=================================
function loadname()
{
	echo"loadname";
	$conn=mysqli_connect("localhost","root","","bacs");
	if (!$conn)
	{
		die('Connection error'.mysqli_connect_error);
	}
	$connectDb = mysqli_select_db($conn,'bacs');
	$query = "select * from users where username='$username' ";
	$result = mysqli_query($conn,$query);
	$rows = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
	
}
?>
	
<?php
function initial_loadtable()
{	
	$conn="";
	$query="";
	$conn=new PDO('mysql:host=localhost; dbname=bacs', 'root', '') or die(mysql_error());
	$query=$conn->query("select * from ll where document_no LIKE '%' " );					
	while($row=$query->fetch())
		{
		$_SESSION['document_no'] = $row['document_no'];
		$_SESSION['ref_no'] = $row['ref_no'];
		$_SESSION['document_status'] = $row['document_status'];
		$_SESSION['delivery_team'] = $row['delivery_team'];
		$_SESSION['location'] = $row['location'];
		$_SESSION['date_issued'] =$row['date_issued'];
		$_SESSION['ll_title'] =$row['ll_title'];
		$_SESSION['ll_description'] =$row['ll_description'];
		$_SESSION['causes_findings'] = $row['causes_findings'];
		$_SESSION['corrective_actions'] = $row['corrective_actions'];
		$_SESSION['submitted_by'] = $row['submitted_by'];
		$_SESSION['last_update'] = $row['last_update'];
?>                
            <tr>
            <td class="document_no">&nbsp;<?php echo $_SESSION['ref_no'] ;?></td>
				<td class="document_status">&nbsp;<?php echo $_SESSION['document_status'];?></td>
				<td class="delivery_team">&nbsp;<?php echo $_SESSION['delivery_team'];?></td>
				<td class="location">&nbsp;<?php echo $_SESSION['location'];?></td>
				<td class="date_issued">&nbsp;<?php echo $_SESSION['date_issued'];?></td>
				<td class="ll_title">&nbsp;<?php echo $_SESSION['ll_title'];?></td>
				<td class="ll_description">&nbsp;<?php echo $_SESSION['ll_description'];?></td>
				<td class="causes_findings">&nbsp;<?php echo $_SESSION['causes_findings'] ;?></td>
				<td class="corrective_actions">&nbsp;<?php echo $_SESSION['corrective_actions'] ;?></td>	
            <td class="submitted_by">&nbsp;<?php echo $_SESSION['submitted_by'];?></td>
				<td class="last_update">&nbsp;<?php echo $_SESSION['last_update'];?></td>
				</tr>
<?php
		}
}
?>
              
<?php
Function load_data_from_search()
{
	$y=0;
	$conn=new PDO('mysql:host=localhost; dbname=bacs', 'root', '') or die(mysql_error());
		$query="";
				$typeahead = $_POST['typeahead'];
				$field = $_POST['field'];
					
				switch ($field)
				{
					case "documentno":
						$query=$conn->query("select * from ll where ref_no LIKE '%$typeahead%'  " );
						break;
					
					case "documentstatus":	
						$query=$conn->query("select * from ll where document_status LIKE '%$typeahead%'  " );
						break;
						
					case "deliveryteam":	
						$query=$conn->query("select * from ll where delivery_team LIKE '%$typeahead%'  " );
						break;
					
					case "location":	
						$query=$conn->query("select * from ll where location LIKE '%$typeahead%'  " );
						break;
					
					case "submitted":		
						$query=$conn->query("select * from ll where submitted_by LIKE '%$typeahead%'  " );
						break;
					
					default:
						echo "No data filter selected.";
						break;
				}		
				
			while($row=$query->fetch())
			{
		$_SESSION['document_no'] = $row['document_no'];
		$_SESSION['ref_no'] = $row['ref_no'];
		$_SESSION['document_status'] = $row['document_status'];
		$_SESSION['delivery_team'] = $row['delivery_team'];
		$_SESSION['location'] = $row['location'];
		$_SESSION['date_issued'] =$row['date_issued'];
		$_SESSION['ll_title'] =$row['ll_title'];
		$_SESSION['ll_description'] =$row['ll_description'];
		$_SESSION['causes_findings'] = $row['causes_findings'];
		$_SESSION['corrective_actions'] = $row['corrective_actions'];
		$_SESSION['submitted_by'] = $row['submitted_by'];
		$_SESSION['last_update'] = $row['last_update'];
?>
			<tr>
         <td class="document_no">&nbsp;<?php echo $_SESSION['ref_no'] ;?></td>
			<td class="document_status">&nbsp;<?php echo $_SESSION['document_status'];?></td>
			<td class="delivery_team">&nbsp;<?php echo $_SESSION['delivery_team'];?></td>
			<td class="location">&nbsp;<?php echo $_SESSION['location'];?></td>
			<td class="date_issued">&nbsp;<?php echo $_SESSION['date_issued'];?></td>
			<td class="ll_title">&nbsp;<?php echo $_SESSION['ll_title'];?></td>
			<td class="ll_description">&nbsp;<?php echo $_SESSION['ll_description'];?></td>
			<td class="causes_findings">&nbsp;<?php echo $_SESSION['causes_findings'] ;?></td>
			<td class="corrective_actions">&nbsp;<?php echo $_SESSION['corrective_actions'] ;?></td>		
         <td class="submitted_by">&nbsp;<?php echo $_SESSION['submitted_by'];?></td>
			<td class="last_update">&nbsp;<?php echo $_SESSION['last_update'];?></td>
			</tr>		               				
<?php 
					$y++;
			}
				if ($y== 0 )
					{
					echo "No result found.";
					}	
}
?>
<?php
if (isset($_POST['update-user']))
{
	$_SESSION['username']=$_POST['typeaheadupdate'];
	header("location:final-admin-edit-users-profile.php");
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>LL Admin | Dashboard</title>
  <link rel="shortcut icon" href="image/bacslogo.png" type="image/x-icon">

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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="typeahead.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
<script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'searchUser.php?key=%QUERY',
        limit : 10
    });
});
</script>

<!--Modal-->
<script>
	$(document).ready(function(){
        $("#myModal").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>
<!--/.Modal-->

<!--Print Data Table-->
<script> 
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);

newWin.document.close();
newWin.focus();

   newWin.print();
   newWin.close();

return true;
}
$(document).ready(function(){
        $("#btnSubmit").click(function(){   
			printData();
        });
    });
//$("#btnSubmit").click(function(){
//printData();
//});
</script>
<!--/.Print Data Table--> 

<!--Excel Export-->
<script>
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('printTable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"LL Documents Report.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
<!--Excel Export-->
	
<style type="text/css">
.dropdown-menu-lg {
   max-width: 300px;
   min-width: 0!important;
   padding: 0;
}
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 24px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 24px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
</style>
</head>
<body>
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
         	<li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Self Panel</p>
            <i class="right fas fa-angle-left"></i>
            </a>
            	<ul class="nav nav-treeview">
			 			<li class="nav-item">
                	<a href="final-admin-profile.php" class="nav-link">
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
         	<li class="nav-item has-treeview menu-open">
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
                	<a href="reportLLdocument.php" class="nav-link active">
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
	
	<!--Email Modal-->	
   <div id="myModal" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title">Send file to Email</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<div class="modal-body">
				<?php				
				if (isset($_POST['submitemail']))
				{
		
					$email = trim($_REQUEST['email']);
		
					$path = 'upload/' . $_FILES["docu"]["name"];
					move_uploaded_file($_FILES["docu"]["tmp_name"], $path);
			  
					$message = '
					<h3>This is an autogenerated email from BACS Quality Lessons Learned Information System.</h3>
					</br>
					<p>Please find attached LL Document Report as reference.</p>
					<p>Printed documents can become obsolete, please <a href="http://3.21.91.216/BACS/all-login.php">log in</a> to your account for the latest report.</p>
					</br>					
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
				$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem			
				$mail->Subject = 'BACS LL Reports';				//Sets the Subject of the message
				$mail->Body = $message;							//An HTML or plain text message body
				if($mail->Send())								//Send an Email. Return true on success or false on error
				{
					echo '<script language="javascript">';
					echo 'alert("LL Document Report has been sent to email successfully.")';
					echo '</script>';	
				}	
				}?>						
				<form action="" method="post" enctype="multipart/form-data">
				<input type="email" class="form-control mb-4" name="email" placeholder="Email e.g. example@email.com" required />
				<input type="file" name="docu" id="files"  multiple/>
											
				</div>
				
				<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Cancel</button>
				<input type="submit" class="btn btn-primary btn-lg" name="submitemail" value="Send" />
				</div>
				</form>
				</div>
				</div>
	</div><!--/.Email Modal-->

	<!--Content Wrapper. Contains Page Content-->
  	<div style=""class="content-wrapper">
   	<!--Content Header (Page Header)-->
    	<div class="content-header">
      <div class="container-fluid">
      	<div class="row mb-2">
         	<div class="col-sm-6">
            <h1 class="m-0 text-dark">Customize Quality Lessons Learned Documents Report</h1>
          	</div><!--/.col-->
          	<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            	<li class="breadcrumb-item"><a href="final-admin-profile.php">LL Admin</a></li>
              	<li class="breadcrumb-item active">Customize LL Report</li>
            </ol>
          	</div><!--/.col-->
        	</div><!--/.row-->
      </div><!--/.container-fluid-->
    	</div><!--/.content-header-->

	<!--Main Content-->
   <section class="content">
   	<div class="container-fluid">
      <!--Info boxes-->
      <div class="row">
      	<div class="col-12 col-sm-6 col-md-3">
         <!--/.card-body-->
         <!--/.card-footer-->
         </div><!--/.card-->
         </div><!--/.col-->
      </div><!--/.row-->

	<!--Table: LL Documents-->
	<div class="card">
	<div class="card-header border-transparent">
   	<div class="panel panel-default">
				<div style="margin-center:20px;">
					<form name="registration" action="" method="post">
					<select style="margin-top: 20px;height:30px;" class="" name="field">
               <option value="documentno">LL Document No.</option>
               <option value="documentstatus">Document Status</option>
               <option value="deliveryteam">Delivery Team</option>
					<option value="location">Location</option>
					<option value="submitted">Submitted by</option>
               </select>	
        			<input style="height:30px; width:300px;"  type="text" name="typeahead"  autocomplete="off" spellcheck="false" placeholder="Enter item to be searched here">
					<input style="margin-top:-3px;font-size: 14px;padding: 4 18;" type="submit" class="btn btn-primary btn-lg" name="submit" value="Search" />
					<a href="reportLLdocument.php"><input style="margin-top: -2px;padding: 5px;border: 0;font-size: 14;width: 80px; " type="submit" class="btn btn-primary btn-lg" value="Reset" /></a>
	   			</form>
    			</div>			
						
				<div style="width:98%;text-align:right!important;">  
				<a  data-toggle="modal" data-target="#myModal" href=""><img width="30" src="image/mail.png" title="Email"></a>
				<a id="btnSubmit" href="#"><img width="30" style="vertical-align:middle;margin:5px" src="image/printlogo.png" title="Print"></a>
				<a onclick="fnExcelReport();" href="#"><img width="30" src="image/excel.png" title="Export to Excel"></a>
				</div>	
  		</div>
  	</div>
  					<table style="margin-left:30px;" class="table m-0">
 					<tr><td><input type="checkbox" name="document_no" checked="checked" /> Document No.</td>
					<td><input type="checkbox" name="document_status" checked="checked" /> Document Status</td>
					<td><input type="checkbox" name="delivery_team" checked="checked" /> Delivery Team</td>
					<td><input type="checkbox" name="location" checked="checked" /> Location</td>
					<td><input type="checkbox" name="date_issued" checked="checked" /> Date Issued</td>
					<td><input type="checkbox" name="ll_title" checked="checked" /> LL Title</td>
					<td><input type="checkbox" name="ll_description" checked="checked" /> LL Description</td>
					<td><input type="checkbox" name="causes_findings" checked="checked" /> Causes/Findings</td>
					<td><input type="checkbox" name="corrective_actions" checked="checked" /> Corrective Actions/<br>Key Lessons Learned</td>
					<td><input type="checkbox" name="submitted_by" checked="checked" /> Submitted by</td>
					<td><input type="checkbox" name="last_update" checked="checked" /> Last Updated</td></tr>
					</table>

   				<table style="margin-left:30px;" class="table m-0" id="printTable">
               <thead>
               <tr><td><img src="image/bacslogo.png" style="width:60px";"height:65px"></td>
               <td colspan="10" style="vertical-align:middle"><h3>Quality Lessons Learned Documents Report</h3></td></tr>           
               <tr>
               <th class="document_no" style="vertical-align:middle">Document No.</th>
					<th class="document_status" style="vertical-align:middle">Document Status</th>	
					<th class="delivery_team" style="vertical-align:middle"> Delivery Team</th>
					<th class="location" style="vertical-align:middle">Location</th>	
					<th class="date_issued" style="vertical-align:middle">Date Issued</th>
					<th class="ll_title" style="vertical-align:middle">LL Title</th>
					<th class="ll_description" style="vertical-align:middle">LL Description</th>
					<th class="causes_findings" style="vertical-align:middle">Causes/Findings</th>
					<th class="corrective_actions" style="vertical-align:middle">Corrective Actions/<br>Key Lessons Learned</th>
					<th class="submitted_by" style="vertical-align:middle">Submitted by</th>
					<th class="last_update" style="vertical-align:middle">Last Updated</th>
               </tr>
               </thead>
               
               <tbody><tr>
							<?php
								if (isset($_POST['submit']))
									{
										load_data_from_search();
			
									}
								else
									{
										initial_loadtable();  
									}
							?>				
               </tr></tbody>					
               </table>
				  	</div><!--/.Table: LL Documents-->
              	</div><!--/.card-body-->
            	<!--/.card-footer-->
            </div><!--/.card-->
			</div><!--/.col-->
  
	<!--Control Sidebar-->
  	<aside class="control-sidebar control-sidebar-dark">
   <!--Control sidebar content goes here-->
  	</aside>
  	<!--/.control-sidebar-->

  	<!--Main Footer-->
   <footer class="main-footer">
   <strong>Copyright &copy; 2020 <a href="https://sa.linkedin.com/in/michael-joseph-mangulabnan-48200598">M.J.S. Mangulabnan</a>.</strong>
   All rights reserved.
   <div class="float-right d-none d-sm-inline-block">
   Internal Release Number: <b>M-BAC-000000-GQ00-SRS-000001 Rev. 001</b>
   </div>
  	</footer>

</div><!--./Wrapper-->

<script>
$("input:checkbox:not(:checked)").each(function() {
    var column = "table ." + $(this).attr("name");
    $(column).hide();
});

$("input:checkbox").click(function(){
    var column = "table ." + $(this).attr("name");
    $(column).toggle();
});
</script>

<!--Bootstrap-->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--overlayScrollbars-->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!--AdminLTE App-->
<script src="dist/js/adminlte.js"></script>

<!--OPTIONAL SCRIPTS-->
<script src="dist/js/demo.js"></script>

<!--PAGE PLUGINS-->
<!--jQuery Mapael-->

<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!--ChartJS-->
<script src="plugins/chart.js/Chart.min.js"></script>

<!--PAGE SCRIPTS-->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>