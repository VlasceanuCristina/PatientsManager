<!DOCTYPE html>
<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!--<link = "stylesheet" type= "text/css" href ="css/stil.css">-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<title >Login</title>
		<!--<div class = "card">
			
			<center><img src="doctor/brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
				<h2>PatientsManager</h2><center>
			</div>
		</div>-->
		<div class="card">
		<div class = "card-body" style = "background-color:#3498DB; ">
		<center><a class="navbar-brand" href="#" style="color:#ffffff;font: italic bold 30px Georgia, serif">
				<img src="doctor/brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
				<span class="menu-collapsed">PatientsManager</span>
		</a></center>
		</div>
		</div>
		<script src="js/responsiveslides.min.js"></script>
	</head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type ="text/css">
	#slider{
		overflow: hidden;
	}
	#slider figure{
		position:relative;
		width:500%;
		margin:0;
		left:0;
		animation: 20s slider infinite;
	}
	#slider figure img{
		width:20%;
		float:left;
	}
	@keyframes slider{
		0%{
			left:0;
		}
		20%{
			left:0;
		}
		25%{
			left:-100%;
		}
		45%{
			left:-100%;
		}
		50%{
			left:-200%;
		}
		70%{
			left:-200%;
		}
		75%{
			left:-300%;
		}
		95%{
			left:-300%;
		}
		100%{
			left:-400%;
		}
	}
	@media only screen and (max-width: 640px) {
	
	.figure{
		width:95%;
	}
	</style>
	<body <!--style ="background:url('imagini/2.jpg'); no-repeat; background-size:cover;-->">
		<div id = "slider">
			<figure>
				<img src = "imagini/slider1.jpg" style="height:450px"/>
				<img src = "imagini/doctor4.jpg" style="height:450px"/>
				<img src = "imagini/slider1.jpg" style="height:450px"/>
				<img src = "imagini/doctor4.jpg" style="height:450px"/>
				<img src = "imagini/slider1.jpg" style="height:450px"/>
			</figure>
		</div>
		<div class="container-fluid" style = "background-color:#0275d8;">
			<div class="row" style = "padding:20px;margin-left:130px;">
				<div class="col-4">
					<div class="card" style="width: 15rem; height:15rem;border-radius:20px; border-color:#000000;">
						<img class="card-img-top" src="imagini/patient_login.png" alt="Pacient" style="width:40%;">
						<div class="card-body">
							<h5 class="card-title">Autentificare pacient</h5>
							<a href="pacient/login.php" class="btn btn-primary">Apasă aici</a>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card" style="width: 15rem; height:15rem;border-radius:20px; border-color:#000000;">
						<img class="card-img-top" src="imagini/medic_icon.jfif" alt="Doctor" style="width:40%;">
						<div class="card-body">
							<h5 class="card-title">Autentificare medic</h5>
							<a href="doctor/login.php" class="btn btn-primary">Apasă aici</a>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card" style="width: 15rem; height:15rem;border-radius:20px; border-color:#000000;">
						<img class ="card-img-top" src="imagini/admin_icon.png" alt="Admin" style="width:30%;">
						<div class="card-body">
							<h5 class="card-title">Autentificare administrator</h5>
							<a href="admin/login.php" class="btn btn-primary">Apasă aici</a>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
</div>	
</html>