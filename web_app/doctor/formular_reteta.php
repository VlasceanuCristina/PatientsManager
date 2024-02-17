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
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;">Formular rețetă</span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>	
</head>
<style>
input  {
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: groove;
     
      }
table {
    table-layout: fixed;
    word-wrap: break-word;
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
<div class="container" style="border-style:solid;margin-top:50px;">
	<form action="reteta_pdf.php" method="post">
		<div style="margin:60px;padding:20px;">
			<center><h4>Formular reteta</h4></center>
			<br>
			<div >
			<span style="display: inline-block">Serie:</span>
			<input type="text" name="serie_reteta" style="display: inline-block">
			<span style="display: inline-block" >Nr:</span>
			<input type="text" name="numar_reteta" style="display: inline-block">
			</div>
			<br>
			<br>
			<div>
			<p style="border-top-style: groove;"></p>
			<span>1.Unitate medicala:</span><br>
			<input type="text" name="denumire_cabinet" value="<?php echo $denumire_cabinet; ?>"><br>
			<span>CUI:</span>
			<input type="text" name="cui" value="<?php echo $cui; ?>"><br>
			<span>CAS-contract/conventie:</span>
			<input type="text" name="nr_contract" value="<?php echo $contract;?>"><br><br>
			<span>Categorie unitate medicala:</span>
			<select name="categorie_unitate">
			<option value="MF">MF</option>
			<option value="MF-MM">MF-MM</option>
			<option value="ambulatoriu">Ambulatoriu</option>
			<option value="spital">Spital</option>
			<option value="altele">Altele</option>
			</select>
			</div>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<div>
				<span>2.Date de identificare asigurat:</span><br>
				<span>Asigurat la cas:</span>
				<input type="text" name="cas_asigurat" value="<?php echo $row['denumire_cas']; ?>"><br>
				<span>Nume:</span>
				<input type="text" name="nume_asigurat" value="<?php echo $row['nume']; ?>"><br>
				<span>Prenume:</span>
				<input type="text" name="prenume_asigurat" value="<?php echo $row['prenume']; ?>"><br>
				<span>CID:</span>
				<input type="text" name="cid" value="<?php echo $row['cid']; ?>"><br>
				<span>Data nastere:</span>
				<input type="text" name="data_nastere" value="<?php echo $row['data_nastere']; ?>"><br>
				<span>Cetatenie:</span>
				<input type="text" name="cetatenie" value="<?php echo $row['cetatenie']; ?>"><br>
				<span>Sex:</span>
				<input type="text" name="sex" value="<?php echo $row['sex']; ?>"><br><br>
				<span>Categorie:</span>
				<select name="categorie_asigurat">
				<option id="opt6" name="opt6" value="salariat">salariat</option>
				<option id="opt7" name="opt7" value="coasigurat">coasigurat</option>
				<option id="opt8" name="opt8" value="liber-profesionist">liber-profesionist</option>
				<option  id="opt9" name="opt9" value="copil">copil</option>
				<option  id="opt10" name="opt10" value="elev">elev</option>
				<option id="opt11" name="opt11" value="gravida">gravida</option>
				<option  id="opt12" name="opt12" value="pensionar">pensionar</option>
				<option  id="opt14" name="opt14" value="veteran">veteran</option>
				<option id="opt15" name="opt15" value="revolutionar">revolutionar</option>
				<option  id="opt16" name="opt16" value="handicap">handicap</option>
				<option id="opt17" name="opt17" value="PNS">PNS</option>
				<option  id="opt18" name="opt18" value="ajutor social">ajutor social</option>
				<option  id="opt19" name="opt19" value="somaj">somaj</option>
				<option  id="opt20" name="opt20" value="card european">card european</option>
				<option  id="opt21" name="opt21" value="acorduri internationale">acorduri internationale</option>
				<option id="opt13" name="opt13" value="alte categorii">alte categorii</option>
				</select>
				<span>Aprobat comisie:</span>
				<select name="aprobat_comisie">
					<option value="DA">DA</option>
					<option value="NU">NU</option>
				</select><br>
				<span>Numar decizie comisie:</span>
				<input type="text" name="nr_decizie" ><br>
				<span>Data decizie comisie:</span>
				<input type="date" name="data_decizie" ><br>
			</div>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<span style="float:left;">Cod Diagnostic</span>
			<input type="text" name="cod_diagnostic" style="width:850px;" >
			<br>
			<span style="float:left;">Diagnostic</span>
			<input type="text" name="diagnostic" style="width:850px;" >
			<br>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<span>4.</span>
			<span>Data prescriere</span>
			<input type="date" name="data_prescriere" id="#datetimepicker1">
			<span style="margin-left:100px;">Numar zile prescriere</span>
			<input  type="text" name="nr_zile">
			<br>
			<br>
			<div>
				<table class="table table-bordered table-sm">
					<th>Pozitie</th>
					<th>Cod diagnostic</th>
					<th>Tip diagnostic</th>
					<th>Denumire comună internatională/Denumire comercială/FF/Concentrație</th>
					<th>D.S.</th>
					<th>Cantitate(UT)</th>
					<th>Pret de referinta</th>
					<th>Lista</th>
					<tr>
						<td>1</td>
						<td style="width:10%"><input type="text" name="cod1" style="border-style:hidden;"></td>
						<td><input type="text" name="tip1" style="border-style:hidden"></td>
						<td><input type="text" name="denumire1" style="border-style:hidden"></td>
						<td><input type="text" name="ds1" style="border-style:hidden"></td>
						<td><input type="text" name="cantitate1" style="border-style:hidden"></td>
						<td><input type="text" name="pret1" style="border-style:hidden"></td>
						<td><input type="text" name="lista1" style="border-style:hidden"></td>
					</tr>
					<tr>
						<td>2</td>
						<td><input type="text" name="cod2" style="border-style:hidden"></td>
						<td><input type="text" name="tip2" style="border-style:hidden"></td>
						<td><input type="text" name="denumire2" style="border-style:hidden"></td>
						<td><input type="text" name="ds2" style="border-style:hidden"></td>
						<td><input type="text" name="cantitate2" style="border-style:hidden"></td>
						<td><input type="text" name="pret2" style="border-style:hidden"></td>
						<td><input type="text" name="lista2" style="border-style:hidden"></td>
					</tr>
					<tr>
					<td>3</td>
					<td><input type="text" name="cod3" style="border-style:hidden"></td>
					<td><input type="text" name="tip3" style="border-style:hidden"></td>
					<td><input type="text" name="denumire3" style="border-style:hidden"></td>
					<td><input type="text" name="ds3" style="border-style:hidden"></td>
					<td><input type="text" name="cantitate3" style="border-style:hidden"></td>
					<td><input type="text" name="pret3" style="border-style:hidden"></td>
					<td><input type="text" name="lista3" style="border-style:hidden"></td>
					</tr>
					<tr>
						<td>4</td>
						<td><input type="text" name="cod4" style="border-style:hidden"></td>
						<td><input type="text" name="tip4" style="border-style:hidden"></td>
						<td><input type="text" name="denumire4" style="border-style:hidden"></td>
						<td><input type="text" name="ds4" style="border-style:hidden"></td>
						<td><input type="text" name="cantitate4" style="border-style:hidden"></td>
						<td><input type="text" name="pret4" style="border-style:hidden"></td>
						<td><input type="text" name="lista4" style="border-style:hidden"></td>
					</tr>
					<tr>
					<td>5</td>
						<td><input type="text" name="cod5" style="border-style:hidden"></td>
						<td><input type="text" name="tip5" style="border-style:hidden"></td>
						<td><input type="text" name="denumire5" style="border-style:hidden"></td>
						<td><input type="text" name="ds5" style="border-style:hidden"></td>
						<td><input type="text" name="cantitate5" style="border-style:hidden"></td>
						<td><input type="text" name="pret5" style="border-style:hidden"></td>
						<td><input type="text" name="lista5" style="border-style:hidden"></td>
					</tr>
					<tr>
					<td>6</td>
						<td><input type="text" name="cod6" style="border-style:hidden"></td>
						<td><input type="text" name="tip6" style="border-style:hidden"></td>
						<td><input type="text" name="denumire6" style="border-style:hidden"></td>
						<td><input type="text" name="ds6" style="border-style:hidden"></td>
						<td><input type="text" name="cantitate6" style="border-style:hidden"></td>
						<td><input type="text" name="pret6" style="border-style:hidden"></td>
						<td><input type="text" name="lista6" style="border-style:hidden"></td>
					</tr>
					<tr>
					<td>7</td>
						<td><input type="text" name="cod7" style="border-style:hidden"></td>
						<td><input type="text" name="tip7" style="border-style:hidden"></td>
						<td><input type="text" name="denumire7" style="border-style:hidden"></td>
						<td><input type="text" name="ds7" style="border-style:hidden"></td>
						<td><input type="text" name="cantitate7" style="border-style:hidden"></td>
						<td><input type="text" name="pret7" style="border-style:hidden"></td>
						<td><input type="text" name="lista7" style="border-style:hidden"></td>
					</tr>
				</table>
			</div>
			<br>
			<p style="border-bottom-style: groove;"></p>
			<span>Parafa medic prescriptor:</span>
			<input type="text" name="parafa_medic"><br>
			<span>Semnatura medic prescriptor:</span>
			<input type="text" name="semnatura">
		</div>
			<center><input type="submit" name = "reteta"  class="btn btn-success" value = "Creare reteta pdf"/></center>
	</form> 
</div> 
</body>
</div>
</html>