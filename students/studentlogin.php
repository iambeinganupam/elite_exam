<?php
session_start();
if(!isset($_SESSION['org_user_name'])){
	header("location:index.php");
}

if(!isset($_SESSION['exm_name'])){
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

					<div class="wrap-input100 validate-input" data-validate = "Enter Sudent ID">
						<input class="input100" type="text" style="text-transform: uppercase;" name="student_id" placeholder="Enter Student ID">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter Student Password">
						<input class="input100" type="password" name="student_password" placeholder="Enter Student Password">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<!--<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>-->

					<div class="container-login100-form-btn">
						<button type="submit" name="login" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	include "backend-functions/org_dbcon2.php";

	if(isset($_POST['login'])){
		$student_id = strtoupper(mysqli_real_escape_string($org_con2, $_POST['student_id']));

		$student_password = mysqli_real_escape_string($org_con2, $_POST['student_password']);

		$exmname = $_SESSION['exm_name'];

		$search_student = "SELECT * FROM students_$exmname WHERE student_id = '$student_id' AND student_password = '$student_password'";

		$search_student_query = mysqli_query($org_con2, $search_student);

		$search_student_query_count = mysqli_num_rows($search_student_query);

		if($search_student_query_count > 0){
			while($student_row = mysqli_fetch_assoc($search_student_query)){
				$_SESSION['student_id'] = $student_row['student_id'];
				$_SESSION['student_name'] = $student_row['student_name'];
				?>
				<script>
					location.replace("dashboard.php");
				</script>
				<?php
			}
		}else{
			?>
			<script>
				alert("Invalid login details...");
			</script>
			<?php
		}


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