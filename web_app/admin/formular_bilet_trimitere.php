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
		
	?>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1000px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;">Formular bilet de trimitere</span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="profil.jpg" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>	
</head>
<style>
input  {
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: groove;
     
      }
</style>
<body>
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
$nume_asigurat=$row['nume'];
$prenume_asigurat=$row['prenume'];

//medic
$query_medic="SELECT * FROM medici M,cabinete C WHERE M.id=$id_medic AND M.id=C.id_medic";
$result_medic=mysqli_query($db,$query_medic);
$row_medic=mysqli_fetch_array($result_medic);
$adresa_cabinet=explode(',',$row_medic['adresa_cabinet']);
$denumire_cabinet=$row_medic['denumire_cabinet'];
$cui=$row_medic['cui'];
$cas=$row_medic['denumire_cas'];
$contract=$row_medic['nr_contract_cas'];
require "vendor/autoload.php";
$Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
$code = $Bar->getBarcode($row['nume'], $Bar::TYPE_CODE_128);
?>
<div class="container" style="border-style:solid;margin-top:50px;margin-bottom:50px;">
	<form action="trimitere_pdf.php" method="post">
		<div >
			<center><h4>Bilet de trimitere pentru inverstigatii paraclinice decontate de CAS</h4></center>
			<div style="margin:0px 0px 0px 200px;display: inline-block;text-align:center; ">
			<span style="display: inline-block">Serie:</span>
			<input type="text" name="serie_trimitere" style="display: inline-block">
			<span style="display: inline-block" >Nr:</span>
			<input type="text" name="numar_trimitere" style="display: inline-block">
			<span style="display: inline-block" ><?php echo $code?></span>
			</div>
			<br>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<div style="float:left;">
				<span>1.Unitate medicala:</span><br>
				<span>CUI:</span>
				<input type="text" name="cui" value="<?php echo $cui; ?>"><br>
				<span>Sediu(localitate,strada,nr):</span>
				<input type="text" name="adresa" style="width:300px;" value="<?php echo $adresa_cabinet[1].','.$adresa_cabinet[2].','.$adresa_cabinet[3]; ?>"><br>
				<span>Judetul:</span>
				<input type="text" name="judet" value="<?php echo $adresa_cabinet[0]; ?>"><br>
				<span>Casa de asigurari:</span>
				<input type="text" name="cas" value="<?php echo $cas;?>"><br>
				<span>Nr.contract/conventie:</span>
				<input type="text" name="nr_contract" value="<?php echo $contract;?>"><br>
			</div>
			<div style="border-right-style: groove;width:150px;float:left;margin-left:100px;">
				<input type="checkbox" id="opt1" name="opt1" value="MF">
				<label for="opt1">MF</label><br>
				<input type="checkbox" id="opt2" name="opt2" value="Amb.Spec.">
				<label for="opt2">Amb.Spec.</label><br>
				<input type="checkbox" id="opt3" name="opt3" value="Altele">
				<label for="opt3" style="display:inline-block;">Altele</label>
				<br>
				<br>				
			</div>
			<div style="float:left;padding-left:100px;">
				<input type="radio" id="opt4" name="opt4" value="Urgenta">
				<label for="opt4">Urgenta</label><br>
				<input type="radio" id="opt5" name="opt5" value="Curente">
				<label for="opt5">Curente</label><br>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<div style="float:left;">
				<span>2.Date de identificare asigurat:</span><br>
				<span>Asigurat la cas:</span>
				<input type="text" name="cas_asigurat" value="<?php echo $row['denumire_cas']; ?>"><br>
				<span>Nume:</span>
				<input type="text" name="nume_asigurat" value="<?php echo $nume_asigurat; ?>"><br>
				<span>Prenume:</span>
				<input type="text" name="prenume_asigurat" value="<?php echo $prenume_asigurat; ?>"><br>
				<span>Adresa:</span>
				<input style="width:300px"; type="text" name="adresa_asigurat" value="<?php echo $row['adresa']; ?>"><br>
				<span>CNP:</span>
				<input type="text" name="cnp_asigurat" value="<?php echo $row['cnp']; ?>"><br>
				<span>Cetatenie:</span>
				<input type="text" name="cetatenie" value="<?php echo $row['cetatenie']; ?>"><br>
			</div>
			<div style="border-right-style: groove;width:200px;float:left;margin-left:200px;">
				<input type="checkbox" id="opt6" name="opt6" value="salariat">
				<label for="opt6">salariat</label><br>
				<input type="checkbox" id="opt7" name="opt7" value="coasigurat">
				<label for="opt7">coasigurat</label><br>
				<input type="checkbox" id="opt8" name="opt8" value="liber-profesionist">
				<label for="opt8">liber-profesionist</label><br>
				<input type="checkbox" id="opt9" name="opt9" value="copil">
				<label for="opt9">copil(<18 ani)</label><br>
				<input type="checkbox" id="opt10" name="opt10" value="elev">
				<label for="opt10">elev/ucenic/student(18-26 ani)</label><br>
				<input type="checkbox" id="opt11" name="opt11" value="gravida">
				<label for="opt11">gravida/lehuza</label><br>
				<input type="checkbox" id="opt12" name="opt12" value="pensionar">
				<label for="opt12">pensionar</label><br>
				<input type="checkbox" id="opt13" name="opt13" value="alte categorii">
				<label for="opt13">alte categorii</label><br>				
			</div>
			<div style="float:left;padding-left:100px;">
				<input type="checkbox" id="opt14" name="opt14" value="veteran">
				<label for="opt14">veteran</label><br>
				<input type="checkbox" id="opt15" name="opt15" value="revolutionar">
				<label for="opt15">revolutionar</label><br>
				<input type="checkbox" id="opt16" name="opt16" value="handicap">
				<label for="opt16">handicap</label><br>
				<input type="checkbox" id="opt17" name="opt17" value="PNS">
				<label for="opt17">PNS..</label><br>
				<input type="checkbox" id="opt18" name="opt18" value="ajutor social">
				<label for="opt18">ajutor social</label><br>
				<input type="checkbox" id="opt19" name="opt19" value="somaj">
				<label for="opt19">somaj</label><br><br>
				<input type="checkbox" id="opt20" name="opt20" value="card european">
				<label for="opt20">card european(CE)</label><br>
				<input type="checkbox" id="opt21" name="opt21" value="acorduri internationale">
				<label for="opt21">acorduri internationale</label><br>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<span style="float:left;">Cod diagnostic</span>
			<span style="margin-left:200px;float:left">Diagnostic</span>
			<label for="opt22" style="margin-left:570px"> P </label>
			<label  for="opt23"> A/S </label>
			<label  for="opt24" > C</label>
			<label for="opt25" > M </label>
			<br>
			<input type="text" name="cod_diagnostic" style="border-style: groove;float:left;">
			<input type="text" name="diagnostic" style="margin-left:120px;width:250px;float:left;">
			<div style="margin-left:950px;">
				<input type="checkbox" id="opt22" name="opt22" value="acorduri internationale">
				<input type="checkbox" id="opt22" name="opt22" value="acorduri internationale">
				<input type="checkbox" id="opt22" name="opt22" value="acorduri internationale">
				<input type="checkbox" id="opt22" name="opt22" value="acorduri internationale">
			</div>
			<br>
			<span style="float:left;">Data trimiterii:</span>
			<input type="date" name="data_trimitere">
			<span>Semantura medicului:</span>
			<input type="text" name="semnatura">
			<span>Cod parafa:</span>
			<input type="text" name="cod_parafa">
			<br>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<p >4.</p>
			<table border=1>
			<th>Pozitie</th>
			<th>Cod inverstigatie</th>
			<th>Investigatie recomandata</th>
			<th>Investigatie efectuata</th>
			<tr>
			<td>1</td>
			<td><input style="border-style:hidden;" type="text" name="cod1"></td>
			<td><input style="border-style:hidden;" type="text" name="rec1"></td>
			<td></td>
			</tr>
			<tr>
			<td>2</td>
			<td><input style="border-style:hidden;" type="text" name="cod2"></td>
			<td><input style="border-style:hidden;" type="text" name="rec2"></td>
			<td></td>
			</tr>
			<tr>
			<td>3</td>
			<td><input style="border-style:hidden;" type="text" name="cod3"></td>
			<td><input style="border-style:hidden;" type="text" name="cod3"></td>
			<td></td>
			</tr>
			<tr>
			<td>4</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>5</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>6</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>7</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>8</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>9</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td>10</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			</table>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<span>Numele si semnatura persoanei desemnate de furnizroul de servicii paraclinice:</span><br>
			<input type="text" name="persoana_servicii" style="width:800px;">
			<br>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<span>Data prezentarii asiguratului:</span>
			<span style="margin-left:500px;">Semnatura asiguratului:</span><br>
			<input type="date" name="data">
			<input type="text" name="semnatura"style="margin-left:500px;">
		</div>
			<center><input type="submit" name = "bilet_trimitere"  class="btn btn-success" value = "Creare pdf"/></center>
	</form > 
	</div>
</body>
</div>
</html>