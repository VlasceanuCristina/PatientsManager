<!DOCTYPE html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link = "stylesheet" type= "text/css" href ="style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<title >Pacient Login</title>
		<script src="js/responsiveslides.min.js"></script>
	</head>
	
	<body style = "background-color:#ffffff;"> <!--style="background-image: url('1.jfif'); background-repeat: no-repeat;background-size: cover;"-->
		<div class = "" style = "background-color:#3498DB; color:#ffffff; font: italic bold 40px Georgia, serif">
			<center><h2>Autentificate/Inregistrare pacient</h2><center>
		</div>
		<form method="post" action="login.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Nume de utilizator</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Parola</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			Nu ai un cont? <a href="register.php">Inregistreaza-te</a>
		</p>
	  </form>
	</body>
</html>
</div>