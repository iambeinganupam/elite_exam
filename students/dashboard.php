<?php
session_start();
if(!isset($_SESSION['student_id'])){
	header("location:index.php");
}

unset($_SESSION['exam_start']);
unset($_SESSION['answer']);

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
</head>
<style>
	.new-exam-box{
		border-style: solid;
		border-color: black;
		box-shadow: 5px 5px 5px;
		margin: 0 auto;
		background-image: url(images/design-ui.jpg);
		background-size: cover;
		background-attachment: fixed;
		background-repeat: no-repeat;
		color: white;
	}

	.not-allowed{
		cursor: not-allowed;
	}
</style>
<body>
	<?php include "requirements/navbar.php"; ?>

	<div class="jumbotron m-5 new-exam-box text-center">
		<h1><?php echo $_SESSION['orgname']; ?></h1>
		<div class="m-3" style="font-size: 20px;">
			<span>
				Exam Name : <?php echo $_SESSION['exm_name']; ?>
			</span><br>

			<span>
				Exam Date : <?php echo $_SESSION['exm_date']; ?>
			</span><br>

			<span>
				Exam Time : <?php echo $_SESSION['exm_start_time']; ?>
			</span>
		</div>

		<?php
		include "backend-functions/org_dbcon2.php";
		$sid = $_SESSION['student_id'];
		$ename = $_SESSION['exm_name'];
		$exm_status_details = "SELECT * FROM all_exams WHERE exam_name = '$ename'";
		$exm_status_details_query = mysqli_query($org_con2, $exm_status_details);

		$attendance_status = "SELECT * FROM students_$ename WHERE student_id = '$sid'";
		$attendance_status_query = mysqli_query($org_con2, $attendance_status);

		while($exm_status_row = mysqli_fetch_assoc($exm_status_details_query) and $attendance_status_row = mysqli_fetch_assoc($attendance_status_query)){

			$exmstatus = $exm_status_row['exam_status'];
			$attndcstatus = $attendance_status_row['attendance'];

			if($attndcstatus == "PRESENT"){
				?>
				<p class="lead">
					<button href="#" class="btn btn-success">Submitted</button>
				</p>
				<?php
			}elseif($exm_status_row['exam_status'] == "active"){
				?>
				<p class="lead">
					<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
						<button name="startexam" class="btn btn-danger">Start Exam</button>
					</form>
				</p>
				<?php
			}else{
				?>
				<p class="lead">
					<button href="#" class="btn btn-secondary not-allowed" disabled>Start Exam</button>
				</p>
				<?php
			}
		}
		?>
	</div>

	<?php
	if(isset($_POST['startexam'])){
		$update_attendance = "UPDATE students_$ename SET attendance = 'PRESENT' WHERE student_id = '$sid'";
		$attendance_query = mysqli_query($org_con2, $update_attendance);
		$_SESSION['exam_start'] = "set";
		?>
		<script>
			location.replace("exam.php");
		</script>
		<?php
	}
	?>
	<!--======================================================================-->
	
</body>
</html>