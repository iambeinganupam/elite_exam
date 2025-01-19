<?php
session_start();
if(!isset($_SESSION['org_username'])){
	header("location:index.php");
}

if(!isset($_SESSION['verify_status'])){
	header("location:verify_account.php");
}

if(!isset($_SESSION['for_exam'])){
	header("location:mystudents.php");
}

$pagename = "Add Students";
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
		.new-box{
			border-style: solid;
			border-color: black;
			box-shadow: 5px 5px 5px;
			background-image: url(images/design-ui.jpg);
		    background-size: cover;
		    background-attachment: fixed;
		    background-repeat: no-repeat;
		    color: white;
		    min-height: 100vh;
		}

		form{
			margin: 0 auto;
			width: 70%;
			font-weight: bold;
			font-size: 30px;
		}
	</style>
</head>
<body>
	<?php include "requirements/navbar.php"; ?>

	<div class="new-box">
		<form class="mt-4" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" autocomplete="off">
			<div class="form-group">
				<label for="exampleInputStudentName1">Student Name :</label>
				<input type="text" name="student_name" style="text-transform: uppercase;" class="form-control" id="exampleInputStudentName1" aria-describedby="studentnameHelp" placeholder="Enter Student Name" required>
			</div>

			<div class="form-group">
				<button type="submit" name="add_students" class="btn btn-success">Add student</button>
				<button type="button" class="btn btn-primary">Save and Exit</button>
			</div>
		</form>
	</div>
	

	<!--======================================================================-->
	<?php
	include "backend-functions/org_dbcon2.php";
	//add students
	if(isset($_POST['add_students'])){
		$student_name = strtoupper(mysqli_real_escape_string($org_con2, $_POST['student_name']));
		$student_id = substr($student_name, 0, 4).rand(10000, 99999);
		$student_password = bin2hex(openssl_random_pseudo_bytes(4));
		$examname = $_SESSION['for_exam'];
		$lowerexam_name = strtolower($examname);
		$examid = $_SESSION['examid'];
		$lower_studentid = strtolower($student_id);
		$underscore = "_";
		$attendance = "NA";

		$add_student = "INSERT INTO students_$lowerexam_name (serial_no, student_name, student_id, student_password, exam_name, exam_id, added_time, attendance) VALUES (NULL, '$student_name', '$student_id', '$student_password', '$examname', '$examid', current_timestamp(), '$attendance')";

		$add_student_query = mysqli_query($org_con2, $add_student);

		if($add_student_query){
			?>
			<script>
				alert("<?php echo $student_name; ?> has been successfully added for <?php echo $examname; ?>\n Login details for <?php echo $student_name; ?> is below :\n STUDENT ID : <?php echo $student_id; ?>\n STUDENT PASSWORD : <?php echo $student_password; ?>\n YOU CAN ALSO VIEW STUDENTS' LOGIN DETAILS FROM MY EXAM PAGE - VIEW STUDENT BUTTON.");
			</script>
			<?php
		}else{
			?>
			<script>
				alert("Unable to add student due to server error.");
			</script>
			<?php
		}
	}
	?>

	
	<!--==============================================================-->
	
</body>
</html>