<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Adaugare consultatie</title>
	<?php
		session_start();
		if(isset($_GET['files'])){
			$id_medic =  $_GET['files'][1];
			$id_pacient =  $_GET['files'][0];
			
			$files_add = array();
			$array_add = array($id_pacient,$id_medic);
			foreach ($array_add as $item){
			  $files_add[] ='files[]=' . $item;
			}
			$items_add = implode('&', $files_add);
			$_SESSION['date_identificare']=$items_add;
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
		<center><h2 style="color:#ffffff;font: italic bold 40px Georgia, serif;">Adăugare consultație</h2></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="profil.jpg" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
</head>
<style>
	.left, .right { width: 20%; float: left; }

	.left  { text-align: right; }
	.right { text-align: left;  }

	label, span, input, select{ display: block; padding: 10px; margin: 10px; }

	label,span   { font-family: sans-serif; line-height: 20px; font-weight: bold; margin:10px 0px 20px 0px; }
	input { width: 300px;            height: 40px;      box-sizing:border-box;margin:10px 0px 20px 0px; }
	select { width: 300px;            height: 53px;      box-sizing:border-box;margin:0px 0px 20px 0px;}
	</style>
<body style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">
<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_GET['files'])){
$_param = $_GET['files'];
$id_medic=$_param[1];
$id_pacient=$_param[0];
$_SESSION['id_pacient']=$id_pacient;
$_SESSION['id_medic']=$id_medic;
$files = array();
$array1 = array($id_pacient,$id_medic);
foreach ($array1 as $item){
	$files[] ='files[]=' . $item;
	}
$items = implode('&', $files);
}
?>
<div class = "card"  style="margin:100px 50px 0px 50px;;opacity:0.9;float:left;">
	<div class = "card-header" style="background-color:#0275d8;">
		<center><h3>Documente consultație</h3><center>
	</div>
	<div class = "card-body" style="font-size:26; background-color:#ccccb3;">
		
		<?php echo '<a href="formular_adeverinta.php?' . $items . '" class ="btn btn-info" style="margin:10px 0px 20px 0px;" >Creează adeverință</a><br>';?>
		<?php echo '<a href="formular_bilet_trimitere.php?' . $items . '" class ="btn btn-info" style="margin:10px 0px 20px 0px;" >Creează trimitere</a><br>';?>
		<?php echo '<a href="formular_reteta.php?' . $items . '" class ="btn btn-info" style="margin:10px 0px 20px 0px;" >Creează rețetă</a><br>';?>
		<?php echo '<a href="aviz_epidemiologic.php?' . $items . '" class ="btn btn-info" style="margin:10px 0px 20px 0px;" >Creează fișă vaccinări</a><br>';?>

	</div>
</div>
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
<div class = "card"  style="margin:100px 0px 0px 50px;width:1000px;;opacity:0.9;">
	<div class = "card-header" style="background-color:#0275d8;">
		<center><h3>Informații consultație</h3><center>
	</div>
	<div class = "card-body" style="font-size:26; background-color:#ccccb3;">
	<form method="post" action="adaugare_consultatie_action.php">
			<div class="left">
				<span>Data:</span>
				<span>Ora:</span>
				<span>Diagnostic:</span>
				<span>Tratament:</span>
				<span>Comentarii:</span>
				<span>Preț(lei):</span>		
			</div>
			<div class="right">
				<input type= "date" name = "data" value=<?php echo date('Y-m-d');?>>
				<select name="ora">
				<?php $timeslots = timeslots($duration,$cleanup, $start, $end);
				foreach($timeslots as $ts){
				?>
				<option value="<?php echo $ts; ?>" ><?php echo $ts;?></option>
				<?php } ?>
				</select>
				<input type= "text" name = "diagnostic">
				<input type= "text" name = "tratament">
				<input type= "text" name = "comentarii">
				<select name = "pret">
				<?php $preturi = array(0,5,10,15,20,25,30,35,40,45,50,60,70,80,90,100);
				foreach($preturi as $pret){
				?>
				<option value=<?php echo $pret; ?> ><?php echo $pret;?></option>
				<?php } ?>
				</select>
				
				<?php 
				$files = array();
				$array1 = array($_SESSION['id_pacient'],$_SESSION['id_medic']);
				foreach ($array1 as $item){
					$files[] ='files[]=' . $item;
					}
				$items = implode('&', $files);
				?>
				
				<input type="hidden" name="identificare" value=<?php echo $items;?>>
				<input type="submit" name = "adaugare_consultatie"  class="btn btn-success" style = " width: 100px;height:40px;text-align: center;"value = "Adaugă"/>
			</div>
	</form>	
	<div>
</div>

</body>