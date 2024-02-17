<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;">Formular adeverință</span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza;?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>	
</head>
<style>
input {
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: groove;
     
      }
</style>
<body >
<?php
$_param = $_GET['files'];
$id_medic=$_param[1];
$id_pacient=$_param[0];
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
$query="SELECT * FROM pacienti WHERE id=$id_pacient";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_array($result);
$adresa_pacient=explode(',',$row['adresa']);
$data_nastere=explode('-',$row['data_nastere']);

//medic
$query_medic="SELECT * FROM medici M,cabinete C WHERE M.id=$id_medic AND M.id=C.id_medic";
$result_medic=mysqli_query($db,$query_medic);
$row_medic=mysqli_fetch_array($result_medic);
$adresa_cabinet=explode(',',$row_medic['adresa_cabinet']);
$denumire_cabinet=$row_medic['denumire_cabinet']

?>
	<form action="adeverinta_pdf.php" method="post">
		<div class="container" style="border-style:solid;margin-top:50px;padding:20px;width:800px;">
			<span>Judetul:</span>
			<input type="text" name="judet" value="<?php echo $adresa_cabinet[0]; ?>">
			<span style="float:right;">Nr.fisa/carnet de sanatate:</span><br>
			<span>Localitatea:</span>
			<input type="text" name="localitate" value="<?php echo $adresa_cabinet[1]; ?>">
			<input type="text" name="nr_fisa" style="float:right;"><br>
			<span>Unitatea sanitara:</span>
			<input type="text" name="unitate" value="<?php echo $denumire_cabinet;?>"><br>
			<center><h4>ADEVERINTA MEDICALA</h4></center><br>
			<span>Se adevereste ca</span>
			<input type="text" name="nume" value="<?php echo $row['nume']; ?>">
			<input type="text" name="prenume" value="<?php echo $row['prenume']; ?>">
			<span>sexul</span>
			<input type="text" name="sex" value="<?php echo $row['sex']; ?>"><br>
			<span>Nascut</span>
			<input type="text" name="an_nastere" value="<?php echo $data_nastere[0]; ?>">
			<span>luna</span>
			<input type="text" name="luna_nastere" value="<?php echo $data_nastere[1]; ?>">
			<span>ziua</span>
			<input type="text" name="ziua_nastere" value="<?php echo $data_nastere[2]; ?>"><br>
			<span>Cu domiciliul in: jud.</span>
			<input type="text" name="judet_pacient" style="width:110px;"  value="<?php echo $adresa_pacient[0]; ?>">
			<span>localitatea</span>
			<input type="text" name="localitate_pacient"  style="width:120px;" value="<?php echo $adresa_pacient[1]; ?>" >
			<span>str.</span>
			<input type="text" name="str_pacient" style="width:160px;" value="<?php 
																			if(substr($adresa_pacient[2],0,4)=="Str.")
																				echo substr($adresa_pacient[2],4); 
																		    else
																				echo $adresa_pacient[2];
																			?>">
			<span>nr.</span>
			<input type="text" name="nr_pacient" style="width:20px;" value="<?php echo substr($adresa_pacient[3],3); ?>"><br>
			<span>Avand ocupatia de:</span>
			<input type="text" name="ocupatie" value="<?php echo $row['ocupatie'];?>">
			<span>la</span>
			<input type="text" name="loc_munca" style="width:360px;" value="<?php echo $row['firma'];?>"><br><br>
			<p style="border-bottom-style: groove;"></p>
			<span>Este suferint de:</span>
			<input type="text" name="boala" style="width:600px;"><br>
			<span>Se recomanda:</span>
			<input type="text" name="recomandari" style="width:600px;"><br><br>
			<p style="border-bottom-style: groove;"></p>
			<span>S-a eliberat pentru a-i servi la:</span>
			<input type="text" name="scop" style="width:500px;"><br><br>
			<p style="border-bottom-style: groove;"></p>
			<span>Data eliberarii:<span>
			<span style="float:right;">Semnatura si parafa medicului</span><br>
			<span>an</span>
			<input type="text" name="an" style="width:40px;">
			<span>luna</span>
			<input type="text" name="luna" style="width:40px;">
			<span>ziua</span>
			<input type="text" name="zi" style="width:40px;">
			<span style="margin-left:320px;">L.S</span>
			<input type="text" name="semnatura" style="float:right;">
			</div>
			<br>
			<br>
			<center><input type="submit" name = "adeverinta"  class="btn btn-success" value = "Creare pdf"/></center>
	</form > 
	
</body>
</div>
</html>