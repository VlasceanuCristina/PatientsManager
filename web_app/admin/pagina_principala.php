<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!--<link = "stylesheet" type= "text/css" href ="css/stil.css">-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title >Meniu Medic</title>
		<div class = "card">
			<div class = "card-body" style = "background-color:#3498DB; color:#ffffff;font: italic bold 40px Georgia, serif">
				<center><h2>PatientsManager</h2><center>
			</div>
		</div>
		<script src="js/responsiveslides.min.js"></script>
	</head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body {font-family: "Lato", sans-serif; color:green;}

		.sidebar {
		  height: 100%;
		  width: 160px;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  left: 0;
		  background-color: #111;
		  overflow-x: hidden;
		  padding-top: 16px;
		}

		.sidebar a {
		  padding: 6px 8px 6px 16px;
		  text-decoration: none;
		  font-size: 20px;
		  color: #818181;
		  display: block;
		}

		.sidebar a:hover {
		  color: #f1f1f1;
		}

		.main {
		  margin-left: 160px; /* Same as the width of the sidenav */
		  padding: 0px 10px;
		}

		@media screen and (max-height: 450px) {
		  .sidebar {padding-top: 15px;}
		  .sidebar a {font-size: 18px;}
		}
	</style>
	<body>
		<div class="sidebar">
			<a href="pagina_principala.php"><i class="fa fa-fw fa-home"></i> Home</a>
			<a href="afisare_programari.php"><i class="fa fa-calendar"></i> Programari</a>
			<a href="afisare_pacienti.php"><i class="fa fa-fw fa-user"></i> Pacienti</a>
			<a href="profilul_meu.php"><i class="fa fa-user"></i> Profilul meu</a>
			<a href="login.php"><i class="fa fa-sign-out"></i> Iesire</a>
			
		</div>
	</body>