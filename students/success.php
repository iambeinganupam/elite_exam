<?php
session_start();
if(!isset($_SESSION['student_id'])){
	header("location:index.php");
}

if(!isset($_SESSION['submit_success'])){
	header("location:exam.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exam Submitted</title>
	<!--====================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--=====================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
	<center class="m-3">
		<img src="images/success.png" height="80">
		<div style="font-size: 30px; font-family: sans-serif; font-weight: bold;">
			Exam Submitted Successfully.
		</div>
		<span style="font-size: 25px;">Please logout for security purpose.</span><br><br>
		<a href="requirements/logout.php" class="btn btn-danger">Log Out</a>
	</center>
</body>
</html>