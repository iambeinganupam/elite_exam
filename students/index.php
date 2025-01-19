<?php
session_start();
if(isset($_SESSION['org_user_name'])){
	header("location:selectexam.php");
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

					<div class="wrap-input100 validate-input" data-validate = "Enter Organisation Login Code">
						<input class="input100" type="text" style="text-transform: lowercase;" name="org_logincode" placeholder="Enter Login code of organisation">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<!--<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>-->

					<div class="container-login100-form-btn">
						<button type="submit" name="next" class="login100-form-btn">
							Next
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	include "backend-functions/dbcon.php";

	if(isset($_POST['next'])){
		$org_logincode = mysqli_real_escape_string($con, $_POST['org_logincode']);

		$search_org = "SELECT * FROM organisations WHERE login_code = '$org_logincode' ";

		$search_org_query = mysqli_query($con, $search_org);

		$search_org_query_count = mysqli_num_rows($search_org_query);

		if($search_org_query_count > 0){
			while($org_row = mysqli_fetch_assoc($search_org_query)){
				$_SESSION['org_user_name'] = $org_row['username'];
				$_SESSION['orgname'] = $org_row['name'];
				?>
				<script>
					location.replace("selectexam.php");
				</script>
				<?php
			}
		}else{
			?>
			<script>
				alert("Invalid login code...");
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