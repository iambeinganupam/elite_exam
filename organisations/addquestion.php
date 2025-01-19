<?php
session_start();
if(!isset($_SESSION['org_username'])){
	header("location:index.php");
}

if(!isset($_SESSION['verify_status'])){
	header("location:verify_account.php");
}

if(!isset($_SESSION['add_ques'])){
	header("location:myexams.php");
}

$pagename = "Add Questions";
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
		}

		.display-exam-name{
			margin: 0 auto;
			width: 50%;
			font-size: 20px;
		}

		.add-question-form{
			margin: 0 auto;
			width: 70%;
			background: #10D164;
			padding: 10px;

		}
	</style>
</head>
<body>
	<?php include "requirements/navbar.php"; ?>

	<div class="m-3 new-box text-center" style="background: transparent;">
		<div class="m-3" style="color: red; font-size: 20px; font-weight: bold;">NOTE: PLEASE ADD ALL QUESTIONS IN ONE GO. AFTER LOGGING OUT YOU WILL NOT BE ABLE TO ADD MORE QUESTIONS TO THIS EXAM. AFTER ADDING ALL QUESTIONS CLICK ON <span style="color: blue;">SAVE AND EXIT</span> FOR SECURITY PURPOSE.</div>
	</div>

	<div class="form-group display-exam-name">
		<label for="exampleInputExamName1">Exam Name :</label>
		<input type="text" class="form-control" id="exampleInputExamName1" placeholder="Exam Name" value="<?php echo $_SESSION['exam_name']; ?>" readonly>
	</div>

	<div class="mt-5 mb-5 add-question-form">
		<h3 style="text-align: center;">Add Questions</h3>
		<p style="color: red; font-size: 20px; font-weight: bold; text-transform: uppercase;">Please do not add question and options along with question number and option number respectively. It will be automatically assigned.</p>
		<form class="m-3" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleFormControlQuestion1" class="font-weight-bold">Question :</label>
				<textarea class="form-control" name="question" id="exampleFormControlTextarea1" rows="4"></textarea>

				<label for="exampleFormControlQuestion1" class="font-weight-bold">Option A :</label>
				<textarea class="form-control" name="optionA" id="exampleFormControlTextarea1" rows="1"></textarea>

				<label for="exampleFormControlQuestion1" class="font-weight-bold">Option B :</label>
				<textarea class="form-control" name="optionB" id="exampleFormControlTextarea1" rows="1"></textarea>

				<label for="exampleFormControlQuestion1" class="font-weight-bold">Option C :</label>
				<textarea class="form-control" name="optionC" id="exampleFormControlTextarea1" rows="1"></textarea>

				<label for="exampleFormControlQuestion1" class="font-weight-bold">Option D :</label>
				<textarea class="form-control" name="optionD" id="exampleFormControlTextarea1" rows="1"></textarea>

				<?php
				$question_id = random_int(11111, 9999999);
				$optionA_id = "a";
				$optionB_id = "b";
				$optionC_id = "c";
				$optionD_id = "d";
				?>

				<label for="exampleInputAnswer1" class="font-weight-bold">Correct Option :</label>
				<select name="correct_option_id" class="form-control" id="inputGroupSelect01" required>
					<option value="" selected>Select Correct Option...</option>
					<option value="<?php echo $optionA_id; ?>">A</option>
					<option value="<?php echo $optionB_id; ?>">B</option>
					<option value="<?php echo $optionC_id; ?>">C</option>
					<option value="<?php echo $optionD_id; ?>">D</option>
				</select>

				<div class="text-center m-3">
					<button type="submit" name="addquestion" class="btn btn-danger">Add Question</button>
					<a class="btn btn-primary m-2" href="exam/saveandexit.php" >Save and Exit</a>
				</div>
				
			</div>
		</form>
	</div>

	<?php
	//add question
	include "backend-functions/org_dbcon2.php";
	if(isset($_POST['addquestion'])){
		$exam = strtolower($_SESSION['exam_name']);
		$question = mysqli_real_escape_string($org_con2, $_POST['question']);
		$optionA = mysqli_real_escape_string($org_con2, $_POST['optionA']);
		$optionB = mysqli_real_escape_string($org_con2, $_POST['optionB']);
		$optionC = mysqli_real_escape_string($org_con2, $_POST['optionC']);
		$optionD = mysqli_real_escape_string($org_con2, $_POST['optionD']);

		$correct_option_id = $_POST['correct_option_id'];

		$add_question = "INSERT INTO exam_$exam (serial_no, question, question_id, optionA, optionA_id, optionB, optionB_id, optionC, optionC_id, optionD, optionD_id, correct_option_id, time_of_add) VALUES (NULL, '$question', '$question_id', '$optionA', '$optionA_id', '$optionB', '$optionB_id', '$optionC', '$optionC_id', '$optionD', '$optionD_id', '$correct_option_id', current_timestamp())";

		$add_question_query = mysqli_query($org_con2, $add_question);

		if($add_question_query){
			?>
			<script>
				alert("Question successfully added");
			</script>
			<?php
		}else{
			?>
			<script>
				alert("Could not add question at this moment due to server issue.");
			</script>
			<?php
		}
	}

	?>
	<!--======================================================================-->
	
</body>
</html>