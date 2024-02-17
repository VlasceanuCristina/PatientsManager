<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<?php
	
		if(isset($_GET['files'])){
			
			$id_medic =  $_GET['files'][1];
			$id_pacient =  $_GET['files'][0];
			
			$files_add = array();
			$array_add = array($id_pacient,$id_medic);
			foreach ($array_add as $item){
				$files_add[] ='files[]=' . $item;
			}
			$items_add = implode('&', $files_add);
			
			
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
			<a href="acasa_admin.php?admin=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
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
			<img src="profil.jfif" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:10px;">
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
	select { width: 400px;            height: 53px;      box-sizing:border-box;margin:0px 0px 20px 0px;}
	</style>
	<?php $cas_list = ["CAS Alba", "CAS Arad", "CAS Arges", "CAS Bacau", "CAS Bihor"," CAS Bistrita-Nasaud", "CAS Botosani", "CAS Brasov", "CAS Braila","CAS Buzau", 
	"CAS Caras-Severin", "CAS Calarasi", "CAS Cluj", "CAS Constanta", "CAS Covasna","CAS Bucuresti", "CAS Valcea","CAS Dambovita", "CAS Gorj", "CAS Galati","CAS Giurgiu",
	"CAS Harghita", "CAS Hunedoara", "CAS Ialomita", "CAS Maramures", "CAS Vaslui", "CAS Sector 6", "CAS Sector 2", "CAS Sector 1","CAS Sector 4", "CAS Sector 5"];?>
<body  style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">
	
	<div class = "card" style="margin:100px 300px 300px 400px; width:900px;borde-radius:20px; opacity: 0.9;">
		<div class = "card-header" style="background-color:#0275d8;">
			<center><h2>Editare pacient-informații generale</h2><center>
	    </div>
		<div class="card-body" style="font-size:26; background-color: #ccccb3">
			<form action="action_edit_patient.php" method = "post">

				<?php
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				if(isset($_GET['files'])){
					$id =  $_GET['files'][0];
					$query = "SELECT* FROM pacienti WHERE id=$id";
					$results = mysqli_query($db, $query);
					if(mysqli_num_rows($results) > 0 ){
						while($row = mysqli_fetch_assoc($results)){
							$id=$row['id'];
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
			    
				$query_allergies = "SELECT tip_alergie, data FROM alergii_intolerante WHERE id_pacient = $id";
				$results_allergies = mysqli_query($db, $query);
				?>
				<div class="left">
					<span>ID:</span>
					<span>Nume:</span>
					<span>Prenume:</span>
					<span>Cnp:</span>
					<span>Adresa:</span>
					<span>Telefon:</span>
					<span>Grupa Sange:</span>
					<span>Rh:</span>
					<span>Asigurat:</span>
					<span>Denumire CAS:</span>
				</div>
				<div class="right">
					<input type="text" name="id_pacient" value=<?php echo $id;?> readonly="readonly">
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
					
					<input type="hidden" name="id_medic" value="<?php echo $id_medic;?>">
					<input type="submit" class="btn btn-success btn-lg" name="update_patient" value="Salvare">
				</div>
				<?php
				}
				}
				//header("Location:afisare_pacienti.php");				
				?>
			</form>
		</div>
	</div>
</body>