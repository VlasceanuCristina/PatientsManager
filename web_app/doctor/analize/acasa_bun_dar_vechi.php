<header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
		function openNav(){
			$(".sidebar").toggleClass('is-active');
		}
	</script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!--<link = "stylesheet" type= "text/css" href ="css/stil.css">-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title >Meniu Medic</title>
		<!--<div class = "card">
			<div class = "card-body" style = "background-color:#3498DB; color:#ffffff;font: italic bold 40px Georgia, serif">
				<center><h2>PatientsManager</h2><center>
			</div>
		</div>-->
		<script src="js/responsiveslides.min.js"></script>
</header>
<style>
.navbar-brand
		{
		  font-family: 'Lato', sans-serif;
		  color:white;
		  font-size: 30px;
		  margin: 0px;
		  background-color:#3498DB;
		}
.navbar{
			background-color:#3498DB;
		}		
body {
  margin: 0;
  overflow-x: hidden;
  font-family: "Lato", sans-serif; color:grey;
  background: url("acasa_fundal.jpg");
}
.sidebar {
  display: none;
  width: 220px;
  height: calc(100vh - 28px);
  background: #eee;
  border-right: #ccc;
  padding: 14px;
  position: relative;
  left: -220px;
}

.sidebar.is-active {
  display: block;
  left: 0;
  transition: all 2000ms ease;
}
.sidebar.is-active~.main-content {
  width: 100vw;
  height: calc(100vh - 28px);
  position: absolute;
  left: calc(220px + 28px);
}

.main-content {
  width: 100%;
  padding: 14px;
}

.row {
  display: flex;
  flex-wrap: no-wrap;
  flex-direction: row;
  justify-content: space;
}

.row .cell {
  width: 100%;
  background: #eee;
  padding: 14px;
}
.row .cell:nth-of-type(2) {
  border-right: 1px solid lightgray;
  border-left: 1px solid lightgray;
}

nav a {
  display: block;
  padding: 14px;
}

.menu-btn {
  position: absolute;
  right: 0;
  z-index: 9999;
}

.wrapper {
  width: 100%;
  height: 100vh;
  display: flex;
}
@media screen and (max-height: 450px) {
		.sidebar {padding-top: 15px;}
		.sidebar a {font-size: 18px;}
</style>
<body>
	<nav class="navbar">
			<span class="navbar-brand mb-0 h1">PatientsManager</span>
			<span style="font-size:30px;color:white;"></span>
			<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>
	</nav>
	<div class="wrapper">
	  <div class="sidebar">
		<nav>
			<a href="acasa.php"><i class="fa fa-fw fa-home"></i> Acasa</a>
			<a href="afisare_programari.php"><i class="fa fa-calendar"></i> Programari</a>
			<a href="afisare_pacienti.php"><i class="fa fa-fw fa-user"></i> Pacienti</a>
			<a href="profilul_meu.php?subject=<?php echo $_GET['medic']; ?>"><i class="fa fa-user"></i> Profilul meu</a>
			<a href="login.php"><i class="fa fa-sign-out"></i> Iesire</a>
		</nav>
	  </div>
	 <div class="card">
	 Bine ai venit!
	 </div>

</body>