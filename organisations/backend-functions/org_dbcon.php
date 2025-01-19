<?php

$org_servername = "localhost";
$org_username = "root";
$org_password = "";
$org_db = "db_".$username;

$org_con = mysqli_connect($org_servername, $org_username, $org_password, $org_db);

if(!$org_con){
	?>
	<script>
		alert("Could not connect to server at this moment. Please try later...");
	</script>
	<?php
}

$create_exam_table = "CREATE TABLE all_exams (serial_no BIGINT(20) PRIMARY KEY AUTO_INCREMENT NOT NULL, exam_name VARCHAR(50) NOT NULL, no_of_ques VARCHAR(10) NOT NULL, marks_per_ques VARCHAR(10) NOT NULL, full_marks VARCHAR(100) NOT NULL, duration VARCHAR(11) NOT NULL, exam_date VARCHAR(15) NOT NULL, exam_start_time VARCHAR(20) NOT NULL, exam_id VARCHAR(5000) NOT NULL, exam_status VARCHAR(30) NOT NULL, created_time DATETIME NOT NULL)";

$create_exam_table_query = mysqli_query($org_con, $create_exam_table);

//$create_student_table = "CREATE TABLE all_students (serial_no BIGINT(20) PRIMARY KEY AUTO_INCREMENT, student_name VARCHAR(100), student_id VARCHAR(100), student_password VARCHAR(5000), exam_name VARCHAR(100), exam_id VARCHAR(5000), created_time DATETIME)";

//$create_student_table_query = mysqli_query($org_con, $create_student_table);

if($create_exam_table_query){
	?>
	<script>
		location.replace("dashboard.php");
	</script>
	<?php
}
?>