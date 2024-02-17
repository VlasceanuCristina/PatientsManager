<!DOCTYPE html>
<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php
	session_start();
	if(isset($_GET['admin'])){
			$id_admin =  $_GET['admin'];
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');			
			$query = "Select * from administratori where id='$id_admin'";
			$result = mysqli_query($db,$query);
			$row=mysqli_fetch_assoc($result);
			$prenume=$row['prenume'].'(admin)';
			$_SESSION['id_admin']=$id_admin;
			$_SESSION['prenume']=$prenume;
		}
		?>
	<script type="text/javascript">
		function openNav(){
			$(".sidebar").toggleClass('is-active');
		}
	</script>
	
	<script>
	function goBack() {
	  window.history.back()
	}
	function goForward() {
      window.history.forward();
	}
	</script>	
	<style>
	@media (min-width:848px) {
  html {
    overflow-x: auto; 
    overflow-y: auto;
  }
}
	</style>
</head>	

<body >
    <?php ;?>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1050px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;"> Medici</span></center>
		</div>
		<a href="acasa_admin.php?admin=<?php 
		if(isset($_POST['selectare'])) {
			echo $_SESSION['id_admin'];}
		else {
			echo $_GET['admin'];}
		?>" 
		class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
	
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="profil.jfif" title="<?php
		if(isset($_POST['selectare'])) echo$_SESSION['prenume'];
		else echo $prenume;?>"
		
		alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>		
			<!--<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>-->	
	
		<div class="container mb-3 mt-3">
			<table class="table table-striped table-bordered mydatatable" style="width:100%; ">
				<thead>
					<tr>
					  <th scope="col">Nr.crt.</th>
					  <th scope="col">Nume</th>
					  <th scope="col">Prenume</th>
					  <th scope="col">Cod parafa</th>
					  <th scope="col">Nr.contract CAS:</th>
					  <th scope="col">CAS:</th>
					  <th scope="col">Acțiuni</th>
					</tr>
				</thead>
				<tbody>
				<?php
				
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				$i=0;
					$query = "SELECT * FROM medici ";
				$results = mysqli_query($db, $query);
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){?>
						<tr>
							<td><?php $i=$i+1;echo $i;?></td>
							<td><?php echo $row['nume'];?></td>
							<td><?php echo $row['prenume'];?></td>
							<td><?php echo $row['cod_parafa'];?></td>
							<td><?php echo $row['nr_contract_cas'];?></td>
							<td><?php echo $row['denumire_cas'];?></td>
							<td>
							<?php
								$id_admin=$_GET['admin'];
								$files = array();
								$array1 = array($row['id'],$id_admin);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								echo '<a href ="editare_medic.php?' . $items . '" class="btn btn-info">Editare</a>';
								echo '<a href ="stergere_medic.php?' . $items . '" class="btn btn-danger">Stergere</a>';
							?>
							
							
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
					  <th scope="col">Cod parafa</th>
					  <th scope="col">Nr.contract CAS:</th>
					  <th scope="col">CAS:</th>
					  <th scope="col">Acțiuni</th>
					</tr>
				</tfoot>
			</table>
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
</div>
</html>