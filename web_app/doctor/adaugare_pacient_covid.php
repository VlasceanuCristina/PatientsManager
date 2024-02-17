<html>
	<head>
		<title>Adaugare pacient</title>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<?php
		session_start();
		if(isset($_GET['medic'])){
			$id_medic =  $_GET['medic'];
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$id = $_GET['medic'];
			$query = "SELECT * FROM medici WHERE id = $id ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$nume= $row['nume'];
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
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
	
	</head>
	<style>
	body {color: black; background-image: url('pacient_fundal.jpg'); }

	.left, .right { width: 50%; float: left; }

	.left  { text-align: right; }
	.right { text-align: left;  }

	label, span, input, select { display: block; padding: 10px; margin: 10px; }

	label,span   { font-family: sans-serif; line-height: 20px; font-weight: bold; margin:10px 0px 20px 0px; }
	input  { width: 300px;            height: 40px;      box-sizing:border-box;margin:10px 0px 20px 0px; }
	select { width: 300px;            height: 53px;      box-sizing:border-box;margin:0px 0px 20px 0px;}
	</style>
	<?php $cas_list = ["CAS Alba", "CAS Arad", "CAS Arges", "CAS Bacau", "CAS Bihor"," CAS Bistrita-Nasaud", "CAS Botosani", "CAS Brasov", "CAS Braila","CAS Buzau", 
	"CAS Caras-Severin", "CAS Calarasi", "CAS Cluj", "CAS Constanta", "CAS Covasna","CAS Bucuresti", "CAS Valcea","CAS Dambovita", "CAS Gorj", "CAS Galati","CAS Giurgiu",
	"CAS Harghita", "CAS Hunedoara", "CAS Ialomita", "CAS Maramures", "CAS Vaslui", "CAS Sector 6", "CAS Sector 2", "CAS Sector 1","CAS Sector 4", "CAS Sector 5"];?>
	<body style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">

		<div class = "card" style="margin:150px 300px 300px 300px; width:1000px;opacity:0.9;">
			<div class="card-header" style="background-color:#0275d8;">
				<center><span style="font-size:30px;font-family:serif;">Adaugare pacient</span></center>
			</div>
			<div class = "card-body" style="font-size:26; background-color:#ccccb3;">
				<form action = "inserare_pacient_covid.php" method = "post">
					<div class="left">
						<span>Nume pacient:</span>
						<span>Prenume pacient:</span>
						<span>Stadiu:</span>
						<span>Data infectarii:</span>
						
								
					</div>
					<div class="right">
						<?php $db = mysqli_connect('localhost', 'root', '', 'patients_manager');
							$query_total = "SELECT  nume,prenume FROM pacienti ";	
							$results = mysqli_query($db, $query_total);?>
							<select name="nume">
							<?php	if(mysqli_num_rows($results)>0){
									while($row = mysqli_fetch_assoc($results)){?>
									<option value="<?php echo $row['nume'];?>" ><?php echo $row['nume'];?></option>
							<?php
							}
							}
							?>
							</select>
							
							<select name="prenume">
							<?php
							$query_total = "SELECT  nume,prenume FROM pacienti ";	
							$results = mysqli_query($db, $query_total);?>
							<?php	if(mysqli_num_rows($results)>0){
									while($row = mysqli_fetch_assoc($results)){?>
									<option value="<?php echo $row['prenume'];?>" ><?php echo $row['prenume'];?></option>
							<?php
							}
							}
							?>
							</select>
							
						<select name="stadiu">
						  <option value="infectat" >infectat</option>
						  <option value="carantina" >carantina</option>
						  <option value="vindecat" >vindecat</option>
						  <option value="decedat" >decedat</option>
						</select>
						<input type= "date" name = "data_infectare" >
						<input type="hidden" name="id_medic" value="<?php echo $id_medic;?>" >
						<input type="submit" name = "submit" class="btn btn-success" style = " width: 100px;height:40px;text-align: center;"value = "Salvare">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
