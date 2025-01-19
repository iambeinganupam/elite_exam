<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "examportal_db";

$con = mysqli_connect($servername, $username, $password, $db);

if(!$con){
	?>
	<script>
		alert("Could not connect to server at this moment. Please try later...");
	</script>
	<?php
}

?>