<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
		<script>
		function goBack() {
		  window.history.back()
		}
		function goForward() {
		  window.history.forward();
		}
		</script>
	</head>
	<body style="background-image:url('doctori.jpg'); background-repeat:no-repeat; object-fit: cover;">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<nav class="navbar navbar-expand-md navbar-dark bg-primary">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="#">
				<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
				<span class="menu-collapsed">PatientManager</span>
				<?php 
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				$id_pacient = $_GET['pacient'];
				$query = "SELECT * FROM pacienti WHERE id = $id_pacient ";
				$results = mysqli_query($db, $query);
				$row= mysqli_fetch_array($results);
				$nume= $row['nume'];
				$prenume = $row['prenume'];
				$id_medic=$row['id_medic'];
				$nume_poza=$row['nume_poza'];
				$files = array();
				$array1 = array($id_pacient,$id_medic);
				foreach ($array1 as $item){
				  $files[] ='files[]=' . $item;
				}
				$items = implode('&', $files);
				?>
				<button class="btn btn-info" style="background-color:white;color:blue;margin-left:1150px;" onclick="goBack()">Înapoi</button>
				<button class="btn btn-info"  style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
				<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;margin-left:-10px;" >Deconectare</a>
				<img src="<?php echo $nume_poza;?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;">
			</a>
			
			
			
			
			
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav ml-auto">
					<!--<li class="nav-item active">
						<a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#top">Features</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#top">Pricing</a>
					</li>-->
					<!-- This menu is hidden in bigger devices with d-sm-none. 
				   The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
					<!--<li class="nav-item dropdown d-sm-block d-md-none">
						<a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
						<div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
							<a class="dropdown-item" href="#top">hjsahgjsa</a>
							<a class="dropdown-item" href="#top">Profile</a>
							<a class="dropdown-item" href="#top">Tasks</a>
							<a class="dropdown-item" href="#top">Etc ...</a>
						</div>
					</li><!-- Smaller devices menu END -->
				</ul>
			</div>
		</nav><!-- NavBar END -->
		<!-- Bootstrap row -->
		<div class="row" id="body-row">
			<!-- Sidebar -->
			<div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
				<!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
				<!-- Bootstrap List Group -->
				<ul class="list-group">
					<!-- Separator with title -->
					<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
						<small>MAIN MENU</small>
					</li>
					<!-- /END Separator -->
					<!-- Menu with submenu -->
					<a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-start align-items-center">
							<span class="fa fa-dashboard fa-fw mr-3"></span>
							<span class="menu-collapsed" style="font-size:20px;">Istoric Medical</span>
							<!--<span class="submenu-icon ml-auto"></span>-->
						</div>
					</a>
					<!-- Submenu content -->
					<div id='submenu1' class="collapse sidebar-submenu">
						<a href="pacient_boli.php?<?php echo $items ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Istoric boli</span>
						</a>
						<a href="pacient_parametri.php?<?php echo $items ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Istoric Parametri </span>
						</a>
						<a href="pacient_vaccinuri.php?<?php echo $items ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Vaccinuri </span>
						</a>
						<a href="analize.php?<?php echo $items ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Analize </span>
						</a>
						<a href="pacient_internari.php?<?php echo $items ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Istoric Internari</span>
						</a>
						<a href="interventii_chirurgicale.php?<?php echo $items ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Interventii Chirurgicale</span>
						</a>

					</div>
					<a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-start align-items-center">
							<span class="fa fa-user fa-fw mr-3"></span>
							<span class="menu-collapsed" style="font-size:20px;">Profil</span>
							<!--<span class="submenu-icon ml-auto"></span>-->
						</div>
					</a>
					<!-- Submenu content -->
					<div id='submenu2' class="collapse sidebar-submenu">
						<a href="profilul_meu_pacient.php?pacient=<?php echo $id_pacient; ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Profilul meu</span>
						</a>
						<a href="setari_parola.php?pacient=<?php echo $id_pacient; ?>" class="list-group-item list-group-item-action bg-dark text-white">
							<span class="menu-collapsed"  style="font-size:16px;">Setari parola</span>
						</a>
					</div>

					<!-- Separator with title -->
					<!--<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
						<small>OPTIONS</small>
					</li>-->
					<!-- /END Separator -->
					<a href="afisare_programari.php?pacient=<?php echo $id_pacient; ?>" class="bg-dark list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-start align-items-center">
							<span class="fa fa-calendar fa-fw mr-3"></span>
							<span class="menu-collapsed" style="font-size:20px;">Programari</span>
						</div>
					</a>
					<!--<a href="#" class="bg-dark list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-start align-items-center">
							<span class="fa fa-envelope-o fa-fw mr-3"></span>
							<span class="menu-collapsed">Messages <span class="badge badge-pill badge-primary ml-2">5</span></span>
						</div>
					</a>-->
					<!-- Separator without title -->
					<li class="list-group-item sidebar-separator menu-collapsed"></li>
					<!-- /END Separator -->
					<!--<a href="#" class="bg-dark list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-start align-items-center">
							<span class="fa fa-question fa-fw mr-3"></span>
							<span class="menu-collapsed">Help</span>
						</div>
					</a>
					<a href="#top" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
						<div class="d-flex w-100 justify-content-start align-items-center">
							<span id="collapse-icon" class="fa fa-2x mr-3"></span>
							<span id="collapse-text" class="menu-collapsed">Collapse</span>
						</div>
					</a>-->
				</ul><!-- List Group END-->
			</div><!-- sidebar-container END -->
			<!-- MAIN -->
			<div class="col p-4" style="color:#800000;">
				<center><h1 style="font-weight:bold;font-size:40px;" class="display-4">Bine ai venit <?php 
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				$id_pacient = $_GET['pacient'];
				$query = "SELECT * FROM  pacienti  WHERE id = $id_pacient ";
				$results = mysqli_query($db, $query);
				
				if (mysqli_num_rows($results) == 1) {
					$row= mysqli_fetch_array($results);
					$nume= $row['nume'];
					$prenume = $row['prenume'];
					echo $prenume.' '.$nume;
				}
				
				
				?>!
				</h1><center>
				<!--<div class="card">
					<h5 class="card-header font-weight-light">Requirements</h5>
					<div class="card-body">
						<ul>
							<li>JQuery</li>
							<li>Bootstrap 4.3</li>
							<li>FontAwesome</li>
						</ul>
					</div>
				</div>-->
			</div><!-- Main Col END -->
		</div><!-- body-row END -->

		<script>
		// Hide submenus
		$('#body-row .collapse').collapse('hide'); 

		// Collapse/Expand icon
		$('#collapse-icon').addClass('fa-angle-double-left'); 

		// Collapse click
		$('[data-toggle=sidebar-colapse]').click(function() {
			SidebarCollapse();
		});

		function SidebarCollapse () {
			$('.menu-collapsed').toggleClass('d-none');
			$('.sidebar-submenu').toggleClass('d-none');
			$('.submenu-icon').toggleClass('d-none');
			$('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
			
			// Treating d-flex/d-none on separators with title
			var SeparatorTitle = $('.sidebar-separator-title');
			if ( SeparatorTitle.hasClass('d-flex') ) {
				SeparatorTitle.removeClass('d-flex');
			} else {
				SeparatorTitle.addClass('d-flex');
			}
			
			// Collapse/Expand icon
			$('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
		}
		</script>
	</body>
	<style>
	#body-row {
		margin-left:0;
		margin-right:0;
	}
	#sidebar-container {
		min-height: 100vh;   
		background-color: #333;
		padding: 0;
	}

	/* Sidebar sizes when expanded and expanded */
	.sidebar-expanded {
		width: 230px;
	}
	.sidebar-collapsed {
		width: 60px;
	}

	/* Menu item*/
	#sidebar-container .list-group a {
		height: 50px;
		color: white;
	}

	/* Submenu item*/
	#sidebar-container .list-group .sidebar-submenu a {
		height: 45px;
		padding-left: 30px;
	}
	.sidebar-submenu {
		font-size: 0.9rem;
	}

	/* Separators */
	.sidebar-separator-title {
		background-color: #333;
		height: 35px;
	}
	.sidebar-separator {
		background-color: #333;
		height: 25px;
	}
	.logo-separator {
		background-color: #333;    
		height: 60px;
	}

	/* Closed submenu icon */
	#sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
	  content: " \f0d7";
	  font-family: FontAwesome;
	  display: inline;
	  text-align: right;
	  padding-left: 10px;
	}
	/* Opened submenu icon */
	#sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
	  content: " \f0da";
	  font-family: FontAwesome;
	  display: inline;
	  text-align: right;
	  padding-left: 10px;
	}
	</style>
</html>
</div>