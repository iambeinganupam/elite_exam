<?php
session_start();
if(isset($_SESSION['org_username'])){
	header("location:dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Institute Registration</title>
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
				<form class="login100-form validate-form" autocomplete="off" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" >
					<span class="login100-form-logo">
						<img src="images/logo/logo.png" height="320">
						<!--<i class="zmdi zmdi-landscape"></i>-->
					</span>

					<span class="login100-form-title p-b-34 p-t-32 m-t-10">
						Institute Registration
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter Organisation Name">
						<input class="input100" type="text" name="org_name" placeholder="Organisation Name" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter Mobile Number">
						<input class="input100" type="tel" name="org_mobile" placeholder="Mobile number" required>
						<span class="focus-input100" data-placeholder="&#xf2b6;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter Email Id">
						<input class="input100" type="email" name="org_email" placeholder="Email Id" required>
						<span class="focus-input100" data-placeholder="&#xf003;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter Username">
						<input class="input100" style="text-transform: lowercase;" type="text" name="org_username" placeholder="Username" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="org_password" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="agree_terms_and_policy" required>
						<label class="label-checkbox100" for="ckb1">
							I agree to all <a href="termsandpolicy.php" style="color: cyan;"> Terms and Policy </a> of Exam Portal Platform.
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="create_org_account">
							Create Account
						</button>
					</div>

					<div class="text-center p-t-20 txt1">
						Already have account?
						<a class="txt1" href="index.php">
							Sign In
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	include "backend-functions/dbcon.php";
	if(isset($_POST['create_org_account'])){

		$org_name = mysqli_real_escape_string($con, $_POST['org_name']);
		$org_mobile = mysqli_real_escape_string($con, $_POST['org_mobile']);
		$org_email = mysqli_real_escape_string($con, $_POST['org_email']);
		$org_username = strtolower(mysqli_real_escape_string($con, $_POST['org_username']));
		$org_password = sha1(mysqli_real_escape_string($con, $_POST['org_password']));
		$org_id = bin2hex(openssl_random_pseudo_bytes(100));
		$org_code = $org_username.random_int(100, 10000);

		$_SESSION['org_name'] = $org_name;
		$_SESSION['org_mobile'] = $org_mobile;
		$_SESSION['org_email'] = $org_email;
		$_SESSION['org_username'] = $org_username;
		$_SESSION['org_password'] = $org_password;
		$_SESSION['org_id'] = $org_id;
		$_SESSION['org_code'] = $org_code;
		
		//write code to send otp on mobile and email for verification...

		$find_username = "SELECT * FROM organisations WHERE username = '$org_username'";
		$find_query = mysqli_query($con, $find_username);

		$username_count = mysqli_num_rows($find_query);

		if($username_count > 0){
			?>
			<script>
				alert("Account with this username already exists. Please try again...");
			</script>
			<?php
		}else{
			?>
			<script>
				alert("We have sent you OTP on your mobile and email...");
				location.replace("verify_account.php?username=<?php echo $_SESSION['org_username']; ?>");
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