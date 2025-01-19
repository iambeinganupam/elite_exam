<?php
session_start();

include "../backend-functions/org_dbcon2.php";

if(isset($_GET['examid'])){
	$exam_id = $_GET['examid'];

	$get_exam_details = "SELECT * FROM all_exams WHERE exam_id = '$exam_id'";
	$get_exam_details_query = mysqli_query($org_con2, $get_exam_details);

	while($get_exam_details_row = mysqli_fetch_assoc($get_exam_details_query)){
		$dlt_exm_name = strtolower($get_exam_details_row['exam_name']);
	}

	$delete_exam = "DELETE FROM all_exams WHERE exam_id = $exam_id";
	$delete_exam_query = mysqli_query($org_con2, $delete_exam);

	$delete_exam_tbl = "DROP TABLE exam_$dlt_exm_name";
	$delete_exam_tbl_query = mysqli_query($org_con2, $delete_exam_tbl);

	$delete_student_tbl = "DROP TABLE students_$dlt_exm_name";
	$delete_student_tbl_query = mysqli_query($org_con2, $delete_student_tbl);

	$delete_result_tbl = "DROP TABLE result_$dlt_exm_name";
	$delete_result_tbl_query = mysqli_query($org_con2, $delete_result_tbl);

	if($delete_exam_query and $delete_exam_tbl_query and $delete_student_tbl_query and $delete_result_tbl_query){
		?>
		<script>
			location.replace("../myexams.php");
		</script>
		<?php
	}else{
		?>
		<script>
			alert("unable to delete exam due to server issue. plz try later...");
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