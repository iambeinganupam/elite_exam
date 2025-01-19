<?php
session_start();

if(!isset($_SESSION['exam_start'])){
	header("location:../dashboard.php");
}

include "../backend-functions/org_dbcon2.php";

$lwr_exm_name = strtolower($_SESSION['exm_name']);

$get_ques = "SELECT * FROM exam_$lwr_exm_name";
$get_ques_query = mysqli_query($org_con2, $get_ques);

/*while($que_row = mysqli_fetch_assoc($get_ques_query)){
	$_SESSION['answer'] = $que_row['correct_option_id'];
}*/

$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";
$count = 0;
$ans_id="";


$queno = $_GET['questionno'];

if(isset($_SESSION['answer'][$queno])){
	$ans_id = $_SESSION['answer'][$queno];
}

$res = "SELECT * FROM exam_$lwr_exm_name WHERE serial_no='$queno'";
$res_query = mysqli_query($org_con2, $res);
$count = mysqli_num_rows($res_query);

if($count == 0){
	echo "over";
}else{
	while($qrow = mysqli_fetch_array($res_query)){
		$question_no = $qrow['serial_no'];
		$question = $qrow['question'];
		$question_id = $qrow['question_id'];
		$opt1 = $qrow['optionA'];
		$opt2 = $qrow['optionB'];
		$opt3 = $qrow['optionC'];
		$opt4 = $qrow['optionD'];
		$opt1_id = $qrow['optionA_id'];
		$opt2_id = $qrow['optionB_id'];
		$opt3_id = $qrow['optionC_id'];
		$opt4_id = $qrow['optionD_id'];
		$correct_opt_id = $qrow['correct_option_id'];
	}
	?>
	<br>
	<table>
		<tr>
			<td style="font-weight: bold; font-size: 18px; padding-left: 5px;">
				<input type="hidden" name="q_id" value="<?php echo $question_id; ?>">
				<?php echo $question_no .". ". $question; ?>
			</td>
		</tr>
	</table>

	<table class="mt-3">
		<tr>
			<td style="padding-left: 15px; padding-top: 5px;">
				A. <input type="radio" name="r1" id="r1 o1" value="<?php echo $opt1_id; ?>" onclick="radioclick(this.value,<?php echo $question_no; ?>)"
				<?php
				if($ans_id == $opt1_id){
					echo "checked";
				}
				?>>
			</td>

			<td style="padding-left: 10px;">
				<?php echo $opt1; ?>
			</td>
		</tr>

		<tr>
			<td style="padding-left: 15px; padding-top: 5px;">
				B. <input type="radio" name="r1" id="r1 o2" value="<?php echo $opt2_id; ?>" onclick="radioclick(this.value,<?php echo $question_no; ?>)"
				<?php
				if($ans_id == $opt2_id){
					echo "checked";
				}
				?>>
			</td>

			<td style="padding-left: 10px;">
				<?php echo $opt2; ?>
			</td>
		</tr>

		<tr>
			<td style="padding-left: 15px; padding-top: 5px;">
				C. <input type="radio" name="r1" id="r1 o3" value="<?php echo $opt3_id; ?>" onclick="radioclick(this.value,<?php echo $question_no; ?>)"
				<?php
				if($ans_id == $opt3_id){
					echo "checked";
				}
				?>>
			</td>

			<td style="padding-left: 10px;">
				<?php echo $opt3; ?>
			</td>
		</tr>

		<tr>
			<td style="padding-left: 15px; padding-top: 5px;">
				D. <input type="radio" name="r1" id="r1 o4" value="<?php echo $opt4_id; ?>" onclick="radioclick(this.value,<?php echo $question_no; ?>)"
				<?php
				if($ans_id == $opt4_id){
					echo "checked";
				}
				?>>
			</td>

			<td style="padding-left: 10px;">
				<?php echo $opt4; ?>
			</td>
		</tr>
	</table>
	<?php
}



?>