<?php
session_start();
if(!isset($_SESSION['org_username'])){
	header("location:index.php");
}

if(!isset($_SESSION['verify_status'])){
	header("location:verify_account.php");
}

$pagename = "My Exams";
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

	<script>
		function underscore(u){
			if(u.value.match(/\s/g)){
				u.value=u.value.replace(/\s/g, '_');
			}
		}
	</script>
</head>
<style>
	.new-exam-box{
		border-style: solid;
		border-color: black;
		box-shadow: 5px 5px 5px;
		background-image: url(images/design-ui.jpg);
		background-size: cover;
		background-attachment: fixed;
		background-repeat: no-repeat;
		color: white;
	}

	.table{
		margin: 0 auto;
		width: 80%;

	}

</style>
<body>
	<?php include "requirements/navbar.php"; ?>

	<div class="jumbotron m-5 new-exam-box text-center">
		<div class="m-3" style="font-size: 25px;">Your all exams are displayed below properly. Activate your exam at its start time to start it. You can also create new exam by clicking below.</div>
		<p class="lead">
			<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Create New Exam</a>
		</p>
	</div>

	<?php
	//display exams
	include "backend-functions/org_dbcon2.php";

	$get_exams = "SELECT * FROM all_exams";
	$get_exams_query = mysqli_query($org_con2, $get_exams);
	?>
	
	<table class="table mb-3">
		<thead class="thead-dark" style="background: black; color: white;">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Exam Name</th>
				<th scope="col">Exam Date</th>
				<th scope="col">Exam Start Time</th>
				<th scope="col">Exam Duration</th>
				<th scope="col">Actions</th>
				<th scope="col">View</th>
				<th scope="col">View</th>
				<th scope="col">View</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php
				while($exam_row = mysqli_fetch_assoc($get_exams_query)){
				?>
				<td><?php echo $exam_row['serial_no']; ?></td>
				<td><?php echo $exam_row['exam_name']; ?></td>
				<td><?php echo $exam_row['exam_date']; ?></td>
				<td><?php echo $exam_row['exam_start_time']; ?></td>
				<td><?php echo $exam_row['duration']." minutes"; ?></td>
				<td>
					<?php
					if($exam_row['exam_status'] == "inactive"){
						?>
						<a href="exam/activate_exam.php?examid=<?php echo $exam_row['exam_id']; ?>" class="btn btn-success">Start</a>
						<?php
					}else{
						?>
						<a href="#" class="btn btn-secondary">Started</a>
						<?php
					}
					?>
				</td>

				<td><a href="view/questions.php?examid=<?php echo $exam_row['exam_id']; ?>" class="btn btn-info">Questions</a></td>

				<td><a href="view/students.php?examid=<?php echo $exam_row['exam_id']; ?>" class="btn btn-info">Students</a></td>

				<td><a href="view/result.php?examid=<?php echo $exam_row['exam_id']; ?>" class="btn btn-warning">Result</a></td>

				<td><a href="exam/delete_exam.php?examid=<?php echo $exam_row['exam_id']; ?>" class="btn btn-danger">Delete</a></td>
			</tr>
			<?php
				}
			?>
			<!--<tr>
				<th scope="row">2</th>
				<td>Jacob</td>
				<td>Thornton</td>
				<td>@fat</td>
			</tr>

			<tr>
				<th scope="row">3</th>
				<td>Larry</td>
				<td>the Bird</td>
				<td>@twitter</td>
			</tr>-->
		</tbody>
	</table>

	<!--======================================================================-->
	<!--Create Exam Modal -->
	<div class="modal fade" style="width: 100%;" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Create New Exam</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" autocomplete="off">
						<div class="form-group">
							<label for="exampleInputExamName1">Exam Name :</label>
							<input type="text" name="examname" onkeyup="underscore(this)" style="text-transform: uppercase;" class="form-control" id="exampleInputExamName1" aria-describedby="examnameHelp" placeholder="Enter Exam Name" required>
						</div>
						<div class="form-group">
							<label for="exampleInputQuestions1">Total No. of Questions :</label>
							<input type="number" name="ques_no" class="form-control" id="exampleInputPassword1" placeholder="Enter total no. of questions in exam..." required>
						</div>
						<div class="form-group">
							<label for="exampleInputMarks1">Marks Per Each Question:</label>
							<input type="number" name="marks_per_ques" class="form-control" id="exampleInputPassword1" placeholder="Enter marks per questions..." required>
						</div>
						<div class="form-group">
							<label for="exampleInputDuration1">Duration of Exam :</label>
							<select name="duration" class="form-control" id="inputGroupSelect01" required>
								<option value="" selected>Select Duration...</option>
								<option value="10">10 minutes</option>
								<option value="15">15 minutes</option>
								<option value="30">30 minutes</option>
								<option value="60">60 minutes</option>
								<option value="90">90 minutes</option>
								<option value="120">120 minutes</option>
								<option value="150">150 minutes</option>
								<option value="180">180 minutes</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputExamDate1">Exam Date :</label>
							<input type="date" name="examdate" class="form-control" id="exampleInputExamDate1" aria-describedby="examdateHelp" placeholder="Enter Exam Date" required>
						</div>

						<div class="form-group">
							<label for="exampleInputExamTime1">Exam Start Time :</label>
							<input type="time" name="examtime" class="form-control" id="exampleInputExamTime1" aria-describedby="examtimeHelp" placeholder="Enter Exam Time" required>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button type="submit" name="create_exam" class="btn btn-success">Create Exam</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
	<!--==============================================================-->
	<?php
	//code to create exam
	if(isset($_POST['create_exam'])){

		$exam_name = strtoupper(mysqli_real_escape_string($org_con2, $_POST['examname']));
		$ques_no = mysqli_real_escape_string($org_con2, $_POST['ques_no']);
		$marks_per_ques = mysqli_real_escape_string($org_con2, $_POST['marks_per_ques']);
		$duration = mysqli_real_escape_string($org_con2, $_POST['duration']);
		$examdate = mysqli_real_escape_string($org_con2, $_POST['examdate']);
		$examtime = mysqli_real_escape_string($org_con2, $_POST['examtime']);
		$full_marks = $marks_per_ques * $ques_no ;
		$exam_id = bin2hex(random_int(2000, 100000));
		$exam_status = "inactive";

		$find_exam = "SELECT * FROM all_exams WHERE exam_name = '$exam_name'";
		$find_exam_query = mysqli_query($org_con2, $find_exam);

		$find_exam_count = mysqli_num_rows($find_exam_query);

		if($find_exam_count > 0){
			?>
			<script>
				alert("Exam of this name already exists. Enter new name for new exam or delete the old exam first....");
			</script>
			<?php
		}else{

			$add_exam = "INSERT INTO all_exams (serial_no, exam_name, no_of_ques, marks_per_ques, full_marks, duration, exam_date, exam_start_time, exam_id, exam_status, created_time) VALUES (NULL, '$exam_name', '$ques_no', '$marks_per_ques', '$full_marks', '$duration', '$examdate', '$examtime', '$exam_id', '$exam_status', current_timestamp())";

			$add_exam_query = mysqli_query($org_con2, $add_exam);

			$create_question_table = "CREATE TABLE exam_$exam_name (serial_no BIGINT(20) PRIMARY KEY AUTO_INCREMENT NOT NULL, question VARCHAR(1000) NOT NULL, question_id VARCHAR(1000) NOT NULL, optionA VARCHAR(1000) NOT NULL, optionA_id VARCHAR(1000) NOT NULL, optionB VARCHAR(1000) NOT NULL, optionB_id VARCHAR(1000) NOT NULL, optionC VARCHAR(1000) NOT NULL, optionC_id VARCHAR(1000) NOT NULL, optionD VARCHAR(1000) NOT NULL, optionD_id VARCHAR(1000) NOT NULL, correct_option_id VARCHAR(1000) NOT NULL, time_of_add DATETIME NOT NULL)";

			$create_question_table_query = mysqli_query($org_con2, $create_question_table);

			$create_student_table = "CREATE TABLE students_$exam_name (serial_no BIGINT(20) PRIMARY KEY AUTO_INCREMENT, student_name VARCHAR(100), student_id VARCHAR(100), student_password VARCHAR(5000), exam_name VARCHAR(100), exam_id VARCHAR(5000), added_time DATETIME, attendance VARCHAR(30))";

			$create_student_table_query = mysqli_query($org_con2, $create_student_table);

			$create_result_table = "CREATE TABLE result_$exam_name (serial_no BIGINT(20) PRIMARY KEY AUTO_INCREMENT, student_id VARCHAR(50), student_name VARCHAR(50), total_question VARCHAR(5), correct_answer VARCHAR(5), wrong_answer VARCHAR(5), score VARCHAR(5), submit_exam_time DATETIME)";

			$create_result_table_query = mysqli_query($org_con2, $create_result_table);

			if($add_exam_query and $create_question_table_query and $create_student_table_query and $create_result_table_query){
				$_SESSION['exam_name'] = $exam_name;
				$_SESSION['ques_no'] = $ques_no;
				$_SESSION['add_ques'] = "Add Question";
				?>
				<script>
					alert("Your Exam has been successfully created. Exam details are below.\n Exam Name : <?php echo $exam_name; ?>\n Total Questions : <?php echo $ques_no; ?>\n Marks per question : <?php echo $marks_per_ques; ?>\n Full Marks : <?php echo $full_marks; ?>\n Exam Date : <?php echo $examdate; ?>\n Exam Time : <?php echo $examtime; ?>\n Exam Duration : <?php echo $duration.' minutes'; ?>\n Now Add all Questions for this exam.");

					location.replace("addquestion.php");
				</script>
				<?php
			}else{
				?>
				<script>
					alert("Unable to create exam due to server issue. We are working on it. Please try after sometime.");
				</script>
				<?php
			}
		}
	}
	?>
	<!--======================================================================-->
	
</body>
</html>