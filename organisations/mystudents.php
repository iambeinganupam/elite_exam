<?php
session_start();
if(!isset($_SESSION['org_username'])){
	header("location:index.php");
}

if(!isset($_SESSION['verify_status'])){
	header("location:verify_account.php");
}

$pagename = "My Students";
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
		}
	</style>
</head>
<body>
	<?php include "requirements/navbar.php"; ?>

	<div class="m-5 new-box text-center">
		<div class="m-3" style="color: white; font-size: 25px;">Click on add students.</div>
		<p class="lead">
			<a href="#" class="btn btn-primary m-3" data-toggle="modal" data-target="#addstudentModalLong">Add Students</a>
		</p>
	</div>
	

	<!--======================================================================-->
	<?php
	include "backend-functions/org_dbcon2.php";

	$get_exams = "SELECT * FROM all_exams";
	$get_exams_query = mysqli_query($org_con2, $get_exams);
	?>
	<!--Add Students Modal -->
	<div class="modal fade" style="width: 100%;" id="addstudentModalLong" tabindex="-1" role="dialog" aria-labelledby="addstudentModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addstudentModalLongTitle">Select Exam</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" autocomplete="off">
						
						<div class="form-group">
							<label for="exampleInputDuration1">Select Exam :</label>
							<select name="for_exam" class="form-control" id="inputGroupSelect01" required>
								<option value="" selected>Select Exam...</option>
								<?php
								while($exam_row = mysqli_fetch_assoc($get_exams_query)){
									?>
									<option value="<?php echo $exam_row['exam_name']; ?>"><?php echo $exam_row['exam_name']; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							<button type="submit" name="next" class="btn btn-success">Next</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>

	<?php
	//add students
	if(isset($_POST['next'])){
		$for_exam = mysqli_real_escape_string($org_con2, $_POST['for_exam']);
		$_SESSION['for_exam'] = $for_exam;

		$get_examid = "SELECT * FROM all_exams WHERE exam_name = '$for_exam'";
		$get_examid_query = mysqli_query($org_con2, $get_examid);

		if($get_examid_query){
			while($examrow = mysqli_fetch_assoc($get_examid_query)){
				$_SESSION['examid'] = $examrow['exam_id'];
			}
		}

		?>
		<script>
			location.replace('addstudent.php');
		</script>
		<?php
	}
	?>

	
	<!--==============================================================-->
	
</body>
</html>