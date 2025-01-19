<?php

$org_con_username = $_SESSION['org_username'];
$org_servername = "localhost";
$org_username = "root";
$org_password = "";
$org_db = "db_".$org_con_username;

$org_con2 = mysqli_connect($org_servername, $org_username, $org_password, $org_db);

if(!$org_con2){
	?>
	<script>
		alert("Could not connect to server at this moment. Please try later...");
	</script>
	<?php
}


?>