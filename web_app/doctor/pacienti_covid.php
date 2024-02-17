<!DOCTYPE html>
<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
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
	
<?php
	session_start();
		if(isset($_GET['medic'])){
			$id_medic =  $_GET['medic'];
			$_SESSION['id_medic']=$id_medic;
			
		}else
	{
		
		$id_medic=$_SESSION['id_medic'];
	}
			
			
			
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			
			$query = "SELECT * FROM medici WHERE id = $id_medic ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$prenume = $row['prenume'];
			$nume_poza=$row['nume_poza'];
			
		
	?>	
	
</head>	

<body >
  
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1050px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;"> Evidență pacienți COVID-19</span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<?php 
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	
			$query = "SELECT * FROM medici WHERE id = $id_medic ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$nume= $row['nume'];
			$prenume = $row['prenume'];
			?>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $row['nume_poza'];?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>		
			<!--<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>-->	
	
	<div class="card" style="background-color:#000;height:60px;">
	<span >
	   <a class="btn btn-info bg-primary" style="margin-left:1410px;margin-top:10px;" href="adaugare_pacient_covid.php?medic=<?php echo $id_medic?>" class="btn btn-success">Adaugare pacient</a></span>
	</div>
	
	
		<div class="container mb-3 mt-3">
			<table class="table table-striped table-bordered mydatatable" style="width:100%; ">
				<thead>
					<tr>
					  <th scope="col">Nr.crt.</th>
					  <th scope="col">Nume</th>
					  <th scope="col">Prenume</th>
					  <th scope="col">Stadiu</th>
					  <th scope="col">Data infectare</th>
					  <th >Actiuni</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	
				if(isset($_POST['update'])){
					$nume = $_POST['nume'];
					$prenume = $_POST['prenume'];
					$id_rec = $_POST['id'];
					$data = $_POST['data'];
					$stadiu=$_POST['stadiu'];
		
				
				$query_update = "UPDATE pacienti_covid SET data_infectare='$data', stadiu='$stadiu' WHERE id= $id_rec";
				$results_update = mysqli_query($db, $query_update);
				$query = "SELECT PC.id, P.nume, P.prenume,stadiu,data_infectare FROM pacienti P, pacienti_covid PC WHERE PC.id_pacient=P.id ";
				$results = mysqli_query($db, $query);
				$i=0;
				
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){?>
						<tr>
							<td><?php $i=$i+1; echo $i;?></td>
							<td><?php echo $row['nume'];?></td>
							<td><?php echo $row['prenume'];?></td>
							<td><?php echo $row['stadiu'];?></td>
							<td><?php echo $row['data_infectare'];?></td>
							<td>
							    <?php 
								$files_edit = array();
								$array_edit = array($row['id'],$id_medic);
								foreach ($array_edit as $item){
								  $files_edit[] ='files[]=' . $item;
								}
								$items_edit = implode('&', $files_edit);
								
								echo '<a href="edit_action_pacienti_covid.php?' . $items_edit . '"
								class = "btn btn-success">Editare</a>';
											
								//delete
								$files = array();
								$array1 = array($row['id'],$id_medic);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								echo '<a href="delete_action_pacienti_covid.php?' . $items . '" class="btn btn-danger">Ștergere</a>';
								
								?>
							</td>
						</tr>
					<?php
					}
				}
				}
				
				else{
				$query_total = "SELECT PC.id, P.nume, P.prenume,stadiu,data_infectare FROM pacienti P, pacienti_covid PC WHERE PC.id_pacient=P.id";
				
				$results = mysqli_query($db, $query_total);
				if(mysqli_num_rows($results)>0){
					while($row = mysqli_fetch_assoc($results)){?>
						<tr>
							<td><?php $i=$i+1; echo $i;?></td>
							<td><?php echo $row['nume'];?></td>
							<td><?php echo $row['prenume'];?></td>
							<td><?php echo $row['stadiu'];?></td>
							<td><?php echo $row['data_infectare'];?></td>
							<td>
							    <?php 
								$id_pacient_covid=$row['id'];
								$files_edit = array();
								$array_edit = array($row['id'],$id_medic);
								foreach ($array_edit as $item){
								  $files_edit[] ='files[]=' . $item;
								}
								$items_edit = implode('&', $files_edit);
								
								echo '<a href="edit_action_pacienti_covid.php?' . $items_edit . '"
								class = "btn btn-success">Editare</a>';
											
								//delete
								$files = array();
								$array1 = array($row['id'],$id_medic);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								echo '<a href="delete_action_pacienti_covid.php?' . $items . '" class="btn btn-danger">Ștergere</a>';
								
								?>
							</td>
						</tr>
				<?php	} 
				}
				}				
				?>
				
				</tbody>
				
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