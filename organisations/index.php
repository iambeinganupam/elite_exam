<?php
session_start();
if(isset($_SESSION['org_username'])){
	header("location:dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Institute Login</title>
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
						Institute Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" style="text-transform: lowercase;" type="text" name="org_username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="org_password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
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

					<div class="text-center p-t-20">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>

					<div class="text-center p-t-20 txt1">
						Don't have account?
						<a class="txt1" href="register.php">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	include "backend-functions/dbcon.php";

	if(isset($_POST['login'])){
		$org_username = strtolower(mysqli_real_escape_string($con, $_POST['org_username']));
		$org_password = sha1(mysqli_real_escape_string($con, $_POST['org_password']));

		$search_data = "SELECT * FROM organisations WHERE username = '$org_username' AND password = '$org_password' ";

		$search_query = mysqli_query($con, $search_data);

		$search_count = mysqli_num_rows($search_query);

		if($search_count > 0){
			while($row = mysqli_fetch_assoc($search_query)){
				$_SESSION['org_name'] = $row['name'];
				$_SESSION['org_mobile'] = $row['mobile'];
				$_SESSION['org_email'] = $row['email'];
				$_SESSION['org_username'] = $row['username'];
				$_SESSION['org_password'] = $row['password'];
				$_SESSION['org_id'] = $row['org_id'];
				$_SESSION['org_code'] = $row['login_code'];
				$_SESSION['verify_status'] = "Verified";
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