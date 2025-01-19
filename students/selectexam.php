<?php
session_start();
if(!isset($_SESSION['org_user_name'])){
	header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Organisation Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<?php
	$org_username = $_SESSION['org_user_name'];
	include "backend-functions/org_dbcon2.php";

	$fetch_exam = "SELECT * FROM all_exams";
	$fetch_exam_query = mysqli_query($org_con2, $fetch_exam);
	?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="background: black;">
				<form class="login100-form validate-form" method="post" autocomplete="off" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
					<span class="login100-form-logo">
						<img src="images/logo/logo.png" height="320">
						<!--<i class="zmdi zmdi-landscape"></i>-->
					</span>

					<span class="login100-form-title p-b-34 p-t-32 m-t-10">
						Student Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Select Exam">
						<select class="input100" style="background: black; color: white;" name="exam" placeholder="Enter Login code of organisation">
							<option value="" selected>Select Exam</option>
							<?php
							while($exam_row = mysqli_fetch_assoc($fetch_exam_query)){
								?>
								<option value="<?php echo strtolower($exam_row['exam_name']); ?>"><?php echo $exam_row['exam_name']; ?></option>
								<?php
							}
							?>
						</select>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<!--<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>-->

					<div class="container-login100-form-btn">
						<button type="submit" name="next2" class="login100-form-btn">
							Next
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	include "backend-functions/org_dbcon2.php";
	if(isset($_POST['next2'])){
		$examname = mysqli_real_escape_string($org_con2, $_POST['exam']);

		$caps_examname = strtoupper($examname);

		$get_exam_details = "SELECT * FROM all_exams WHERE exam_name = '$caps_examname'";
		$get_exam_details_query = mysqli_query($org_con2, $get_exam_details);

		while ($exm_details_row = mysqli_fetch_assoc($get_exam_details_query)) {
			$_SESSION['exm_name'] = $exm_details_row['exam_name'];
			$_SESSION['no_ofques'] = $exm_details_row['no_of_ques'];
			$_SESSION['marksper_ques'] = $exm_details_row['marks_per_ques'];
			$_SESSION['fullmarks'] = $exm_details_row['full_marks'];
			$_SESSION['durat_ion'] = $exm_details_row['duration'];
			$_SESSION['exm_date'] = $exm_details_row['exam_date'];
			$_SESSION['exm_start_time'] = $exm_details_row['exam_start_time'];
			$_SESSION['exm_id'] = $exm_details_row['exam_id'];
			$_SESSION['exm_status'] = $exm_details_row['exam_status'];
		}
		?>
		<script>
			location.replace("studentlogin.php");
		</script>
		<?php
	}
	?>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>