<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php
		session_start();
		if(isset($_GET['pacient'])){
			$id_pacient =  $_GET['pacient'];
			$_SESSION['id_pacient']=$id_pacient;
		}
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		 $query1 = "SELECT * FROM pacienti WHERE id = $id_pacient";
		 $results1 = mysqli_query($db, $query1);
		$row1= mysqli_fetch_array($results1);
		$prenume=$row1['prenume'];
		$nume_poza=$row1['nume_poza'];
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
		<a href="acasa_pacient.php?pacient=<?php echo $id_pacient;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasă</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza;?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
</head>
<style>
	body {color: black; }

	.left, .right { width: 50%; float: left; }

	.left  { text-align: right; }
	.right { text-align: left;  }

	label, span, input, select { display: block; padding: 10px; margin: 10px; }

	label,span   { font-family: sans-serif; line-height: 20px; font-weight: bold; margin:10px 0px 20px 0px; }
	input  { width: 600px;            height: 40px;      box-sizing:border-box;margin:10px 0px 20px 0px; }
	select { width: 600px;            height: 51px;      box-sizing:border-box;margin:0px 0px 20px 0px;}
	</style>


<body style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">
<?php $cas_list = ["CAS Alba", "CAS Arad", "CAS Arges", "CAS Bacau", "CAS Bihor"," CAS Bistrita-Nasaud", "CAS Botosani", "CAS Brasov", "CAS Braila","CAS Buzau", 
	"CAS Caras-Severin", "CAS Calarasi", "CAS Cluj", "CAS Constanta", "CAS Covasna","CAS Bucuresti", "CAS Valcea","CAS Dambovita", "CAS Gorj", "CAS Galati","CAS Giurgiu",
	"CAS Harghita", "CAS Hunedoara", "CAS Ialomita", "CAS Maramures", "CAS Vaslui", "CAS Sector 6", "CAS Sector 2", "CAS Sector 1","CAS Sector 4", "CAS Sector 5"];?>
	<div class = "card" style="margin:50px 300px 300px 300px; width:1300px;opacity: 0.9;">
		<div class = "card-header" style="background-color:#0275d8;">
			<center><h2>Editare profil</h2><center>
	    </div>
		<div class="card-body" style="font-size:26; background-color: #ffd480">
			<form action="profilul_meu_pacient.php" method = "post" enctype="multipart/form-data">

				<?php
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				if(isset($_GET['pacient'])){
					$id =  $_GET['pacient'];
					$query = "SELECT * FROM pacienti WHERE id=$id";
					$results = mysqli_query($db, $query);
					if(mysqli_num_rows($results) > 0 ){
						while($row = mysqli_fetch_assoc($results)){
							$id_pacient=$row['id'];
							$last_name=$row['nume'];
							$first_name=$row['prenume'];
							$cnp=$row['cnp'];
							$adresa= $row['adresa'];
							$telefon= $row['telefon'];
							$grupa_sange=$row['grupa_sange'];
							$asigurat = $row['asigurat'];
                            $rh=$row['rh'];
							$denumire_cas=$row['denumire_cas'];
						}
						
						
					?>
					
				
				<div class="left">
					<span>Nume:</span>
					<span>Prenume:</span>
					<span>Cnp:</span>
					<span>Adresa:</span>
					<span>Telefon:</span>
					<span>Grupa Sange:</span>
					<span>Rh:</span>
					<span>Asigurat:</span>
					<span>Denumire CAS:</span>
					<span>Poza profil:</span>
					<span>Alergii:</span>
				</div>
				<div class="right">
					<input type="hidden" name="id_pacient" value=<?php echo $id_pacient;?> readonly="readonly">
					<input type="text" name="nume" value="<?php echo $last_name;?>">
					<input type="text" name="prenume" value="<?php echo $first_name;?>">
					<input type="text" name="cnp" value="<?php echo $cnp;?>">
					<input type="text" name="adresa" value="<?php echo $adresa;?>">
					<input type="text" name="telefon" value="<?php echo $telefon;?>">
					<select name="grupa_sange">
						  <option value="01" >01</option>
						  <option value="A2" >A2</option>
						  <option value="B3" >B3</option>
						  <option value="AB4" >AB4</option>
					</select>
					
					<input type="text" name="rh" value="<?php echo $rh;?>">
					<input type="text" name="asigurat" value="<?php echo $asigurat;?>">
					<select name="denumire_cas">
							<?php foreach ($cas_list as $cas){ ?>
						  <option value="<?php echo $cas; ?>" ><?php echo $cas?></option>
							<?php } ?>
					</select>	
					<input type="file" name="poza_profil" id="poza_profil" class="btn btn-info"  value="Selecteza fisier">
					<?php
					$query_allergies = "SELECT tip_alergie, data FROM alergii_intolerante WHERE id_pacient = $id";
					$results_allergies = mysqli_query($db, $query_allergies );?>
					<table style="width:100px;">
					<?php
					if(mysqli_num_rows($results) > 0 ){
						while($row_alergii = mysqli_fetch_assoc($results_allergies)){?>
						<tr>
							<td >
							<input style="width:400px;" type="text" name="tip_alergie" value="<?php echo $row_alergii['tip_alergie'];?>">
							</td>
							<td>
							<input type="date" style="width:200px;" name="data_alergie" value="<?php echo $row_alergii['data'];?>">
							</td>
						</tr>
					<?php }
					} ?>
					</table>
					
					<input type="submit" name = "update_profil" class="btn btn-success" style = " width: 100px;height:40px;text-align: center;"value = "Salvare">
				</div>
				<?php
				}
				}	
				?>
			</form>
		</div>
	</div>
</body>
</div>
</html>