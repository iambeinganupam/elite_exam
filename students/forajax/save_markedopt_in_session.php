<?php
session_start();
if(!isset($_SESSION['exam_start'])){
	header("location:../dashboard.php");
}
$questionno = $_GET['questionno'];
$value1 = $_GET['value1'];
$_SESSION['answer'][$questionno]=$value1;

?>