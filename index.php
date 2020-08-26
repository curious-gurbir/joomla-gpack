<?php
	session_start();
	function redirect($url){
		ob_start();
		header('Location: '.$url);
		ob_end_flush();
		die();
	}
	if(isset($_GET["dir"])){
		$_SESSION["dir"] = $_GET["dir"];
		redirect('seticon.php');
	}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="3d-heart.png">	
	<script src="jquery-3.5.1.min.js"></script>
	<title>GPACK</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');
		body{
			background-color: #1c1c1c;
		}
		*:focus{
			outline:none;
		}
		.btn{
			padding: 15px 32px;
			background: transparent;
			border: 2px solid white;
			color: white;
			font-size: 30px;
			font-family: montserrat;
			border-radius: 10px;
			width: 100%;
			transition-duration: 0.4s;
			cursor: pointer;
			opacity: 0.6;
		}
		#table1{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
		}
		#htext{
			color: white;
			font-size: 25px;
			font-family: montserrat;
			white-space: nowrap;
			width: 400px;
		}
		.btn:hover{
			opacity: 1;
		}
		#footer{
			color: #505050;
			position: absolute;
			top: 95%;
			left: 50%;
			transform: translate(-50%,-50%);
			font-family: 'Montserrat', sans-serif;
			font-size: 12px;
			white-space: nowrap;
			overflow: hidden;
			cursor: pointer;			
		}
		#heart{
			color: red;
		}
	</style>
</head>
<body>
	<?php
		$dir = "../templates/";
		$temps = scandir($dir);
		$filter_temps = array();
		$exceps = array(".","..","system","index.html");
		for($i=0;$i<sizeof($temps);$i++){
			if(!in_array($temps[$i],$exceps))
				array_push($filter_temps,$temps[$i]);
		}
		echo "<table cellpadding=\"10\" id=\"table1\" cellspacing=\"10\">";
		echo "<tr><th><span id=\"htext\">Choose Template</span></th></tr>";
		for($i=0;$i<sizeof($filter_temps);$i++){
			echo("<tr><td align=\"center\"><button class=\"btn\">");
			echo($filter_temps[$i]);
			echo("</button></td></tr>");
		}
		echo "</table>";
	?>
	<div id="footer">Made with <span id="heart">❤</span> by Gurbir Dhaliwal</div>
	<script>
		$('.btn').click(function(){
			var dir_name = $(this).html();		
			window.location.href = 'index.php?dir='+encodeURI(dir_name);
		});
		$('#footer').click(function(){
			window.open('https://instagram.com/_gurbir_dhaliwal_', '_blank');
		});
	</script>
</body>
</html>