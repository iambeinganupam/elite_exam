<?php
session_start();

unset($_SESSION['add_ques']);

header("location:../addquestion.php");
?>