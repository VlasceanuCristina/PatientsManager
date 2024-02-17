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
		if(isset($_GET['medic'])){
			$id_medic =  $_GET['medic'];
			$_SESSION['id_medic']=$id_medic;
		}
		 $db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		 $query1 = "SELECT * FROM medici WHERE id = $id_medic";
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
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasă</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
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
	select { width: 600px;            height: 53px;      box-sizing:border-box;margin:0px 0px 20px 0px;}
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
			<form action="profilul_meu.php" method = "post" enctype="multipart/form-data">

				<?php
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				if(isset($_GET['medic'])){
					$id =  $_GET['medic'];
					$query = "SELECT * FROM medici WHERE id=$id";
					$results = mysqli_query($db, $query);
					if(mysqli_num_rows($results) > 0 ){
						while($row = mysqli_fetch_assoc($results)){
							$id_medic=$row['id'];
							$telefon=$row['telefon'];
							$cod_parafa=$row['cod_parafa'];
							$email=$row['email'];
							$nr_contract=$row['nr_contract_cas'];
							$cas=$row['denumire_cas'];
							$cnp=$row['cnp_medic'];
							$nume= $row['nume'];
							$prenume = $row['prenume'];
						}
						
						
					$query = "SELECT * FROM cabinete WHERE id_medic = '$id_medic'";
					$results = mysqli_query($db, $query);
					
					if (mysqli_num_rows($results) > 0) {
						$row= mysqli_fetch_array($results);
						$denumire_cabinet = $row['denumire_cabinet'];
						$adresa_cabinet = $row['adresa_cabinet'];
						
					}
				?>
				<div class="left">
					<span>Nume:</span>
					<span >Prenume:</span>
					<span >Email:</span>
					<span >Denumire cabinet:</span>
					<span >Adresa cabinet:</span>
					<span >Cod parafă:</span>
					<span >CNP:</span>
					<span >Telefon:</span>
					<span >Nr.contract CAS:</span>
					<span >Denumire CAS:</span>
					<span >Poză profil:</span>
					
				</div>
				<div class="right">
					<input type="text" name="nume" value="<?php echo $nume;?>">
					<input type="text" name="prenume" value="<?php echo $prenume;?>">
					<input type="text" name="email" value="<?php echo $email;?>">
					<input type="text" name="denumire_cabinet" value="<?php echo $denumire_cabinet;?>">
					<input type="text" name="adresa_cabinet" value="<?php echo $adresa_cabinet;?>">
					<input type="text" name="cod_parafa" value="<?php echo $cod_parafa;?>">
					<input type="text" name="cnp" value="<?php echo $cnp;?>">
					<input type="text" name="telefon" value="<?php echo $telefon;?>">
					<input type="text" name="nr_contract" value="<?php echo $nr_contract;?>">
					<select name="denumire_cas">
							<?php foreach ($cas_list as $cas){ ?>
						  <option value="<?php echo $cas; ?>" ><?php echo $cas?></option>
							<?php } ?>
					</select>
					<input type="file" name="poza_profil" id="poza_profil" class="btn btn-info"  value="Selecteza fisier">
					<input type="hidden" name="id_medic" value="<?php echo $id_medic;?>" >
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