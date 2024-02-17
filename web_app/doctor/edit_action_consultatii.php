<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<?php
	
		if(isset($_GET['files'])){
			$id_boala =  $_GET['files'][0];
			$id_medic =  $_GET['files'][2];
			$id_pacient =  $_GET['files'][1];
			
			$files_add = array();
			$array_add = array($id_pacient,$id_medic);
			foreach ($array_add as $item){
				$files_add[] ='files[]=' . $item;
			}
			$items_add = implode('&', $files_add);
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			
			$query = "SELECT * FROM medici WHERE id = $id_medic ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$prenume = $row['prenume'];
			$nume_poza=$row['nume_poza'];
			
		}
	?>
	<script>
	function goBack() {
	  window.history.back()
	}
	function goForward() {
      window.history.forward();
	}
	</script>
	
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
			<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
			<h2 style="font-size:22px;color:white;">PatientsManager</h2>
			<div style="width:1050px;height:60px;">
			<center><h2 style="color:#ffffff;font: italic bold 40px Georgia, serif;"></h2></center>
			</div>
			<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
			<?php //if(isset($_GET['files'])){ echo '<a href="pacient_consultatii.php?' . $items_add . '"class="btn btn-info" style="background-color:white;color:blue;" >Înapoi</a>';}?>
			<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
			<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
			<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
			<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
			
		</nav>

<head>
<style>
	body {color: black; background-image: url('pacient_fundal.jpg'); }

	.left, .right { width: 50%; float: left; }

	.left  { text-align: right; }
	.right { text-align: left;  }

	label, span, input, select { display: block; padding: 10px; margin: 10px; }

	label,span   { font-family: sans-serif; line-height: 20px; font-weight: bold; margin:10px 0px 20px 0px; }
	input  { width: 400px;            height: 40px;      box-sizing:border-box;margin:10px 0px 20px 0px; }
	select { width: 400px;            height: 52px;      box-sizing:border-box;margin:0px 0px 20px 0px;}
	</style>

<?php
$duration = 20;
$cleanup = 0;
$start = "09:00";
$end = "15:00";

function timeslots($duration, $cleanup, $start, $end){
	$start = new DateTime($start);
	$end = new DateTime($end);
	$interval = new DateInterval("PT".$duration."M");
	$cleanupInterval = new DateInterval("PT".$cleanup."M");
	$slots = array();
	for($intStart = $start; $intStart<$end;$intStart->add($interval)->add($cleanupInterval)){
		$endPeriod = clone $intStart;
		$endPeriod->add($interval);
		if($endPeriod > $end){
			break;
		}
		$slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
	}
	return $slots;
}
?>
<body style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">
	<div class = "card" style="margin:50px 300px 300px 300px; width:1000px;opacity: 0.9;">
		<div class = "card-header" style="background-color:#0275d8;">
			<center><h2>Editare consultație</h2><center>
	    </div>
		<div class="card-body" style="font-size:26; background-color: #ccccb3">
			<form action="pacient_consultatii.php" method = "post">

				<?php
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				if(isset($_GET['files'])){
					$id_consultatie =  $_GET['files'][0];
					$id_pacient=$_GET['files'][1];
					$id_medic=$_GET['files'][2];
					$query = "SELECT * FROM consultatii WHERE id=$id_consultatie";
					$results = mysqli_query($db, $query);
					if(mysqli_num_rows($results) > 0 ){
						while($row = mysqli_fetch_assoc($results)){
							$id=$row['id'];
							$data=$row['data'];
							$ora=$row['ora'];
							$diagnostic=$row['diagnostic'];
							$tratament=$row['tratament'];
							$comentarii=$row['comentarii'];
							$id_trimitere=$row['id_bilet_trimitere'];
							$id_adeverinta=$row['id_adeverinta'];
							$id_reteta=$row['id_reteta'];
						}
				?>
				<div class="left">
					<span>Data:</span>
					<span >Ora:</span>
					<span >Diagnostic:</span>
					<span >Tratament:</span>
					<span >Comentarii:</span>
					<span>Preț(lei):</span>
					<?php if($id_adeverinta OR $id_trimitere OR $id_reteta){
					echo '<span>Documente:</span>';}?>
				</div>
				<div class="right">
					<input type="hidden" name="id_consultatie" value="<?php echo $id;?>" readonly="readonly">	
					<input type="hidden" name="id_adeverinta" value="<?php echo $id_adeverinta;?>" readonly="readonly">	
					<input type="hidden" name="id_trimitere" value="<?php echo $id_trimitere;?>" readonly="readonly">	
					<input type="hidden" name="id_reteta" value="<?php echo $id_reteta;?>" readonly="readonly">	
					<input type="date"  style ="height:50px;" name="data" value="<?php echo $data;?>">
					<select name="ora">
						<?php $timeslots = timeslots($duration,$cleanup, $start, $end);
						foreach($timeslots as $ts){
						?>
						<option value="<?php echo $ts; ?>" ><?php echo $ts;?></option>
						<?php } ?>
					</select>
					<input type="text" name="diagnostic" value="<?php echo $diagnostic;?>">
					<input type="text" name="tratament" value="<?php echo $tratament;?>">
					<input type="text" name="comentarii" value="<?php echo $comentarii;?>">
					<select name = "pret" >
						<?php $preturi = array(0,5,10,15,20,25,30,35,40,45,50,60,70,80,90,100);
						foreach($preturi as $pret){
						?>
						<option value=<?php echo $pret; ?> ><?php echo $pret;?></option>
						<?php } ?>
					</select>
					
					
					<?php if(isset($_GET['files'])){?>
					<input type="hidden" name="identificare" value="<?php echo $items_add;?>">
					<?php }?>
					
					<table>
					<tbody>
						<tr>
							<td>
							<?php 
								$query_trimitere="SELECT nume_trimitere FROM bilete_trimitere WHERE id=$id_trimitere";
								$result_trimitere = mysqli_query($db, $query_trimitere);
								if($result_trimitere){
									$row_trimitere = mysqli_fetch_assoc($result_trimitere);
									$nume_trimitere=$row_trimitere['nume_trimitere'];?>
									<a target ='_blank' href='documente/<?php echo $nume_trimitere;?>'><?php echo $nume_trimitere;?></a><?php }?>
								
							</td>
							<td>
							<?php 
							    $files = array();
								$array1 = array($id_trimitere,$id_pacient,$id_medic,$id_consultatie);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								if($id_trimitere){
								echo '<p><a href="delete_action_consultatii_doc_trimiteri.php?' . $items . '" class="btn btn-danger btn-sm">Ștergere</a></p>';
								}?>
							</td>
						</tr>
						<tr>
							<td>
							<?php 
							$query_adeverinta="SELECT nume_adeverinta FROM adeverinte WHERE id=$id_adeverinta";
							$result_adeverinta = mysqli_query($db, $query_adeverinta);
							if($result_adeverinta){
								$row_adeverinta = mysqli_fetch_assoc($result_adeverinta);
								$nume_adeverinta=$row_adeverinta['nume_adeverinta'];?>
							<a target ='_blank' href='documente/<?php echo $nume_adeverinta;?>'><?php echo $nume_adeverinta;?></a><?php }?>
							</td>
							<td>
							<?php 
							    $files = array();
								$array1 = array($id_adeverinta,$id_pacient,$id_medic,$id_consultatie);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								if($id_adeverinta){
								echo '<p><a href="delete_action_consultatii_doc_adeverinte.php?' . $items . '" class="btn btn-danger btn-sm">Ștergere</a></p>';
								}?>
							</td>
						</tr>
						<tr>
							<td>
							<?php 
								$query_reteta="SELECT nume_reteta FROM retete WHERE id=$id_reteta";
								$result_reteta = mysqli_query($db, $query_reteta);
								if($result_reteta){
									$row_reteta = mysqli_fetch_assoc($result_reteta);
									$nume_reteta=$row_reteta['nume_reteta'];?>
								<a target ='_blank' href='documente/<?php echo $nume_reteta;?>'><?php echo $nume_reteta;?></a><?php }?>
							</td>
							<td>
							<?php 
							    $files = array();
								$array1 = array($id_reteta,$id_pacient,$id_medic,$id_consultatie);
								foreach ($array1 as $item){
								  $files[] ='files[]=' . $item;
								}
								$items = implode('&', $files);
								if($id_reteta){
								echo '<p><a href="delete_action_consultatii_doc_retete.php?' . $items . '" class="btn btn-danger btn-sm">Ștergere</a></p>';
								}?>
							</td>
						</tr>
					<tbody>
					</table>
					<input type="submit" class="btn btn-success btn-lg" name="update_consultatie" value="Salvare">
				</div>
				<?php
				}
				}	
				?>
			</form>
		</div>
	</div>
</body>