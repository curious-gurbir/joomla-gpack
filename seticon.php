<?php
	session_start();
	function redirect($url){
		ob_start();
		header('Location: '.$url);
		ob_end_flush();
		die();
	}
	if(!isset($_SESSION["dir"])||$_SESSION["dir"]==""){
		redirect('index.php');
	}else{
		$temp = $_SESSION["dir"];
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
		#main{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			height: 125px;
		}
		#cf{
			color: white;
			font-family: montserrat;
			font-size: 20px;
			width: 300px;
			cursor: pointer;		
		}
		input::-webkit-file-upload-button{
			color: white;
			font-family: montserrat;
			background: transparent;
			border: none;
			border: 1.5px solid white;
			padding: 5px 10px;
			border-radius: 5px;
			font-size: 20px;
			cursor: pointer;
		}
		input::-webkit-file-upload-button:focus{
			outline: none;
		}
		#sub{
			color: white;
			font-family: montserrat;
			background: transparent;
			border: none;
			border: 1.5px solid white;
			padding: 5px 10px;
			border-radius: 5px;
			font-size: 20px;
			position: absolute;
			bottom: 0;
			left: 50%;
			transform: translate(-50%,0);
			cursor: pointer;
			opacity: 0.6;
			transition-duration: 0.3s;		
		}
		#sub:hover{
			opacity: 1;
			border: 1.5px solid #0f0;
			color: #0f0;
		}
		#sub:focus{
			opacity: 1;
			border: 1.5px solid #0f0;
			color: #0f0;
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
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
		<div id="main">
			<input type="file" name="userFile" required id="cf" accept=".jpg,.jpeg,.png">
			<input type="submit" value="Replace" id="sub">
		</div>
	</form>
	<div id="footer">Made with <span id="heart">❤</span> by Gurbir Dhaliwal</div>	
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$temp = $_SESSION["dir"];
			$temp_dir = "../templates/".$temp."/";
			$temp_array = scandir($temp_dir);
			if(in_array("favicon.ico",$temp_array)){
				if(!unlink($temp_dir."favicon.ico")){
					echo "<script>alert('Error in deleting favicon.ico file!');</script>";
				}else{
					$info = pathinfo($_FILES['userFile']['name']);
					$newname = "favicon.ico"; 

					$target = '../templates/'.$temp.'/'.$newname;
					move_uploaded_file( $_FILES['userFile']['tmp_name'], $target);
					echo "<script>alert('Icon successfully changed!');</script>";
				}
			}else{
				$info = pathinfo($_FILES['userFile']['name']);
				$newname = "favicon.ico"; 

				$target = '../templates/'.$temp.'/'.$newname;
				move_uploaded_file( $_FILES['userFile']['tmp_name'], $target);
				echo "<script>alert('Icon successfully changed!');window.location.replace('index.php');</script>";
			}
		}
	?>
	<script>
		alert('- Backup previously used icon as it will be deleted after replacing with new one\n\n- Only choose jpg/jpeg/png files');		
		$('#footer').click(function(){
			window.open('https://instagram.com/_gurbir_dhaliwal_', '_blank');
		});
	</script>
</body>
</html>
