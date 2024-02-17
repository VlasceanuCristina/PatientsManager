<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<script type="text/javascript">
		function openNav(){
			$(".sidebar").toggleClass('is-active');
		}
	</script>
</head>
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


nav a {
  display: block;
  padding: 14px;
}

.menu-btn {
  position: absolute;
  right: 0;
  z-index: 9999;
}


@media screen and (max-height: 450px) {
		.sidebar {padding-top: 15px;}
		.sidebar a {font-size: 18px;}
}
.wrapper {
  width: 100%;
  height: 100;
  display: flex;
}

</style>
<body>
	<nav class="navbar">
			<span class="navbar-brand mb-0 h1">Pacienti</span>
			<!--<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>-->
			
	</nav>
	<div class="wraper">
		 <div class="sidebar">
			<nav>
				<a href="acasa.php"><i class="fa fa-fw fa-home"></i> Acasa</a>
				<a href="afisare_programari.php"><i class="fa fa-calendar"></i> Programari</a>
				<a href="afisare_pacienti.php"><i class="fa fa-fw fa-user"></i> Pacienti</a>
				<a href="profilul_meu.php"><i class="fa fa-user"></i> Profilul meu</a>
				<a href="login.php"><i class="fa fa-sign-out"></i> Iesire</a>
			</nav>
		 </div>
	
		<div class="container mb-3 mt-3">
			<table class="table table-striped table-bordered mydatatable" style="width:100%">
				<thead>
					<tr>
					  <th scope="col">Nr.crt.</th>
					  <th scope="col">Nume</th>
					  <th scope="col">Prenume</th>
					  <th scope="col">CNP</th>
					  <th>Actiuni</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$username = "";
				$email    = "";
				$errors = array(); 
				$_SESSION['success'] = "";

				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				$query = "SELECT id, nume, prenume, cnp FROM pacienti";
				$results = mysqli_query($db, $query);
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){?>
						<tr>
							<td><?php echo $row['id'];?></td>
							<td><?php echo $row['nume'];?></td>
							<td><?php echo $row['prenume'];?></td>
							<td><?php echo $row['cnp'];?></td>
							<td>
							<a href ="detalii_pacient.php?subject=<?php echo $row['id'];?> " class="btn btn-success">Detalii</a>
							<a href ="editare_pacient.php?subject=<?php echo $row['id'];?> " class="btn btn-info">Editare</a>
							<a href ="stergere_pacient.php?subject=<?php echo $row['id'];?> " class="btn btn-danger">Stergere</a>
							</td>
						</tr>
				<?php	} 
				}	
				?>
				
				</tbody>
				<tfoot>
					<tr>
					  <th scope="col">Nr.crt.</th>
					  <th scope="col">Nume</th>
					  <th scope="col">Prenume</th>
					  <th scope="col">CNP</th>
					  <th scope="col">Actiuni</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$('.mydatatable').DataTable();
	</script>
	
	
</body>
</html>