<?php
session_start();

if(!isset($_SESSION['org_username'])){
	header("location:../index.php");
}

if(!isset($_SESSION['verify_status'])){
	header("location:../verify_account.php");
}

include "../backend-functions/org_dbcon2.php";

if(isset($_GET['examid'])){
	$exam_id = $_GET['examid'];

	$fetch_exam_details = "SELECT * FROM all_exams WHERE exam_id = '$exam_id'";
	$fetch_exam_details_query = mysqli_query($org_con2, $fetch_exam_details);

	if($fetch_exam_details_query){
		?>

		<!DOCTYPE html>
		<html>
		    <head>
		    	<meta charset="utf-8">
		    	<meta name="viewport" content="width=device-width, initial-scale=1">
		    	<title>View Exams</title>

		    	<!--=======================================================================-->
		    	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
		    	<!--===========+===========================================================-->
		    	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

		    	<!--jQuery Js-->
		    	<script src="../js/jquery.js"></script>

		    	<!--Bootstrap Js-->
		    	<script src="../js/bootstrap.min.js"></script>
		    	<style type="text/css">
		    		body{
		    			background-image: url(../images/design-ui.jpg);
		    			background-repeat: no-repeat;
		    			background-position: center;
		    			background-size: cover;
		    			background-attachment: fixed;
		    		}

		    		thead{
		    			font-size: 20px;
		    			background: black;
		    			color: white;
		    		}

		    		tbody{
		    			color: white;
		    			font-size: 20px;
		    		}
		    	</style>
		    </head>

		    <body>
		    	<nav class="navbar navbar-expand-lg sticky-top" style="background: black; height: 80px;">

		    		<a href="#" class="navbar-brand" style="margin-top: -3px;">
		    			<img src="../images/logo/header-logo.png" style="margin-left: 50px; height: 180px; width: 400px;" class="d-inline-block align-top" alt="">
		    			<!--<?php echo $pagename; ?>-->
		    		</a>

		    		<!--<h3 style="color: cyan; margin-left: 1%;"><?php echo $pagename; ?></h3>-->
		    	</nav><br>
		    	<?php
		    	while($fetch_row = mysqli_fetch_assoc($fetch_exam_details_query)){
		    		?>

		    		<table class="table">
		    			<thead class="thead-dark" style="background: black; color: white;">
		    				<tr>
		    					<th scope="col">#</th>
		    					<th scope="col">Exam Name</th>
		    					<th scope="col">Total Questions</th>
		    					<th scope="col">Marks per Question</th>
		    					<th scope="col">Full Marks</th>
		    					<th scope="col">Exam Date</th>
		    					<th scope="col">Exam Start Time</th>
		    					<th scope="col">Exam Duration</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				<tr>
		    					<td><?php echo $fetch_row['serial_no']; ?></td>
		    					<td><?php echo $fetch_row['exam_name']; ?></td>
		    					<td><?php echo $fetch_row['no_of_ques']; ?></td>
		    					<td><?php echo $fetch_row['marks_per_ques']; ?></td>
		    					<td><?php echo $fetch_row['full_marks']; ?></td>
		    					<td><?php echo $fetch_row['exam_date']; ?></td>
		    					<td><?php echo $fetch_row['exam_start_time']; ?></td>
		    					<td><?php echo $fetch_row['duration']." minutes"; ?></td>
		    				</tr>
		    			</tbody>
		    		</table><hr size="90">

		    		<?php
		    		$lower_examname = strtolower($fetch_row['exam_name']);

		    		$get_results = "SELECT * FROM result_$lower_examname";
		    		$get_results_query = mysqli_query($org_con2, $get_results);
		    		?>
		    			
		    		<?php
		    	}
		    	?>

		    	<table class="table mb-3">
		<thead class="thead-dark" style="background: black; color: white;">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Student Name</th>
				<th scope="col">Student ID</th>
				<th scope="col">Total Questions</th>
				<th scope="col">Correct Attempt</th>
				<th scope="col">Wrong or Unattempted</th>
				<th scope="col">Total Score</th>
				<th scope="col">Submission Time</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php
				while($result_row = mysqli_fetch_assoc($get_results_query)){
				?>
				<td><?php echo $result_row['serial_no']; ?></td>
				<td><?php echo $result_row['student_name']; ?></td>
				<td><?php echo $result_row['student_id']; ?></td>
				<td><?php echo $result_row['total_question']; ?></td>
				<td><?php echo $result_row['correct_answer']; ?></td>
				<td><?php echo $result_row['wrong_answer']; ?></td>
				<td><?php echo $result_row['score']; ?></td>
				<td><?php echo $result_row['submit_exam_time']; ?></td>
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

	<center class="mb-3">
		<a class="btn btn-danger" href="exam/publish_result.php?examid=<?php echo $exam_id; ?>">Publish Result</a>
		<a href="../myexams.php" class="btn btn-primary">Go Back</a>
	</center>

		    </body>
		</html>

		<?php
	}else{
		?>
		<script>
			alert("unable to fetch exam details due to server issue. plz try later...");
			location.replace("../myexams.php");
		</script>
		<?php
	}
}else{
	?>
	<script>
		location.replace("../myexams.php");
	</script>
	<?php
}
?>

