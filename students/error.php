<?php
session_start();
if(!isset($_SESSION['student_id'])){
	header("location:index.php");
}

if(!isset($_SESSION['submit_unsuccess'])){
	header("location:exam.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exam Not Submitted</title>
	<!--====================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--=====================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
	<center class="m-3">
		<img src="images/error.png" height="80">
		<div style="font-size: 30px; font-family: sans-serif; font-weight: bold;">
			Exam Not Submitted.
		</div>
		<span style="font-size: 25px;">Your Session ID : <?php echo $_SESSION['session_id']; ?></span><br><br>
		<span style="font-size: 25px; font-weight: bold; color: blue;">Please Take a Screenshot of this page for future reference.</span><br><br>
		<a href="requirements/logout.php" class="btn btn-danger">Log Out</a>
	</center>
</body>
</html>