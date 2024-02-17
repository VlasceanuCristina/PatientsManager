<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<title>Înregistrare medic</title>
	<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script>
	function goBack() {
	  window.history.back()
	}
	function goForward() {
      window.history.forward();
	}
	</script>
	
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1200px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;"></span></center>
		</div>
		<button class="btn btn-info" style="background-color:white;color:blue;margin-right:5px;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
	</nav>
	<style>
	.error {
	width: 92%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid #a94442; 
	color: #a94442; 
	background: #f2dede; 
	border-radius: 5px; 
	text-align: left;
}
.success {
	color: #3c763d; 
	background: #dff0d8; 
	border: 1px solid #3c763d;
	margin-bottom: 20px;
}
	</style>
</head>
<body style ="background:url('fundal.jpg'); no-repeat; background-size:cover;">
	<div class="header" style = "width: 30%;margin: 50px auto 0px;color: white;background: #3498DB;text-align: center;border: 1px solid #B0C4DE;border-bottom: none;border-radius: 10px 10px 0px 0px;padding: 20px;">
		<h2>Înregistrare medic</h2>
	</div>
	
	<form method="post" action="register.php" style="width: 30%;margin: 0px auto;padding: 20px;border: 1px solid #B0C4DE;background: white;border-radius: 0px 0px 10px 10px;opacity:0.9;">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label style="display: block;text-align: left;margin: 3px;">Nume utilizator</label>
			<input style="height: 40px;width: 93%;padding: 5px 10pxfont-size: 16px;border-radius: 5px;border: 1px solid gray;" type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label style="display: block;text-align: left;margin: 3px;">Email</label>
			<input  style="height: 40px;width: 93%;padding: 5px 10pxfont-size: 16px;border-radius: 5px;border: 1px solid gray;" type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label style="display: block;text-align: left;margin: 3px;">Parola</label>
			<input style="height: 40px;width: 93%;padding: 5px 10pxfont-size: 16px;border-radius: 5px;border: 1px solid gray;" type="password" name="password_1">
		</div>
		<div class="input-group">
			<label style="display: block;text-align: left;margin: 3px;">Confirmare parola</label>
			<input style="height: 40px;width: 93%;padding: 5px 10pxfont-size: 16px;border-radius: 5px;border: 1px solid gray;" type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user" style = "padding: 10px;font-size: 15px;color: white;background: #3498DB;border: none;border-radius: 5px;margin-top:10px;">Înregistrare</button>
		</div>
		<p>
			Aveti deja un cont? <a href="login.php">Autentificare</a>
		</p>
	</form>
</body>
</div>
</html>