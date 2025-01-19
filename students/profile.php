<?php
session_start();
if(!isset($_SESSION['student_id'])){
	header("location:index.php");
}

$pagename = "My Profile";
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

	<!--=====================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">

	<!--jQuery Js-->
	<script src="js/jquery.js"></script>

	<!--Bootstrap Js-->
	<script src="js/bootstrap.min.js"></script>
</head>
<style>
	.styled-table {
		border-collapse: collapse;
		margin-top: 80px;
		margin-left: 30%;
		font-size: 0.9em;
		font-family: sans-serif;
		min-width: 400px;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
	}

	.styled-table thead tr {
		background-color: #009879;
		color: #ffffff;
		text-align: left;
	}
	.styled-table th,
	.styled-table td {
		padding: 12px 15px;
	}

	.styled-table tbody tr {
		border-bottom: 1px solid #dddddd;
	}

	.styled-table tbody tr:nth-of-type(even) {
		background-color: #f3f3f3;
	}

	.styled-table tbody tr:last-of-type {
		border-bottom: 2px solid #009879;
	}

	.styled-table tbody tr.active-row {
		font-weight: bold;
		color: #009879;
	}

	/*Profile*/

	.profile-box{
		margin-top: 40px;
		margin-bottom: 30px;
		margin-left: 20%;
		width: 70%;
		border-radius: 5px;
		border-color: black;
		background-image: url(images/design-ui.jpg);
		background-size: cover;
		background-repeat: no-repeat;
		padding: 40px;

	}

	.profile-display{
		width: 100%;
	}

	label{
		color: white;
		font-weight: bold;
		text-transform: uppercase;
	}



</style>
<body>
	<?php include "requirements/navbar.php"; ?>

	<div class="profile-box">
		<form class="profile-display">
			<div class="form-group">
				<label for="exampleInputUsername1">Organisation Name :</label>
				<input type="text" class="form-control" value="<?php echo $_SESSION['org_name']; ?>" readonly>
			</div>

			<div class="form-group">
				<label class="lbl" for="exampleInputName1">Student Name :</label>
				<input type="text" class="form-control" value="<?php echo $_SESSION['student_name']; ?>" readonly>
			</div>

			<div class="form-group">
				<label for="exampleInputMobile1">Student ID :</label>
				<input type="text" class="form-control" value="<?php echo $_SESSION['student_id']; ?>" readonly>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Exam Name:</label>
				<input type="text" class="form-control" value="<?php echo $_SESSION['exm_name']; ?>" readonly>
			</div>
		</form>
	</div>
	
	<!--<table class="styled-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Points</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Dom</td>
            <td>6000</td>
        </tr>
        <tr class="active-row">
            <td>Melissa</td>
            <td>5150</td>
        </tr>
    </tbody>
</table>-->
	<!--======================================================================-->
	
</body>
</html>