<?php

include("auth.php");

error_reporting(0);

$loguser=$_SESSION["loguser"];

$_SESSION['document_no'] ="";
$_SESSION['ref_no'] ="";

$_SESSION['delivery_team'] ="";

$_SESSION['document_status'] ="";		

$_SESSION['location'] ="";

$_SESSION['date_issued'] ="";

$_SESSION['ll_title'] ="";

$_SESSION['ll_description'] ="";

$_SESSION['causes_findings'] ="";

$_SESSION['corrective_actions'] ="";

$_SESSION['submitted_by'] ="";

$_SESSION['last_update'] ="";

$_SESSION['timestamp'] ="";
$_SESSION['before_attachment'] ="";
$_SESSION['after_attachment'] ="";



if(isset($_POST["btn-update"])){ 

	$ref_no=trim($_POST['ref_no']);	

	

	$conn=mysqli_connect("localhost","root","","bacs");

	if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

	$connectDb = mysqli_select_db($conn,'bacs');

	$query = "select * from ll where ref_no = '$ref_no'";

	$result = mysqli_query($conn,$query);

	$_SESSION['rows'] = mysqli_fetch_array($result);

	if (mysqli_num_rows($result) > 0) {

    	$_SESSION['document_no'] = $_SESSION['rows']['document_no'];
    	$_SESSION['ref_no'] = $_SESSION['rows']['ref_no'];

		$_SESSION['document_status'] = $_SESSION['rows']['document_status'];

		$_SESSION['delivery_team'] = $_SESSION['rows']['delivery_team'];

		$_SESSION['location'] = $_SESSION['rows']['location'];

		$_SESSION['date_issued'] = $_SESSION['rows']['date_issued'];

		$_SESSION['ll_title'] = $_SESSION['rows']['ll_title'];

		$_SESSION['ll_description'] = $_SESSION['rows']['ll_description'];

		$_SESSION['causes_findings'] = $_SESSION['rows']['causes_findings'];

		$_SESSION['corrective_actions'] = $_SESSION['rows']['corrective_actions'];

		$_SESSION['submitted_by'] = $_SESSION['rows']['submitted_by'];

		$_SESSION['last_update'] = $_SESSION['rows']['last_update'];

		$_SESSION['timestamp'] = $_SESSION['rows']['timestamp'];
		$_SESSION['before_attachment'] = $_SESSION['rows']['before_attachment'];
		$_SESSION['after_attachment'] = $_SESSION['rows']['after_attachment'];

		while($_SESSION['rows'] = mysqli_fetch_assoc($result)) 

		{

			echo '<script language="javascript">';

			echo 'alert("'.$document_no.'")';

			echo '</script>';

		}	

	} 

	else 

	{  

	}	

	mysqli_close($conn);

	}	

if(isset($_POST["get_doc_no"])){ 

	$ref_no=trim($_POST['get_doc_no']);	

	

	$conn=mysqli_connect("localhost","root","","bacs");

	if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

	$connectDb = mysqli_select_db($conn,'bacs');

	$query = "select * from ll where ref_no = '$ref_no'";

	$result = mysqli_query($conn,$query);

	$_SESSION['rows'] = mysqli_fetch_array($result);

	if (mysqli_num_rows($result) > 0) {

    	$_SESSION['document_no'] = $_SESSION['rows']['document_no'];
    	$_SESSION['ref_no'] = $_SESSION['rows']['ref_no'];

		$_SESSION['document_status'] = $_SESSION['rows']['document_status'];

		$_SESSION['delivery_team'] = $_SESSION['rows']['delivery_team'];

		$_SESSION['location'] = $_SESSION['rows']['location'];

		$_SESSION['date_issued'] = $_SESSION['rows']['date_issued'];

		$_SESSION['ll_title'] = $_SESSION['rows']['ll_title'];

		$_SESSION['ll_description'] = $_SESSION['rows']['ll_description'];

		$_SESSION['causes_findings'] = $_SESSION['rows']['causes_findings'];

		$_SESSION['corrective_actions'] = $_SESSION['rows']['corrective_actions'];

		$_SESSION['submitted_by'] = $_SESSION['rows']['submitted_by'];

		$_SESSION['last_update'] = $_SESSION['rows']['last_update'];

		$_SESSION['timestamp'] = $_SESSION['rows']['timestamp'];
		$_SESSION['before_attachment'] = $_SESSION['rows']['before_attachment'];
		$_SESSION['after_attachment'] = $_SESSION['rows']['after_attachment'];

		/*while($_SESSION['rows'] = mysqli_fetch_assoc($result)) 

		{

			echo '<script language="javascript">';

			echo 'alert("'.$ref_no.'")';

			echo '</script>';

		}*/	

	} 

	else 

	{  

	}	

	mysqli_close($conn);

	}


	//==============================Functions Area==============================

	function updatelldocument()

	{

		$updocument_no=$_POST['document_no'];		
		$upref_no=$_POST['document_no1'];

		$updocument_status=$_POST['document_status'];

		$updelivery_team=$_POST['delivery_team'];

		$uplocation=$_POST['location'];

		$update_issued=$_POST['date_issued'];

		$upll_title=$_POST['ll_title'];

		$upll_description=$_POST['ll_description'];

		$upcauses_findings=$_POST['causes_findings'];

		$upcorrective_actions=$_POST['corrective_actions'];

		$upsubmitted_by=$_POST['submitted_by'];

		$uplast_update=$_POST['last_update'];

		$uptimestamp=$_POST['timestamp'];	

	$conn=mysqli_connect("localhost","root","","bacs");

	if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

	$connectDb = mysqli_select_db($conn,'bacs');

	$update = "UPDATE ll SET document_status='$updocument_status'

	,delivery_team='$updelivery_team'

	,location='$uplocation'

	,date_issued='$update_issued'

	,ll_title='$upll_title'

	,ll_description='$upll_description'

	,causes_findings='$upcauses_findings'

	,corrective_actions='$upcorrective_actions'

	,submitted_by='$upsubmitted_by'	

	WHERE document_no='$updocument_no'";

	$result = mysqli_query( $conn, $update);	

	mysqli_close($conn);

	}

?>


<?php	
	//==============================Approve LL==============================

	function approve()

	{

			$loguser=$_SESSION["loguser"];

			$updocument_no=$_POST['document_no'];	

			$submitted=$_POST['submitted_by'];	

			$comment=$_POST['comment'];

			

			$conn=mysqli_connect("localhost","root","","bacs");

		if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

			$connectDb = mysqli_select_db($conn,'bacs');

			$update = "UPDATE ll SET document_status='Approved' WHERE document_no='$updocument_no'";

			$result = mysqli_query( $conn, $update);	

		mysqli_close($conn);

				

		//=====Send Approval Comments to Users=====

		$conn=mysqli_connect("localhost","root","","bacs");	

		$connectDb = mysqli_select_db($conn,'bacs');

		$query = "select * from users where username = '$submitted'";

		$result = mysqli_query($conn,$query);

		$_SESSION['rows'] = mysqli_fetch_array($result);

		$_SESSION['email'] = $_SESSION['rows']['email'];

		mysqli_close($conn);

			$message = '

					<h3>Congratulations! Your LL Document has been Approved.</h3>

					</br>

					<p>Reviewer Message: '. $comment.'</p>

					</br>

					<a href="http://3.21.91.216/BACS/all-login.php"> Click here to login.</a>

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

				$mail->From = $_SESSION['email'];					//Sets the From email address for the message

				$mail->FromName ='no-reply';				//Sets the From name of the message

				$mail->AddAddress($_SESSION['email']);//Adds a "To" address

				$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters

				$mail->IsHTML(true);							//Sets message type to HTML

				$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem			

				$mail->Subject = 'BACS LL Document Status';				//Sets the Subject of the message

				$mail->Body = $message;							//An HTML or plain text message body

				if($mail->Send())								//Send an Email. Return true on success or false on error

				{

					echo '<script language="javascript">';

					echo 'alert("LL Document has been Approved.")';

					echo '</script>';					

				}	
				

				//=====Insert Comments to DB=====	

				$conn=mysqli_connect("localhost","root","","bacs");	

				$connectDb = mysqli_select_db($conn,'bacs');

				$query = "INSERT into `user_comments`(document_no, commentfield, commentby) VALUES ('$updocument_no','$comment','$loguser')";

				$result = mysqli_query($conn,$query);

				$_SESSION['rows'] = mysqli_fetch_array($result);

				//$_SESSION['commentfield'] = $_SESSION['rows']['commentfield'];

				//$_SESSION['commentby'] = $_SESSION['rows']['commentby'];

				//$_SESSION['timestamp'] = $_SESSION['rows']['timestamp'];

				mysqli_close($conn);				

	}

?>


<?php	
	//==============================Reject LL==============================

	function reject()

	{

			$loguser=$_SESSION["loguser"];

			$comment=$_POST['comment'];

			$updocument_no=$_POST['document_no'];		

			$submitted=$_POST['submitted_by'];	

			$conn=mysqli_connect("localhost","root","","bacs");

		if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

			$connectDb = mysqli_select_db($conn,'bacs');

			$update = "UPDATE ll SET document_status='Rejected'	

			WHERE document_no='$updocument_no'";

			$result = mysqli_query( $conn, $update);	

		mysqli_close($conn);

		
		//=====Send Rejection Comments to Users=====

		$conn=mysqli_connect("localhost","root","","bacs");	

		$connectDb = mysqli_select_db($conn,'bacs');

		$query = "select * from users where username = '$submitted'";

		$result = mysqli_query($conn,$query);

		$_SESSION['rows'] = mysqli_fetch_array($result);

		$_SESSION['email'] = $_SESSION['rows']['email'];

		mysqli_close($conn);

			$message = '

					<h3>Your LL Document has been Rejected.</h3>

					</br>

					<p>Reviewer Message: '. $comment.'</p>

					</br>

					<a href="http://3.21.91.216/BACS/all-login.php"> Click here to login.</a>

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

				$mail->From = $_SESSION['email'];					//Sets the From email address for the message

				$mail->FromName ='no-reply';				//Sets the From name of the message

				$mail->AddAddress($_SESSION['email']);//Adds a "To" address

				$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters

				$mail->IsHTML(true);							//Sets message type to HTML

				$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem			

				$mail->Subject = 'BACS LL Document Status';				//Sets the Subject of the message

				$mail->Body = $message;							//An HTML or plain text message body

				if($mail->Send())								//Send an Email. Return true on success or false on error

				{

					echo '<script language="javascript">';

					echo 'alert("LL Document has been Rejected.")';

					echo '</script>';					

				}	



				//=====Insert Comment to DB=====

				$conn=mysqli_connect("localhost","root","","bacs");	

				$connectDb = mysqli_select_db($conn,'bacs');

				$query = "INSERT into `user_comments`(document_no, commentfield, commentby) VALUES ('$updocument_no','$comment','$loguser')";

				$result = mysqli_query($conn,$query);

				$_SESSION['rows'] = mysqli_fetch_array($result);

				//$_SESSION['commentfield'] = $_SESSION['rows']['commentfield'];

				//$_SESSION['commentby'] = $_SESSION['rows']['commentby'];

				//$_SESSION['timestamp'] = $_SESSION['rows']['timestamp'];

				mysqli_close($conn);			

	}

?>


<?php	
	//==============================Rollback LL==============================

	function rollback()

	{

			$loguser=$_SESSION["loguser"];

			$comment=$_POST['comment'];

			$updocument_no=$_POST['document_no'];

			$submitted=$_POST['submitted_by'];			

			$conn=mysqli_connect("localhost","root","","bacs");

		if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

			$connectDb = mysqli_select_db($conn,'bacs');

			$update = "UPDATE ll SET document_status='Rolled back'	

			WHERE document_no='$updocument_no'";

			$result = mysqli_query( $conn, $update);	

			mysqli_close($conn);

			
			//=====Send Rollback Comments to Users=====

			$conn=mysqli_connect("localhost","root","","bacs");	

			$connectDb = mysqli_select_db($conn,'bacs');

			$query = "select * from users where username = '$submitted'";

			$result = mysqli_query($conn,$query);

			$_SESSION['rows'] = mysqli_fetch_array($result);

			$_SESSION['email'] = $_SESSION['rows']['email'];

			mysqli_close($conn);

			$message = '

					<h3>Your LL Document has been Rolled back. Kindly update your LL as per comments below:</h3>

					</br>

					<p>Reviewer Message: '. $comment.'</p>

					</br>

					<a href="http://3.21.91.216/BACS/all-login.php"> Click here to login.</a>

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

				$mail->From = $_SESSION['email'];					//Sets the From email address for the message

				$mail->FromName ='no-reply';				//Sets the From name of the message

				$mail->AddAddress($_SESSION['email']);//Adds a "To" address

				$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters

				$mail->IsHTML(true);							//Sets message type to HTML

				$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem			

				$mail->Subject = 'BACS LL Document Status';				//Sets the Subject of the message

				$mail->Body = $message;							//An HTML or plain text message body

				if($mail->Send())								//Send an Email. Return true on success or false on error

				{

					echo '<script language="javascript">';

					echo 'alert("LL Document has been Rolled back to the Initiator.")';

					echo '</script>';					

				}	



				//=====Insert Comment to DB=====		

				$conn=mysqli_connect("localhost","root","","bacs");	

				$connectDb = mysqli_select_db($conn,'bacs');

				$query = "INSERT into `user_comments`(document_no, commentfield, commentby) VALUES ('$updocument_no','$comment','$loguser')";

				$result = mysqli_query($conn,$query);

				$_SESSION['rows'] = mysqli_fetch_array($result);

				//$_SESSION['commentfield'] = $_SESSION['rows']['commentfield'];

				//$_SESSION['commentby'] = $_SESSION['rows']['commentby'];

				//$_SESSION['timestamp'] = $_SESSION['rows']['timestamp'];

				mysqli_close($conn);				

	}

?>



<?php

Function ll_load()

{ 	

	$document_no=trim($_SESSION['document_no']);	

	

	$conn=mysqli_connect("localhost","root","","bacs");

	if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

	$connectDb = mysqli_select_db($conn,'bacs');

	$query = "select * from ll where document_no = '$document_no'";

	$result = mysqli_query($conn,$query);

	$_SESSION['rows'] = mysqli_fetch_array($result);

	if (mysqli_num_rows($result) > 0) {		

    	$_SESSION['document_no'] = $_SESSION['rows']['document_no'];
    	$_SESSION['ref_no'] = $_SESSION['rows']['ref_no'];

		$_SESSION['document_status'] = $_SESSION['rows']['document_status'];

		$_SESSION['delivery_team'] = $_SESSION['rows']['delivery_team'];

		$_SESSION['location'] = $_SESSION['rows']['location'];

		$_SESSION['date_issued'] = $_SESSION['rows']['date_issued'];

		$_SESSION['ll_title'] = $_SESSION['rows']['ll_title'];

		$_SESSION['ll_description'] = $_SESSION['rows']['ll_description'];

		$_SESSION['causes_findings'] = $_SESSION['rows']['causes_findings'];

		$_SESSION['corrective_actions'] = $_SESSION['rows']['corrective_actions'];

		$_SESSION['submitted_by'] = $_SESSION['rows']['submitted_by'];

		$_SESSION['last_update'] = $_SESSION['rows']['last_update'];
		$_SESSION['before_attachment'] = $_SESSION['rows']['before_attachment'];
		$_SESSION['after_attachment'] = $_SESSION['rows']['after_attachment'];

	}

mysqli_close($conn);

		$_SESSION['username2']=$_SESSION['username'];

}

?>

<?php

function commentbox(){

$document_no=trim($_SESSION['document_no']);	

	

	$conn=mysqli_connect("localhost","root","","bacs");

	if (!$conn)

	{

		die('Connection error'.mysqli_connect_error);

	}

	$connectDb = mysqli_select_db($conn,'bacs');

	$query = "select * from ll where document_no = '$document_no'";

	$result = mysqli_query($conn,$query);

	$_SESSION['rows'] = mysqli_fetch_array($result);

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="x-ua-compatible" content="ie=edge">
  

  <title>LL Reviewer | Dashboard </title>
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

  	 
<!--Modal-->

<script>

	$(document).ready(function(){

        $("#myModal").click(function(){

            $("#myModal").modal('show');

        });

    });

</script>


<script>

	$(document).ready(function(){

        $("#myModal2").click(function(){

            $("#myModal2").modal('show');

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

}

$(document).ready(function(){

        $("#btnSubmit").click(function(){   

			printData();

        });

    });

</script>

<!--/.Print Data Table--> 

</head>


<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

	<!--Navbar-->

  	<nav class="main-header navbar navbar-expand navbar-white navbar-light">

   
   	<!--Left Navbar Links (Hide/Unhide Sidebar Menu)-->

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

         	<span class="dropdown-item dropdown-header">Reviewer</span>

          	<div class="dropdown-divider"></div>

          	<a href="review-profile.php" class="dropdown-item">

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

	<center>  <a href="index3.html" class="brand-link">

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

         <a href="review-profile.php" class="d-block"><?php echo "Hello, " . $_SESSION["loguser"]."!"; ?></a>

        	</div>

      </div>
      

      <!--Sidebar Menu-->

      <nav class="mt-2">

      	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         <!--Add icons to the links using the .nav-icon class with font-awesome or any other icon font library-->

         	<li class="nav-item has-treeview menu-open">

            <a href="#" class="nav-link active">

            <i class="nav-icon fas fa-tachometer-alt"></i>

            <p>Reviewer Panel</p>

            <i class="right fas fa-angle-left"></i>

            </a>
            

            	<ul class="nav nav-treeview">

              		<li class="nav-item">

                	<a href="reviewer-LL-view.php" class="nav-link  active">

                  <i class="far fa-circle nav-icon"></i>

                  <p>Manage LLs</p>

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

                	<a href="review-profile.php" class="nav-link ">

                  <i class="far fa-circle nav-icon"></i>

                  <p>My Profile</p>

                	</a>

              		</li>

            	</ul>

          	</li>  

        	</ul>

		</nav><!--/.Sidebar Menu-->

		</div><!--/.Sidebar-->

	</aside>
	
	<!--Modal (Email LL)-->

   <div id="myModal" class="modal fade" tabindex="-1">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

				<h5 class="modal-title">Send file to Email</h5>

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				
				<div class="modal-body  centerthisinner">

				<?php				

				if (isset($_POST['submitemail']))

				{

					$email = trim($_REQUEST['email']);

					$path = 'upload/' . $_FILES["docu"]["name"];

					move_uploaded_file($_FILES["docu"]["tmp_name"], $path);

					
					$message = '

					<h3>This is an autogenerated email from BACS Quality Lessons Learned Information System.</h3>

					</br>

					<p>Please find attached LL Document copy as reference.</p>

					<p>Printed documents can become obsolete, please <a href="http://3.21.91.216/BACS/all-login.php">log in</a> to your account for the latest copy.</p>

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

					$mail->Subject = 'BACS Quality Lessons Learned';				//Sets the Subject of the message

					$mail->Body = $message;							//An HTML or plain text message body

					if($mail->Send())								//Send an Email. Return true on success or false on error

					{

						echo '<script language="javascript">';

						echo 'alert("LL Document has been sent to email successfully.")';

						echo '</script>';				

					}		

     			}

				?>
	
				<form action="" method="post" enctype="multipart/form-data">

				<input type="email" class="form-control mb-4" name="email" placeholder="Email e.g. example@email.com" required />

				<input type="file" name="docu" id="files"  multiple/>					

				</div>

			
				<div class="modal-footer">

				<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Cancel</button>

				<input type="submit" class="btn btn-primary btn-lg  centerthisinner" name="submitemail" value="Send" />

				</div>

				</form>

				</div>

			</div>

		</div><!--/.Modal (Email LL)-->
		 

	<!--Content Wrapper. Contains Page Content-->

  	<div class="content-wrapper">

   	<!--Content Header (Page Header)-->

    	<div class="content-header">

      <div class="container-fluid">

      	<div class="row mb-2">

         	<div class="col-sm-6">

            <h1 class="m-0 text-dark"> View/Review LL Documents</h1>

          	</div><!--/.col-->

          	<div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

            	<li class="breadcrumb-item"><a href="review-profile.php">LL Reviewer</a></li>

              	<li class="breadcrumb-item active">Manage LLs</li>

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

         </div>

         </div>

              
         <div class="card-body">

         <form class="text-center border border-light p-5" name="form" method="post" action=""> 				

			<p>Enter LL Document No.: <input type="text" name="ref_no" placeholder="" size = "30"  autocomplete="off" required  />			

			<input name="btn-update" class="btn btn-primary" type="submit" value="Show Details" /></p>

			</form>

			<div style="position:relative;height:900px;overflow-y: scroll;">

			<?php

					/*if(isset($_POST["btn-updatell"])){ 

					updatelldocument();

					ll_load();

					}

					else if(isset($_SESSION['document_no'])){	  

					  ll_load();					  

					}*/
					

					if(isset($_POST["btn-approve"]))

					{

						//echo"check approve";

						updatelldocument();

						approve();

						ll_load();

					}

					else if(isset($_POST["btn-reject"]))

					{				

						updatelldocument();

						reject();

						ll_load();

					}

					else if(isset($_POST["btn-rollback"]))

					{

						updatelldocument();

						rollback();

						ll_load();

					}



				  	else

				  	{  
				  		ll_load();							  

				  	}			

			?>	

			<table border="1">

				<th align="center">LL Document No.</th>

				<th align="center">Document Status</th>

				<th align="center">Submitted by</th>	

				<th align="center">Last Updated</th>	

			<?php

						$conn=new PDO('mysql:host=localhost; dbname=bacs', 'root', '') or die(mysql_error());

						$query="";

						$query=$conn->query("select * from ll " );

						$results = array();		

						while($row=$query->fetch()){
							$ref_no=$row['ref_no'];

							//$document_no=$row['document_no'];

							$document_status=$row['document_status'];

							$submitted_by=$row['submitted_by'];

							$last_update=$row['last_update'];

							//$timestamp=$row['timestamp'];

			?>

			<!--<tr><td>&nbsp;<?php echo $document_no ;?></td>-->
			<tr>
			<td><form method="post">
			<input type="submit" style="border:none;color:blue" name="get_doc_no" value="<?php echo $ref_no;?>"/>
			</form></td>

			<td>&nbsp;<?php echo $document_status;?></td>

			<td>&nbsp;<?php echo $submitted_by ;?></td>

			<td>&nbsp;<?php echo $last_update;?></td>	

			</tr>

			<?php }?>

			</table> 

			</div>						

			</div>	

			</div>		
			
					<div class="card-body" style="background-color:white; width:35%;">

					<div style="width:98%;text-align:right!important;">  
					<a  data-toggle="modal" data-target="#myModal" href="#"><img width="30" title="Email" src="image/mail.png"></a>
					<a id="btnSubmit" href="#"><img width="30" title="Print" style="vertical-align:middle;margin:5px" src="image/printlogo.png"></a></div>

         		
         		<form class="text-right border border-light p-4" name="form" method="post" action="" enctype="multipart/form-data"> 

					<input name="btn-approve" class="btn btn-primary" type="submit" value="Approve" />

					<input name="btn-reject" style="margin:3px;" class="btn btn-primary" type="submit" value="Reject" />

					<input name="btn-rollback" class="btn btn-primary" type="submit" value="Rollback" />

					</br>

					</br>	
					<h2 style="border-top:3px solid lightgray"></h2>
					</br>				
					

					<center><table id="printTable" style="text-align:left!important;">
					<tr><td><img src="image/bacslogo.png" style="width:110px;height:100px;"></td><td style="text-align:center"><h3>PROJECT QUALITY<br>LESSONS LEARNED</h3></td></tr>					
					
					<tr><td></td><td><input type="hidden" name="document_no" value="<?php echo  $_SESSION['document_no'] ;?>" placeholder=""  size="60" readonly/></td></tr>

					<tr><td>LL Document No.: </td><td><input type="text" name="document_no1" value="<?php echo  $_SESSION['ref_no'] ;?>" placeholder=""  size="60" readonly /></td></tr>

					<tr><td>Document Status: </td><td><input type="text" name="document_status" value="<?php echo  $_SESSION['document_status'] ;?>"placeholder="" size="60" readonly /></td></tr>

					<tr><td>Delivery Team: </td><td>  <input type="text" name="delivery_team" value="<?php echo  $_SESSION['delivery_team'] ;?>" placeholder="" size="60" autocomplete="off" required/></td></tr>

					<tr><td>Location:  </td><td>  <input type="text" name="location" value="<?php echo  $_SESSION['location'] ;?>" placeholder="" size="60" autocomplete="off" required/></td></tr>

					<tr><td>Date Issued:  </td><td>  <input type="text" name="date_issued" value="<?php echo  $_SESSION['date_issued'] ;?>" placeholder="" size="60" required /></td></tr>

					
					<tr><td>LL Title: </td><?php echo '<td><textarea type="text" style="width: 100%; font-family:Calibri; font:11px" rows="2" name="ll_title" placeholder="" autocomplete="off" required>' . $_SESSION['ll_title'] . '</textarea></td>';?></tr>						
					<tr><td>LL Description: </td><?php echo '<td><textarea type="text" style="width: 100%; font-family:Calibri; font:11px" rows="4" name="ll_description" placeholder="" autocomplete="off" required>' . $_SESSION['ll_description'] . '</textarea></td>';?></tr>						
					<tr><td>Causes/Findings: </td><?php echo '<td><textarea type="text" style="width: 100%; font-family:Calibri; font:11px" rows="4" name="causes_findings" placeholder="" autocomplete="off" required>' . $_SESSION['causes_findings'] . '</textarea></td>';?></tr>						
					<tr><td>Corrective Actions/<br>Key Lessons Learned: </td><?php echo '<td><textarea type="text" style="width: 100%; font-family:Calibri; font:11px" rows="4" name="corrective_actions" placeholder="" autocomplete="off" required>' . $_SESSION['corrective_actions'] . '</textarea></td>';?></tr>			
					
					<tr><td>Submitted by:  </td><td><input type="text" name="submitted_by" value="<?php echo  $_SESSION['submitted_by'] ;?>" placeholder="" size="60" autocomplete="off" readonly/></td></tr>

					<tr><td>Last Updated: </td><td><input type="text" name="last_update" value="<?php echo  $_SESSION['last_update'] ;?>" placeholder="" size="60" readonly /></td></tr>							

					<tr><td>Comment:  </td><td><input type="text" name="comment" value="" placeholder="" size="60" autocomplete="off" required/></td></tr>

							

					</form>

					

					<tr><td></br></td></tr>						

					<tr><td><h5 style="text-align:left!important;">Reference Photos:</h5></td>

					<td>

					<?php

					$document_no = "";
					$test=strval('attachments/'.$_SESSION['document_no'].'/');
					
					/*//get all text files with a .txt extension.
					$texts = glob($test . "*.{jpg,gif,png,txt,pdf}", GLOB_BRACE);
									
					//print each reference photos per LL document			
					foreach($texts as $image)
					{
    					echo '<img style="width:218px;height:170px;margin:5px" src="'.$image.'" />';
					}*/
					
					echo '<img style="width:218px;height:170px;margin:5px" src="'.$test.$_SESSION['before_attachment'].'" alt="No Before Photo uploaded yet."/>';	
					echo '<img style="width:218px;height:170px;margin:5px" src="'.$test.$_SESSION['after_attachment'].'" alt="No After Photo uploaded yet."/>';	
					

					?>

					</td></tr>

					<tr><td></br></td></tr>					 



					<tr><td><h5>Comments History:</h5></td></tr>

					

					<?php

					$document_no = $_SESSION['document_no'];

					$query=$conn->query("select * from user_comments where document_no = '$document_no'" );						

					while($row=$query->fetch()){

						//$document_no=$row['document_no'];

						$commentfield=$row['commentfield'];

						$submittedby=$row['commentby'];

						$timestamp=$row['timestamp'];

					?>  

					<tr><td colspan="2"><font size="2"><?php echo $submittedby ;?> on <?php echo $timestamp ;?>: </font><font size="2"><?php echo $commentfield ;?></font>

					</br>

					<?php }

					?>					

					</td></tr>

					</table></center>

					
					</div><!--/.card-->

				   </div><!--/.d-flex-->

					</div>

			  	</div>

			 </div><!--/.col-md-6-->

		  </div><!--/.row-->

		</div><!--/.container-fluid-->

		</div><!--/.Content-->

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

	<!--./wrapper-->


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