<?php
session_start();
if(!isset($_SESSION['org_username'])){
	header("location:index.php");
}
if(isset($_SESSION['verify_status'])){
	header("location:dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Organisation Verification</title>
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
		<div class="container-login100" style="background: white;">
			<div class="wrap-login100" style="background: black;">
				<form class="login100-form validate-form" autocomplete="off" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
					<span class="login100-form-logo">
						<img src="images/logo/logo.png" height="320">
						<!--<i class="zmdi zmdi-landscape"></i>-->
					</span>

					<span class="login100-form-title p-b-34 p-t-32 m-t-10">
						Enter OTP
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter OTP for mobile">
						<input class="input100" type="text" name="mobile_otp" placeholder="Enter OTP sent on mobile..." required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter OTP for email">
						<input class="input100" type="text" name="email_otp" placeholder="Enter OTP sent on email..." required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<!--<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>-->

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="verify">
							Verify
						</button>
					</div>

					<!--<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>-->
				</form>
			</div>
		</div>
	</div>

	<?php
	include "backend-functions/dbcon.php";
	if(isset($_POST['verify'])){

		$name = $_SESSION['org_name'];
		$mobile = $_SESSION['org_mobile'];
		$email = $_SESSION['org_email'];
		$username = $_SESSION['org_username'];
		$password = $_SESSION['org_password'];
		$uniqueid = $_SESSION['org_id'];
		$orgcode = $_SESSION['org_code'];

		//write code to verify email and mobile
		$_SESSION['verify_status'] = "Verified";

		$insert_data = "INSERT INTO organisations (serial, name, mobile, email, username, password, login_code, org_id, time_of_register) VALUES (NULL, '$name', '$mobile', '$email', '$username', '$password', '$orgcode', '$uniqueid', current_timestamp())";

		$insert_query = mysqli_query($con, $insert_data);

		if($insert_query){
			?>
			<!--<script>
				alert("Sign Up successful. Welcome to Exam portal.");
			</script>-->
			<?php

			include "backend-functions/newdb.php";

		}else{
			?>
			<script>
				alert("Unable to register at this moment due to server issue. Please try later...");
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