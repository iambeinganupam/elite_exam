<?php
session_start();
if(!isset($_SESSION['org_username'])){
	header("location:index.php");
}

if(!isset($_SESSION['verify_status'])){
	header("location:verify_account.php");
}

$pagename = "Dashboard";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard | Exam Portal</title>
	<!--====================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--=====================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<!--jQuery Js-->
	<script src="js/jquery.js"></script>

	<!--Bootstrap Js-->
	<script src="js/bootstrap.min.js"></script>

	<style>
		.instruction-box{
			border-style: solid;
			border-color: black;
			box-shadow: 5px 5px 5px;
			background-image: url(images/design-ui.jpg);
		    background-size: cover;
		    background-attachment: fixed;
		    background-repeat: no-repeat;
		    color: white;
		}
	</style>
</head>
<body>
	<?php include "requirements/navbar.php"; ?>
	<div class="jumbotron instruction-box m-4">
		<h1><?php echo "Hello ".$_SESSION['org_name']; ?></h1><br>
		<span style="font-size: 30px;">Your Login Code is <?php echo $_SESSION['org_code']; ?>.<br>
		Share this code to students for their login.</span>
	</div>
	<!--======================================================================-->
	
</body>
</html>