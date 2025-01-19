<?php
session_start();
if(!isset($_SESSION['student_id'])){
	header("location:index.php");
}

unset($_SESSION['exam_start']);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Result</title>
</head>
<body>
	<?php
	$correct = 0;
	$wrong = 0;
	$lwr_exm_name = strtolower($_SESSION['exm_name']);
	$mrksperques = $_SESSION['marksper_ques'];
	$std_id = $_SESSION['student_id'];
	$std_name = $_SESSION['student_name'];

	include "backend-functions/org_dbcon2.php";
	if(isset($_SESSION['answer'])){
		for($i=1;$i<=sizeof($_SESSION['answer']);$i++){
			$answer="";
			$res2 = "SELECT * FROM exam_$lwr_exm_name WHERE serial_no='$i'";
			$res2_query = mysqli_query($org_con2, $res2);
			while($res_row = mysqli_fetch_assoc($res2_query)){
				$correct_answer = $res_row['correct_option_id'];
			}

			if(isset($_SESSION['answer'][$i])){
				if($correct_answer == $_SESSION['answer'][$i]){
					$correct = $correct + 1;
				}else{
					$wrong = $wrong + 1;
				}
			}else{
				$wrong = $wrong + 1;
			}
		}
	}

	$count = 0;
	$ques_count = "SELECT * FROM exam_$lwr_exm_name";
	$ques_count_query = mysqli_query($org_con2, $ques_count);

	$countques = mysqli_num_rows($ques_count_query);
	$wrongans = $countques - $correct;

	$score = $mrksperques*$correct;
	/*echo "<br><br>";

	echo "<center>";
	echo "TOTAL QUESTIONS : ".$countques."<br>";
	echo "CORRECT ANSWER : ".$correct."<br>";
	echo "WRONG ANSWER : ".$wrong."<br>";

	echo "</center>";*/
	$submit_result = "INSERT INTO result_$lwr_exm_name (serial_no, student_id, student_name, total_question, correct_answer, wrong_answer, score, submit_exam_time) VALUES (NULL, '$std_id', '$std_name', '$countques', '$correct', '$wrongans', '$score', current_timestamp())";

	$submit_result_query = mysqli_query($org_con2, $submit_result);

	if($submit_result_query){
		$_SESSION['submit_success'] = "set";
		?>
		<script>
			location.replace("success.php");
		</script>
		<?php
	}else{
		$_SESSION['submit_unsuccess'] = "set";
		$_SESSION['session_id'] = bin2hex(random_bytes(8));
		?>
		<script>
			location.replace("error.php");
		</script>
		<?php
	}
	?>
</body>
</html>