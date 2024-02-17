<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Istoric consultatii</title>
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
		<div style="width:1000px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;">Istoric consultații</span></center>
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
	   echo '<a class="btn btn-info bg-primary" style="margin-left:1410px;" href="adaugare_consultatie.php?' . $items_add . '" class="btn btn-success">Consultație nouă</a>';?></span>
	</div>
	<style>
	.td{
		word-wrap: break-word;
		max-width: 150px;
	}
	</style>
</head>
<body style="background-image:url('sfat.jpg');background-repeat:no-repeat;background-size:cover;">
	<div style="margin:50px;">
	<table class="table table-striped table-bordered mydatatable" style="width:100%; background-color:#ff794d;opacity: 0.9;">
		<thead>
			<tr>
			  <th scope="col">Nr.crt.</th>
			  <th scope="col">Data</th>
			  <th scope="col">Ora</th>
			  <th scope="col">Diagnostic</th>
			  <th scope="col">Tratament</th>
			  <th scope="col">Comentarii</th>
			  <th scope="col">Pret(lei)</th>
			  <th scope="col">Adeverinte</th>
			  <th scope="col">Vaccinuri</th>
			  <th scope="col">Trimiteri analize</th>
			   <th scope="col">Retete medicale</th>
			  <th span=2 scope="col">Actiuni</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
	
				
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				//inserez toate adeverintele pacientului meu
				if(isset($_POST['update_consultatie'])){
					
				$id_pacient = $_SESSION['id_pacient'];
				$id_medic = $_SESSION['id_medic'];	
				$id_consultatie=$_POST['id_consultatie'];
				$data=$_POST['data'];
				$ora=$_POST['ora'];
				$tratament=$_POST['tratament'];
				$comentarii=$_POST['comentarii'];
				$diagnostic=$_POST['diagnostic'];
				$pret=$_POST['pret'];
				$query_update = "UPDATE consultatii SET data='$data', ora='$ora',tratament='$tratament',diagnostic='$diagnostic', comentarii='$comentarii',pret=$pret WHERE id= $id_consultatie";
				$results_update = mysqli_query($db, $query_update);
				$i=0;










				
					
				$query = "SELECT * FROM consultatii WHERE id_pacient=$id_pacient";
				$results = mysqli_query($db, $query);
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){
						$data_consultatie=$row['data'];?>
						<tr>
							<td><?php $i=$i+1;echo $i;?></td>
							<td><?php echo $row['data'];?></td>
							<td><?php echo $row['ora'];?></td>
							<td><?php echo $row['diagnostic'];?></td>
							<td><?php echo $row['tratament'];?></td>
							<td><?php echo $row['comentarii'];?></td>
							<td><?php echo $row['pret'];?></td>
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$id_adeverinta=$row['id_adeverinta'];
							$query_adeverinta="SELECT nume_adeverinta FROM adeverinte WHERE id=$id_adeverinta";
							$result_adeverinta = mysqli_query($db, $query_adeverinta);
							if($result_adeverinta){
								$row_adeverinta = mysqli_fetch_assoc($result_adeverinta);
								$nume_adeverinta=$row_adeverinta['nume_adeverinta'];?>
							<a target ='_blank' href='documente/<?php echo $nume_adeverinta;?>'><?php echo $nume_adeverinta;?></a><?php }?></td>
							
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$query_pacient="SELECT nume,prenume FROM pacienti WHERE id=$id_pacient";
							$result_pacient = mysqli_query($db, $query_pacient);
							$row_pacient = mysqli_fetch_assoc($result_pacient);
							$nume_pacient=$row_pacient['nume'];
							$prenume_pacient=$row_pacient['prenume'];
							$nume_aviz_epidemiologic=$nume_pacient.'_'.$prenume_pacient.'_fisa_vaccinari_'.$data_consultatie.'.pdf';
							if(file_exists('documente/'.$nume_aviz_epidemiologic)){
								?>
							<a target ='_blank' href='documente/<?php echo $nume_aviz_epidemiologic;?>'><?php echo $nume_aviz_epidemiologic;?></a><?php }?></td>
							
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$id_trimitere=$row['id_bilet_trimitere'];
							$query_trimitere="SELECT nume_trimitere FROM bilete_trimitere WHERE id=$id_trimitere";
							$result_trimitere = mysqli_query($db, $query_trimitere);
							if($result_trimitere){
								$row_trimitere = mysqli_fetch_assoc($result_trimitere);
								$nume_trimitere=$row_trimitere['nume_trimitere'];?>
								<a target ='_blank' href='documente/<?php echo $nume_trimitere;?>'><?php echo $nume_trimitere;?></a><?php }?></td>
							
							
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$id_reteta=$row['id_reteta'];
							$query_reteta="SELECT nume_reteta FROM retete WHERE id=$id_reteta";
							$result_reteta = mysqli_query($db, $query_reteta);
							if($result_reteta){
								$row_reteta = mysqli_fetch_assoc($result_reteta);
								$nume_reteta=$row_reteta['nume_reteta'];?>
							<a target ='_blank' href='documente/<?php echo $nume_reteta;?>'><?php echo $nume_reteta;?></a><?php }?></td>
							
							<td><?php 
								$files_edit = array();
								$array_edit = array($row['id'],$id_pacient,$id_medic);
								foreach ($array_edit as $item){
								  $files_edit[] ='files[]=' . $item;
								}
								$items_edit = implode('&', $files_edit);
								
								echo '<a style="width:65px;" href="edit_action_consultatii.php?' . $items_edit . '"
								class = "btn btn-success">Editare</a>';
								
								
								$files = array();
								$array1 = array($row['id'],$id_pacient,$id_medic);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								echo '<p><a href="delete_action_consultatii.php?' . $items . '" class="btn btn-danger">Ștergere</a></p>';
								
								?>
							</td>
						</tr>
					<?php
					}
				}
				}
				else{
				$_param = $_GET['files'];
				$id_medic=$_param[1];
				$id_pacient=$_param[0];
				$_SESSION['id_pacient']=$id_pacient;
				$_SESSION['id_medic']=$id_medic;
				$query = "SELECT * FROM consultatii WHERE id_pacient=$id_pacient";
				$results = mysqli_query($db, $query);
				$i=0;
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){
						$data_consultatie=$row['data'];?>
						<tr>
							<td><?php $i=$i+1;echo $i;?></td>
							<td><?php echo $row['data'];?></td>
							<td><?php echo $row['ora'];?></td>
							<td><?php echo $row['diagnostic'];?></td>
							<td><?php echo $row['tratament'];?></td>
							<td><?php echo $row['comentarii'];?></td>
							<td><?php echo $row['pret'];?></td>
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$id_adeverinta=$row['id_adeverinta'];
							$query_adeverinta="SELECT nume_adeverinta FROM adeverinte WHERE id=$id_adeverinta";
							$result_adeverinta = mysqli_query($db, $query_adeverinta);
							if($result_adeverinta){
								$row_adeverinta = mysqli_fetch_assoc($result_adeverinta);
								$nume_adeverinta=$row_adeverinta['nume_adeverinta'];?>
							<a target ='_blank' href='documente/<?php echo $nume_adeverinta;?>'><?php echo $nume_adeverinta;?></a><?php }?></td>
							
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$query_pacient="SELECT nume,prenume FROM pacienti WHERE id=$id_pacient";
							$result_pacient = mysqli_query($db, $query_pacient);
							$row_pacient = mysqli_fetch_assoc($result_pacient);
							$nume_pacient=$row_pacient['nume'];
							$prenume_pacient=$row_pacient['prenume'];
							$nume_aviz_epidemiologic=$nume_pacient.'_'.$prenume_pacient.'_fisa_vaccinari_'.$data_consultatie.'.pdf';
							if(file_exists('documente/'.$nume_aviz_epidemiologic)){
								?>
							<a target ='_blank' href='documente/<?php echo $nume_aviz_epidemiologic;?>'><?php echo $nume_aviz_epidemiologic;?></a><?php }?></td>
							
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$id_trimitere=$row['id_bilet_trimitere'];
							$query_trimitere="SELECT nume_trimitere FROM bilete_trimitere WHERE id=$id_trimitere";
							$result_trimitere = mysqli_query($db, $query_trimitere);
							if($result_trimitere){
								$row_trimitere = mysqli_fetch_assoc($result_trimitere);
								$nume_trimitere=$row_trimitere['nume_trimitere'];?>
								<a target ='_blank' href='documente/<?php echo $nume_trimitere;?>'><?php echo $nume_trimitere;?></a><?php }?></td>
							
							
							<td style="word-wrap: break-word;max-width: 150px;"><?php 
							$id_reteta=$row['id_reteta'];
							$query_reteta="SELECT nume_reteta FROM retete WHERE id=$id_reteta";
							$result_reteta = mysqli_query($db, $query_reteta);
							if($result_reteta){
								$row_reteta = mysqli_fetch_assoc($result_reteta);
								$nume_reteta=$row_reteta['nume_reteta'];?>
							<a target ='_blank' href='documente/<?php echo $nume_reteta;?>'><?php echo $nume_reteta;?></a><?php }?></td>
							
							<td><?php 
								$files_edit = array();
								$array_edit = array($row['id'],$id_pacient,$id_medic);
								foreach ($array_edit as $item){
								  $files_edit[] ='files[]=' . $item;
								}
								$items_edit = implode('&', $files_edit);
								
								echo '<a style="width:65px;" href="edit_action_consultatii.php?' . $items_edit . '"
								class = "btn btn-success">Editare</a>';
								
								
								$files = array();
								$array1 = array($row['id'],$id_pacient,$id_medic);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								echo '<p><a href="delete_action_consultatii.php?' . $items . '" class="btn btn-danger">Ștergere</a></p>';
								
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