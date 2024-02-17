<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Istoric parametri</title>
	<script>
	function goBack() {
	  window.history.back()
	}
	function goForward() {
      window.history.forward();
	}
	</script>
	
	<?php 
	session_start();
	if(isset($_GET['files'])){
		$param = $_GET['files'];
		$id_pacient=$param[0];
		$id_medic=$param[1];
	}
	else
	{
		$id_pacient=$_SESSION['id_pacient'];
		$id_medic=$_SESSION['id_medic'];
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$query = "SELECT * FROM medici WHERE id = $id_medic ";
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_array($results);
	$prenume = $row['prenume'];
	$nume_poza=$row['nume_poza'];
		
	?>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1050px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;">Istoric parametri</span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>
	<div class="card" style="background-color:#000;padding-top:15px;padding-bottom:15px;">
	<span ><?php 
        $files_add = array();
		$array_add = array($id_pacient,$id_medic);
		foreach ($array_add as $item){
		  $files_add[] ='files[]=' . $item;
		}
		$items_add = implode('&', $files_add);
	   echo '<a class="btn btn-info bg-primary" style="margin-left:1300px;" href="adaugare_parametru.php?' . $items_add . '" class="btn btn-success">Adaugare parametru</a>';
	   echo '<a class="btn btn-info bg-primary" style="margin-left:10px;" href="grafic_greutate.php?' . $items_add . '" class="btn btn-success">Grafic tensiune</a>';
		
		?></span>
	</div>

</head>
<body style="background-image:url('sfat.jpg');background-repeat:no-repeat;background-size:cover;">
<div class="container mb-3 mt-3">
	<table class="table table-striped table-bordered mydatatable" style="width:100%; background-color:#ff794d;opacity: 0.9;">
	<thead>
		<tr>
		  <th scope="col">Nr.crt.</th>
		  <th scope="col">Puls(bătai/min)</th>
		  <th scope="col">Tensiune(mm Hg)</th>
		  <th scope="col">Înălțime(m)</th>
		  <th scope="col">Greutate(kg)</th>
		  <th scope="col">Data</th>
		  <th scope="col">Acțiuni</th>
		</tr>
	</thead>
	<tbody>
		<?php
				
				
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');	
				if(isset($_POST['update_parametri'])){
					$id_pacient = $_SESSION['id_pacient'];
					$id=$_POST['id_parametru'];
					$puls=$_POST['puls'];
					$tensiune=$_POST['tensiune'];
					$greutate=$_POST['greutate'];
					$inaltime=$_POST['inaltime'];
					$data=$_POST['data'];
					$query_update = "UPDATE parametri SET data='$data', inaltime='$inaltime',puls='$puls',tensiune='$tensiune',greutate='$greutate' WHERE id= $id";
					$results_update = mysqli_query($db, $query_update);
					
					$query = "SELECT id,puls,tensiune,greutate,inaltime, data FROM parametri WHERE id_pacient = $id_pacient ";
				    $results = mysqli_query($db, $query);
					$i=0;
				if(mysqli_num_rows($results) > 0 ){
				while($row = mysqli_fetch_assoc($results)){?>
					<tr>
						<td><?php $i=$i+1;echo $i;?></td>
						<td><?php echo $row['puls'];?></td>
						<td><?php echo $row['tensiune'];?></td>
						<td><?php echo $row['inaltime'];?></td>
						<td><?php echo $row['greutate'];?></td>
						<td><?php echo $row['data'];?></td>
						<td style="width:300px;">
						<?php 
							$files_edit = array();
							$array_edit = array($row['id'],$id_pacient,$id_medic);
							foreach ($array_edit as $item){
							  $files_edit[] ='files[]=' . $item;
							}
							$items_edit = implode('&', $files_edit);
							
							echo '<a href="edit_action_parametri.php?' . $items_edit . '"
							class = "btn btn-success">Editare</a>';
							
							//delete
							$files = array();
							$array1 = array($row['id'],$id_pacient,$id_medic);
							foreach ($array1 as $item){
							  $files[] ='files[]=' . $item;
							}
							$items = implode('&', $files);
							echo '<a href="delete_action_parametri.php?' . $items . '" class="btn btn-danger">Ștergere</a>';
						
						?>
						</td>
					</tr>
				<?php
					}
				}
				}
				else{
				$id_pacient = $_GET['files'][0];
				$id_medic = $_GET['files'][1];
				$_SESSION['id_pacient']=$id_pacient;
				$_SESSION['id_medic'] = $id_medic;
				$query = "SELECT id,puls,tensiune,greutate,inaltime, data FROM parametri WHERE id_pacient = $id_pacient ";
				$results = mysqli_query($db, $query);
				$i=0;
				if(mysqli_num_rows($results) > 0 ){
				while($row = mysqli_fetch_assoc($results)){?>
					<tr>
						<td><?php $i=$i+1;echo $i;?></td>
						<td><?php echo $row['puls'];?></td>
						<td><?php echo $row['tensiune'];?></td>
						<td><?php echo $row['inaltime'];?></td>
						<td><?php echo $row['greutate'];?></td>
						<td><?php echo $row['data'];?></td>
						<td style="width:300px;">
						<?php 
							$files_edit = array();
							$array_edit = array($row['id'],$id_pacient,$id_medic);
							foreach ($array_edit as $item){
							  $files_edit[] ='files[]=' . $item;
							}
							$items_edit = implode('&', $files_edit);
							
							echo '<a href="edit_action_parametri.php?' . $items_edit . '"
							class = "btn btn-success">Editare</a>';
							
							//delete
							$files = array();
							$array1 = array($row['id'],$id_pacient,$id_medic);
							foreach ($array1 as $item){
							  $files[] ='files[]=' . $item;
							}
							$items = implode('&', $files);
							echo '<a href="delete_action_parametri.php?' . $items . '" class="btn btn-danger">Ștergere</a>';
						
						?>
						</td>
					</tr>
				<?php
				}
			}
				}?>
	
	</tbody>
</table>
</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		$('.mydatatable').DataTable();
	</script>

</body>
</div>