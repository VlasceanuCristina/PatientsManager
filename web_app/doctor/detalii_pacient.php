<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Detalii pacient</title>
	<!--<div class = "card">
		<div class = "card-body" style = "background-color:#3498DB; color:#ffffff;font: italic bold 40px Georgia, serif">
			<center><h2>
			
			</h2><center>
		</div>
	</div>-->

	<script>
	function goBack() {
	  window.history.back()
	}
	function goForward() {
      window.history.forward();
	}
	</script>
	
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1050px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;"> 
		<?php
			$username = "";
			$email    = "";
			$errors = array(); 
			$_SESSION['success'] = "";

			// connect to database
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$_param = $_GET['files'];
			$identif=$_param[0];
			$id_medic=$_param[1];
			$query = "SELECT nume, prenume, cnp FROM pacienti where id = $identif";
			$results = mysqli_query($db, $query);
			if(mysqli_num_rows($results) > 0 ){
				while($row = mysqli_fetch_assoc($results)){
					echo $row['nume']." ".$row['prenume'];
				}
			}
			
			$files = array();
			$array1 = array($identif,$id_medic);
			foreach ($array1 as $item){
			  $files[] ='files[]=' . $item;
			}
			$items = implode('&', $files);
		
			$query = "SELECT * FROM medici where id = $id_medic";
			$results = mysqli_query($db, $query);
			$row_medic = mysqli_fetch_assoc($results);
			$prenume=$row_medic['prenume'];
			$nume_poza=$row_medic['nume_poza'];
			?>
		
		
		</span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>




	
</head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
</style>
<body style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">
	<ul style="padding-top:15px;padding-bottom:15px;">
		<?php// $_param = $_GET['files'];
		//$id_medic=$_param[1];
		//$identif=$_param[0];
		//$identif = $_GET['subject'];?>
		<li><a href="" class="btn btn-info bg-primary" style="margin-right:10px;">Informații generale</a></li>
		<li><?php echo '<a class="btn btn-info bg-primary" style="margin-right:10px;" href="pacient_boli.php?' . $items . '">Istoric boli</a>' ;?></li>
		<li><?php echo '<a class="btn btn-info bg-primary" style="margin-right:10px;" href="pacient_internari.php?' . $items . '">Istoric internări</a>'; ?></li>
		<li><?php echo '<a class="btn btn-info bg-primary" style="margin-right:10px;" href="pacient_parametri.php?' . $items . '">Istoric parametri</a>'; ?></li>
		<li><?php echo '<a class="btn btn-info bg-primary" style="margin-right:10px;" href="interventii_chirurgicale.php?' . $items . '">Intervenții chirurgicale</a>'; ?></li>
		<li><?php echo '<a class="btn btn-info bg-primary" style="margin-right:10px;" href="pacient_vaccinuri.php?' . $items . '">Vaccinuri</a>'; ?></li>
		<li><?php echo '<a class="btn btn-info bg-primary" style="margin-right:10px;" href="analize.php?' . $items . '">Analize</a>'; ?></li>
		<li><?php
			$files = array();
			$array1 = array($identif,$id_medic);
			foreach ($array1 as $item){
			  $files[] ='files[]=' . $item;
			}
			$items = implode('&', $files);
			echo '<a class="btn btn-info bg-primary" style="margin-right:10px;" href="pacient_consultatii.php?' . $items . '" >Consultații</a>';
								
			?></li>
	</ul>
	<div class="container-fluid" style="padding:50px 400px 50px 300px;opacity: 0.9;" >
		<div class="card" style="background-color:#ff794d;padding:20px 0px 20px 40px;border-radius:20px;">
			<div class="card-body" style=" color:black;font: italic bold  16px Georgia, serif;">
				<h5 class="card-title" style ="font: italic bold  30px Georgia, serif;color:black">Informații generale</h5>
				<?php
				$username = "";
				$email    = "";
				$errors = array(); 
				$_SESSION['success'] = "";

				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				//$identif = $_GET['subject'];
				$query = "SELECT id, nume, prenume, cnp, data_nastere, adresa, telefon, email, asigurat,denumire_cas, grupa_sange,rh, data_inscriere  FROM pacienti where id = $identif";
				$results = mysqli_query($db, $query);
				
				if(mysqli_num_rows($results) > 0 ){
					$row = mysqli_fetch_assoc($results);		
				}
				$id = $row['id'];
				?>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Data nașterii: </span><?php echo $row['data_nastere'];?></p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Cnp: </span><?php echo $row['cnp'];?></p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Adresa: </span><?php echo $row['adresa'];?></p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Telefon: </span><?php echo $row['telefon'];?></p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Email: </span><?php echo $row['email'];?></p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Grupa de sânge: </span><?php echo $row['grupa_sange'];?></p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Rh: </span><?php echo $row['rh']?></p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Asigurat: </span><?php echo $row['asigurat'];?><p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Denumire CAS: </span><?php echo $row['denumire_cas'];?><p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Data înscriere: </span><?php echo $row['data_inscriere'];?><p>
				<p><span style="color:black; font:italic bold  20px Georgia, serif;">Alergii/Intoleranțe:</span>
				<br>
				<?php
				$username = "";
				$email    = "";
				$errors = array(); 
				$_SESSION['success'] = "";
				
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				$query = "SELECT tip_alergie, data FROM alergii_intolerante WHERE id_pacient = $id";
				$results = mysqli_query($db, $query);
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){
						echo $row['tip_alergie'].' descoperita in data de '.$row['data'].'.';
						echo "<br>";
					}
				}
				?></p>
			</div>
		</div>
	<div>
</body>
</div>