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
			echo "1 results";
		}
	  	}
	  else 
		{
			echo "0 results";
		}
		
			mysqli_close($conn);
			
	//==============================Functions Area==============================
	
	function Insert_New_LL()
	{
		  $username = $_SESSION['username'];
		  $document_no = ($GLOBALS['document_no']);
		  $ref_no = trim($_REQUEST['ref_no']);
		  $delivery_team = trim($_REQUEST['delivery_team']);
		  $location = trim($_REQUEST['location']);
		  $date_issued = trim($_REQUEST['date_issued']);
		  $ll_title = trim($_REQUEST['ll_title']);
		  $ll_description = trim($_REQUEST['ll_description']);
		  $causes_findings = trim($_REQUEST['causes_findings']);
		  $corrective_actions = trim($_REQUEST['corrective_actions']);
		  $submitted_by	= $_SESSION["loguser"];
		  $document_status = "Approved";
		  $comments = "Imported Previous LL";	  
		  $conn=mysqli_connect("localhost","root","","bacs");
		  if (!$conn)
		  {
			die('Connection error'.mysqli_connect_error);
		  }
			 $connectDb = mysqli_select_db($conn,'bacs');
			 $query = "INSERT into `ll` (document_no, ref_no, document_status, delivery_team, location, date_issued, ll_title, ll_description, causes_findings, corrective_actions, submitted_by) VALUES ('$document_no', '$ref_no', '$document_status','$delivery_team','$location','$date_issued', '$ll_title', '$ll_description', '$causes_findings', '$corrective_actions', '$submitted_by')";
	  		 $result = mysqli_query($conn,$query);
			 
			$query2 = "INSERT into `commentuser` (document_no, commentfield, commentby ) VALUES ('$document_no','$comments','$submitted_by')";
			$result2 = mysqli_query($conn,$query2);				

			//mysqli_close($conn);	
			
			if($result)
			{
				echo $message = "Your Lessons Learned Document has been imported successfully. \r\n Reference No.: " . $ref_no;
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
            				echo "\r\n Failed to upload file.";
        					}
    					}
				mysqli_close($conn);
				}	
}
	//==============================LL Document Number==============================
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
         	<li class="nav-item has-treeview menu-open">
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
                	<a href="admin-ll-import.php" class="nav-link active">
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
   	<!--Content Header (Page Header)-->
    	<div class="content-header">
      <div class="container-fluid">
      	<div class="row mb-2">
         	<div class="col-sm-6">
            <h1 class="m-0 text-dark">Import Previous Lessons Learned Document</h1>
          	</div><!--/.col-->
          	
          	<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            	<li class="breadcrumb-item"><a href="final-admin-profile.php">LL Admin</a></li>
            	<li class="breadcrumb-item active">Import Previous LL</li>
            </ol>
          	</div><!--/.col-->
        	</div><!--/.row-->
      </div><!--/.container-fluid-->
		</div><!--/.content-header-->

	<!--Main Content-->
   <section class="content">
   	<div class="container-fluid">
      	<!--Small boxes (Stat box)-->
      	<div class="row">
      	<!--./col-->
        	</div>
        		<!--/.row-->
        	<!--Main row-->
        	<div class="row" style="max-width:60%!important;">
         	<!--Left col-->
          	<section class="col">
            
            <!--Upload/Extract PDF Data-->
				<div class="card">
					<div class="card-header">
               <form class="text-center" action="" method="post" enctype="multipart/form-data">
  					Select file to import:
  					<input type="file" name="fileToImport" id="upfile">
  					<input type="submit" value="Extract Data" name="extract_data">
					</form>
               </div><!--/.card-header-->
					<div class="card-body">

<!--Upload PDF file to be extracted-->
<?php

$exdocument_no = "";
$exdelivery_team = "";
$exlocation = "";
$exdate_issued = "";
$extitle = "";
$exdescription = "";
$excauses = "";
$excorrective = "";

if(isset($_POST["extract_data"]))
{
	$folder_path = 'import_upload/';

   $filename = basename($_FILES['fileToImport']['name']);
   
   $newname = $folder_path . $filename;
   
   $FileType = pathinfo($newname,PATHINFO_EXTENSION);
   
	//Check if file already exists
	if (file_exists($newname))
	{
  		echo "Sorry, LL document already imported.";
  		return;
	}
	  
	//Upload to folder and validate if pdf file   
   if($FileType == "pdf")
   	{
      if (move_uploaded_file($_FILES['fileToImport']['tmp_name'], $newname))
      	{
				$conn=mysqli_connect("localhost","root","","bacs");
		  		if (!$conn)
		  		{
				die('Connection error'.mysqli_connect_error);
		  		}
			 	$connectDb = mysqli_select_db($conn,'bacs');
							
            $query = "INSERT INTO importll (document_location, document_name) VALUES('$newname','$filename')";
            $result = mysqli_query($conn,$query);        
            
            if (isset($result))
            {
					include ( 'pdf-to-text/PdfToText.phpclass' ) ;
		   			
					$file = $newname;
		
					$pdf	=  new PdfToText ( "$file" );		
		
					file_put_contents ( "$file.txt", $pdf -> Text ) ;
		
					$textfile = file_get_contents("$file.txt");	
					
					/*//Import Image				
					$pdfImage		=  new PdfToText ( "$file", PdfToText::PDFOPT_DECODE_IMAGE_DATA ) ;
					$image_count 	=  count ( $pdfImage -> Images ) ;	
					
					if  ( $image_count )
	   			{
						for  ( $i = 0 ; $i  <  $image_count ; $i ++ )
		   			{
						// Get next image and generate a filename for it (there will be a file named "sample.x.jpg"
						// for each image found in file "sample.pdf")
						$img		=  $pdf -> Images [$i] ;			// This is an object of type PdfImage
						$imgindex 	=  sprintf ( "%02d", $i + 1 ) ;
						$output_image	=  "$file.$imgindex.jpg" ;
			
						// Allocate a color entry for "white". Note that the ImageResource property of every PdfImage object
						// is a real image resource that can be specified to any of the image*() Php functions
						$textcolor	=  imagecolorallocate ( $img -> ImageResource, 0, 0, 255 ) ;
			
						// Put the string "Hello world" on top of the image. 
						imagestring ( $img -> ImageResource, 5, 0, 0, "Hello world #$imgindex", $textcolor ) ;
			
						// Save the image (the default is IMG_JPG, but you can specify another IMG_* image type by specifying it
						// as the second parameter)
						$img -> SaveAs ( $output_image ) ;
			
						output ( "Generated image file \"$output_image\"" ) ;
		    			}
	    			}
				else
					echo "No image found in the uploaded file \"$file\"" ;*/
		
		//Extract LL Document Number		
		function extractDocument_no($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$exdocument_no = extractDocument_no($textfile, 'Document Number:', 'Delivery Team:'); 
			$exdocument_no = trim($exdocument_no); 		
			//echo $exdocument_no;
			
		
		//Extract Delivery Team		
		function extractDeliveryTeam($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$exdelivery_team = extractDeliveryTeam($textfile, 'Delivery Team:', 'Date Issued:'); 
			$exdelivery_team = trim($exdelivery_team);
			//echo $exdelivery_team; 
			
		//Extract Location		
		function extractLocation($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$exlocation = extractLocation($textfile, 'Location:', 'Description:');
			$exlocation = trim($exlocation); 
			//echo $exlocation;
			
		//Extract Date Issued		
		function extractDateIssued($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$exdate_issued = extractDateIssued($textfile, 'Date Issued:', 'Document Title:');
			$exdate_issued = trim($exdate_issued); 		 
			//echo $exdate_issued;  
		
		//Extract LL Title		
		function extractTitle($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$extitle = extractTitle($textfile, 'Document Title:', 'Location:'); 
			$extitle = trim($extitle); 
			//echo $extitle; 
			
		//Extract LL Description		
		function extractDescription($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$exdescription = extractDescription($textfile, 'Description:', 'Causes/Findings:'); 
			$exdescription = trim($exdescription);
			//echo $exdescription; 	
			
		//Extract Causes/Findings		
		function extractCauses($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$excauses = extractCauses($textfile, 'Causes/Findings:', 'Corrective Actions/Key Lessons Learned:'); 
			$excauses = trim($excauses);			
			//echo $excauses; 
			
		//Extract Corrective Actions/Key Lessons		
		function extractCorrectiveActions($str, $starting_word, $ending_word) 
		{ 
    		$subtring_start = strpos($str, $starting_word); 
    		//Adding the strating index of the strating word to  
    		//its length would give its ending index 
    		$subtring_start += strlen($starting_word);   
    		//Length of our required sub string 
    		$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    		// Return the substring from the index substring_start of length size  
    		return substr($str, $subtring_start, $size);   
		} 
			$excorrective = extractCorrectiveActions($textfile, 'Corrective Actions/Key Lessons Learned:', 'Template:'); 
			$excorrective = trim($excorrective);			
			//echo $excorrective; 
		               
            	echo '';
            } 
            else
            {
                echo 'Something went Wrong';
            }
				}				
		mysqli_close($conn);	
		} 
	  
else
	{
   	echo "<p>Lessons Learned document to be imported must be uploaded in PDF format.</p>";
  	}   
} 
?>
            
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
	
						<form class="text-center border border-light p-3" name="registration" action="" method="post" enctype="multipart/form-data">
			        	                  
                  <center><table style="text-align:left!important;">
						<tr><td>LL Document No.:</td><td><input type="text" style=" width: 100%;"class="" name="ref_no" value="<?php echo $exdocument_no; ?>" placeholder="" autocomplete="off" required/></td></tr>
						<!--<tr><td>Document Status:</td><td>-->				 		
						<tr><td>Delivery Team:</td><td><input type="text" style=" width: 100%;"class="" name="delivery_team" value="<?php echo $exdelivery_team; ?>" placeholder="" autocomplete="off" required/></td></tr>			 		
						<tr><td>Location:</td><td><input type="text" style=" width: 100%;"class="" name="location" value="<?php echo $exlocation; ?>" placeholder="" autocomplete="off" required/></td></tr>			 		
										
						<tr><td>Date Issued:</td><td><input type="text" style=" width: 100%;" class="" name="date_issued" value="<?php echo $exdate_issued; ?>" required/></td></tr>					
						
						<!--<tr><td>LL Title:</td><td><input type="text" style=" width: 100%;"class="" name="ll_title" placeholder="" autocomplete="off" required/></td></tr>-->
						<tr><td>LL Title:</td><td><textarea style=" width: 100%;" rows="2" name="ll_title" placeholder="" autocomplete="off" required><?php echo $extitle; ?></textarea></td></tr>								
						
						<!--<tr><td>LL Description:</td><td><input type="text" style=" width: 100%;" class="" name="ll_description" placeholder="" autocomplete="off" required/></td></tr>-->		
						<tr><td>LL Description:</td><td><textarea style=" width: 100%;" rows="4" name="ll_description" placeholder="" autocomplete="off" required><?php echo $exdescription; ?></textarea></td></tr>						
						
						<!--<tr><td>Causes/Findings:</td><td> <input type="text" style=" width: 100%;" class="" name="causes_findings" placeholder="" autocomplete="off" required/></td></tr>-->
						<tr><td>Causes/Findings:</td><td><textarea style=" width: 100%;" rows="4" name="causes_findings" placeholder="" autocomplete="off" required><?php echo $excauses; ?></textarea></td></tr>		
						
						<!--<tr><td>Corrective Actions/<br>Key Lessons Learned:</td><td> <input type="text" style=" width: 100%;" class="" name="corrective_actions" placeholder="" autocomplete="off" required/></td></tr>-->									
						<tr><td>Corrective Actions/<br>Key Lessons Learned:</td><td><textarea style=" width: 100%;" rows="4" name="corrective_actions" placeholder="" autocomplete="off" required><?php echo $excorrective; ?></textarea></td></tr>		

						<tr><td>Comment:</td><td><input type="text" style=" width: 100%;" class="" name="commentfield" value="Imported Previous LL" readonly/></td></tr>										

						<tr><td>Before Photo:</td><td>
						<input type="file" name="before_attachment" id="" /></td></tr>
						
						<tr><td>After Photo:</td><td>
						<input type="file" name="after_attachment" id="" /></td></tr>				
				
						</table></center>
						</br>
						<input type="submit" class="btn btn-primary btn-lg" name="submit" value="Import LL" />
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
              		</div>
              		<!--/.card-body-->
            		</div>
            		<!--/.card-->
            		
				</section><!--right col-->
			</div><!--/.row (main row)-->
		</div><!--/.container-fluid-->
    	</section><!--/.content-->
	</div><!--/.content-wrapper-->
	
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

<!--File Upload View-->		
<script>
		var selDiv = "";
			
		document.addEventListener("DOMContentLoaded", init, false);
		
		function init()
			{
				document.querySelector('#files').addEventListener('change', handleFileSelect, false);
				selDiv = document.querySelector("#selectedFiles");
			}
			
		function handleFileSelect(e) 
			{
				console.dir(e);
				
				if(!e.target.files) return;
				
				selDiv.innerHTML = "";	
				var files = e.target.files;
							
				for(var i=0; i<files.length; i++) 
				{
						var f = files[i];
						
						selDiv.innerHTML += f.name + "<br/>";
				}	
			}
</script>
<!--/.File Upload View-->

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