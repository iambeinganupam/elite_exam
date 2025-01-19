<?php

$server_name = "localhost";
$user_name = "root";
$pass_word = "";

$conn = mysqli_connect($server_name, $user_name, $pass_word);

if(!$conn){
	?>
	<script>
		alert("Could not connect to server at this moment. Please try later...");
	</script>
	<?php
}

$create_org_db = "CREATE DATABASE db_$username";
$create_db_query = mysqli_query($conn, $create_org_db);

if($create_db_query){
	include "backend-functions/org_dbcon.php";
}else{
	?>
	<script>
		alert("This account has been freezed due to some issue. You will not be able to conduct exams using this account. Please contact us or create new account with another username...");
	</script>
	<?php
}

?>