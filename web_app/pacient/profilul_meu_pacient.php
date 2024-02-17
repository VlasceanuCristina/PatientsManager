<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<html>
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
		elseif(isset($_POST['update_profil'])){
			  $id_pacient=$_POST['id_pacient'];
		}
		if(isset($_POST['update_profil'])){
			$nume= $_POST['nume'];
			$prenume = $_POST['prenume'];
		    $id_pacient=$_POST['id_pacient'];
			$telefon=$_POST['telefon'];
			$adresa=$_POST['adresa'];
			$rh=$_POST['rh'];
			$grupa_sange=$_POST['grupa_sange'];
			$asigurat=$_POST['asigurat'];
			$cnp=$_POST['cnp'];
			$cas=$_POST['denumire_cas'];
			$nume_poza= $_FILES['poza_profil']['name'];
			if(!file_exists($nume_poza)){
				$nume_poza='profil.jpg';
			}
			
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');			
			$query = "update pacienti SET nume='$nume',prenume='$prenume',telefon='$telefon',rh='$rh',grupa_sange='$grupa_sange',asigurat='$asigurat',denumire_cas='$cas',nume_poza='$nume_poza',cnp='$cnp' WHERE id=$id_pacient";
			mysqli_query($db,$query);
			 
			$tip_alergie=$_POST['tip_alergie'];
			$data_alergie=$_POST['data_alergie'];
			$query_allergies = "Update alergii_intolerante tip_alergie='$tip_alergie', data='$data_alergie'  ";
			$results_allergies = mysqli_query($db, $query_allergies );
			//partea cu poza
			$file_loc = $_FILES['poza_profil']['tmp_name'];
			 $file_size = $_FILES['poza_profil']['size'];
			 $file_type = $_FILES['poza_profil']['type'];
			 $folder="./";
			 
			 /* new file size in KB */
			 $new_size = $file_size/1024;  
			 /* new file size in KB */
			 
			 /* make file name in lower case */
			 $new_file_name = strtolower($nume_poza);
			 /* make file name in lower case */
			 
			 $final_file=str_replace(' ','-',$new_file_name);
			 move_uploaded_file($file_loc,$folder.$final_file);	
             //final poza			 
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
		<center><h2 style="color:#ffffff;font: italic bold 40px Georgia, serif;">Profilul meu</h2></center>
		</div>
		<a href="acasa_pacient.php?pacient=<?php echo $id_pacient;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasă</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
	<div class="card" style="background-color:#000;padding-top:15px;padding-bottom:15px;height:60px;">
	<span ><?php 
	
	   echo '<a class="btn btn-info bg-primary" style="margin-left:1410px;" href="editare_profil_pacient.php?pacient=' . $id_pacient . '" class="btn btn-success">Editare profil</a>';?></span>
	   
	</div>
</head>
<body>
	<div class="card flex-row flex-wrap" style="margin-top:30px;margin-left:200px;margin-right:200px;background-color:#ffd480;width:1200px;;height:600px;border-radius:15px;">
        <div class="card-header border-0" style="background-color:#ffd480;margin-top:20px;">
		<?php
		  $db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			 if(isset($_POST['update_profil'])){
				 $id_pacient=$_POST['id_pacient'];
			 }
			 else{
				$id_pacient = $_GET['pacient'];
			 }
			 
			$query_poza = "SELECT * FROM pacienti WHERE id = $id_pacient";
			$results_poza = mysqli_query($db, $query_poza);
			$row_poza= mysqli_fetch_array($results_poza);
			$nume_poza=$row_poza['nume_poza'];
		  ?>
		  
		  
            <img src="<?php echo $nume_poza ;?>" alt="" style="width:400px;height:310px;border-radius:10px;">
        </div>
        <div class="card-block px-2" style="">
            <h2  class="card-title" style="padding:20px 20px 20px 0px;color:black; font:italic bold  30px Georgia, serif;"><?php
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$query = "SELECT * FROM  pacienti WHERE id=$id_pacient";
			$results = mysqli_query($db, $query);
			
			if (mysqli_num_rows($results) == 1) {
				$row= mysqli_fetch_array($results);
				$nume= $row['nume'];
				$id_pacient=$row['id'];
				$prenume = $row['prenume'];
				echo $nume.' '.$prenume;
			}
			?></h2>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Data nasterii: </span><?php echo $row['data_nastere'];?></p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Cnp: </span><?php echo $row['cnp'];?></p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Adresa: </span><?php echo $row['adresa'];?></p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Telefon: </span><?php echo $row['telefon'];?></p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Email: </span><?php echo $row['email'];?></p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Grupa de sange: </span><?php echo $row['grupa_sange'];?></p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Rh: </span><?php echo $row['rh']?></p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Asigurat: </span><?php echo $row['asigurat'];?><p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Denumire CAS: </span><?php echo $row['denumire_cas'];?><p>
			<p><span style="color:black; font:italic bold  20px Georgia, serif;">Alergii/Intolerante:</span>
			<br>
				<?php
				$username = "";
				$email    = "";
				$errors = array(); 
				$_SESSION['success'] = "";
				
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				$query = "SELECT tip_alergie, data FROM alergii_intolerante WHERE id_pacient = $id_pacient";
				$results = mysqli_query($db, $query);
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){
						echo $row['tip_alergie'].' descoperita in data de '.$row['data'].'.';
						echo "<br>";
					}
				}
				?></p>
		
        </div>
        <div class="w-100"></div>
        
    </div>
</body>
</html>
</div>