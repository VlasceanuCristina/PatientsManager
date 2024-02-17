<header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
		function openNav(){
			$(".sidebar").toggleClass('is-active');
		}
	</script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Meniu Medic</title>
	
	<script src="js/responsiveslides.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
		
		
}



	
.panel-heading {
  padding: 0;
	border:0;
}				
.panel-title>a, .panel-title>a:active{
	display:block;
	padding:15px;
  color:#555;
  font-size:16px;
  font-weight:bold;
	text-transform:uppercase;
	letter-spacing:1px;
  word-spacing:3px;
	text-decoration:none;
}
.panel-heading  a:before {
   font-family: 'Glyphicons Halflings';
   float: right;
   transition: all 0.5s;
}
.panel-heading.active a:before {
	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	transform: rotate(180deg);
} 
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
			<!--<a href="acasa.php"><i class="fa fa-fw fa-home"></i> Acasa</a>
			<a href="afisare_programari.php"><i class="fa fa-calendar"></i> Programari</a>
			<a href="afisare_pacienti.php"><i class="fa fa-fw fa-user"></i> Pacienti</a>
			<a href="profilul_meu.php"><i class="fa fa-user"></i> Profilul meu</a>
			<a href="login.php"><i class="fa fa-sign-out"></i> Iesire</a>-->
			
			<div class="wrapper center-block">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading active" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><a href="acasa.php" ><i class="fa fa-fw fa-home"></i> Acasa</a>
							</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><a href="afisare_programari.php"><i class="fa fa-calendar"></i> Programari</a>
							</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
						</div>
					</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-fw fa-user"></i> Pacienti
							</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<a href="afisare_pacienti.php"> Afisare Pacienti</a>
							<a href="adaugare_pacient.php"> Adaugare Pacient</a>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFour">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><a href="profilul_meu.php"><i class="fa fa-user"></i> Profilul meu</a>
							</a>
						</h4>
					</div>
					<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<div class="panel-body">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFive">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><a href="login.php"><i class="fa fa-sign-out"></i> Iesire</a>
							</a>
						</h4>
					</div>
					<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
						<div class="panel-body">
						</div>
					</div>
				</div>
			</div>			
		</nav>
	  </div>





<script>
$('.panel-collapse').on('show.bs.collapse', function () {
    $(this).siblings('.panel-heading').addClass('active');
  });

  $('.panel-collapse').on('hide.bs.collapse', function () {
    $(this).siblings('.panel-heading').removeClass('active');
  });
 </script>
	  <!--<div class="main-content">
		<div class="row">
		  <h1>Main content</h1>
		</div>
		<div class="row">
		  <div class="cell">
			 Cell #1
		  </div>
		  <div class="cell">
			 Cell #2
		  </div>
		  <div class="cell">
			 Cell #3
		  </div>
		</div>
	  </div>
	</div>-->
</body>