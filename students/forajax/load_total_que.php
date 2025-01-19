<?php
session_start();
if(!isset($_SESSION['exam_start'])){
	header("location:../dashboard.php");
}
include "../backend-functions/org_dbcon2.php";

$total_que = 0;

$lwr_exm_name = strtolower($_SESSION['exm_name']);

$res1 = "SELECT * FROM exam_$lwr_exm_name";
$res1_query = mysqli_query($org_con2, $res1);

$total_que = mysqli_num_rows($res1_query);
echo $total_que;
?>