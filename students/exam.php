<?php
session_start();
if(!isset($_SESSION['org_user_name'])){
	header("location:index.php");
}

if(!isset($_SESSION['exam_start'])){
	header("location:dashboard.php");
}

$pagename = "My Exams";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard | Exam Portal</title>
	<!--====================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--=====================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<!--jQuery Js-->
	<script src="js/jquery.js"></script>

	<!--Bootstrap Js-->
	<script src="js/bootstrap.min.js"></script>

	<!--<script src="js/fun.js"></script>-->

	<style>
		.ques-display{
			height: 100px;
			overflow: scroll;
		}

		#timer{
			position: absolute;
			right: 30px;
			margin-top: 5px;
			padding: 5px;
			width: fit-content;
			color: darkred;
			font-weight: bold;
			font-family: sans-serif;
			font-size: 20px;
		}
	</style>
</head>
<body>
	<?php include "requirements/navbar.php"; ?>
	<div id="timer"><?php echo $_SESSION['durat_ion']; ?></div>
	<div class="mt-3 ml-5">
		<div id="current_que" style="float: left;">0</div>
		<div style="float: left;">/</div>
		<div id="total_que" style="float: left;">0</div>
	</div>

	<div class="ques-display ml-5 mt-5" style="min-height: 300px; background-color: white;" id="load_questions">
	</div>

	<!--Footer starts-->
	<div class="fixed-bottom p-3 pl-5" style="display: flex; flex-direction: horizontal; background: rgb(228, 228, 228); width: 100%;">
		<input type="button" class="btn btn-danger" value="Previous" onclick="load_previous();">
		<input type="button" class="btn btn-primary" value="Save & Next" onclick="load_next();" style="margin-left: 15px;">

		<button class="btn btn-primary" onclick="clearResponse();" style="margin-left: 15px;">Clear Response</button>

		<div class="text-right">
		    <a href="submit-exam.php" style="position: absolute; right: 80px;" class="btn btn-success">Submit</a>	
		</div>
		
    </div>
	
	<!--==============================================================-->
	<script type="text/javascript">
		function load_total_que(){
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById("total_que").innerHTML=xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "forajax/load_total_que.php", true);
			xmlhttp.send(null);
		}

		var questionno = "1";
		load_questions(questionno);

		function load_questions(questionno){

			document.getElementById("current_que").innerHTML=questionno;

			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){

					if(xmlhttp.responseText=="over"){
						//window.location="result.php";
						alert("You have completed all questions. Please click on submit button to submit your exam.");
					}else{
						document.getElementById("load_questions").innerHTML=xmlhttp.responseText;
						load_total_que();
					}

				}
			};
			xmlhttp.open("GET", "forajax/load_questions.php?questionno="+ questionno, true);
			xmlhttp.send(null);
		}

		function radioclick(radiovalue, questionno){
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
					
				}
			};
			xmlhttp.open("GET", "forajax/save_markedopt_in_session.php?questionno="+ questionno +"&value1="+radiovalue, true);
			xmlhttp.send(null);
		}

		function load_previous(){
			if(questionno=="1"){
				load_questions(questionno);
			}else{
				questionno=eval(questionno)-1;
				load_questions(questionno);
			}
		}

		function load_next(){
			questionno=eval(questionno)+1;
			load_questions(questionno);
		}

		//clr response
		function clearResponse() {
			let radioButton1 = document.getElementsById("o1");
			let radioButton2 = document.getElementsById("o2");
			let radioButton3 = document.getElementsById("o3");
			let radioButton4 = document.getElementsById("o4");

			if(radioButton1.checked){
				radioButton1.checked = false;
			}

			if(radioButton2.checked){
				radioButton2.checked = false;
			}

			if(radioButton3.checked){
				radioButton3.checked = false;
			}

			if(radioButton4.checked){
				radioButton4.checked = false;
			}
		}

		//countdown
		function CountDownTimer(duration, display){
			let timer = duration, minutes, seconds;
			setInterval(function () {
				minutes = parseInt(timer / 60, 10);
				seconds = parseInt(timer % 60, 10);

				minutes = minutes < 10 ? "0" + minutes : minutes;
				seconds = seconds < 10 ? "0" + seconds : seconds;

				display.textContent = minutes + ":" +seconds;

				if(--timer < 0){
					timer = duration;
				}
			}, 1000);
		}

		window.onload = function(){
			let duration = 60 * <?php echo $_SESSION['durat_ion']; ?>;
			let display = document.querySelector('#timer');
			CountDownTimer(duration, display);
		}
	</script>
	<!--======================================================================-->
	
</body>
</html>