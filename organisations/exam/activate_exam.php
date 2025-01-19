<?php
session_start();

include "../backend-functions/org_dbcon2.php";

if(isset($_GET['examid'])){
	$exam_id = $_GET['examid'];

	$activate_exam = "UPDATE all_exams SET exam_status = 'active' WHERE exam_id = '$exam_id'";
	$activate_exam_query = mysqli_query($org_con2, $activate_exam);

	if($activate_exam_query){
		?>
		<script>
			location.replace("../myexams.php");
		</script>
		<?php
	}else{
		?>
		<script>
			alert("unable to activate exam due to server issue. plz try later...");
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