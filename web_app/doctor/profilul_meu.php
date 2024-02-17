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
		elseif(isset($_POST['update_profil'])){
			  $id_medic=$_POST['id_medic'];
		}
		if(isset($_POST['update_profil'])){
			$nume= $_POST['nume'];
			$prenume = $_POST['prenume'];
		    $id_medic=$_POST['id_medic'];
			$telefon=$_POST['telefon'];
			$cod_parafa=$_POST['cod_parafa'];
			$email=$_POST['email'];
			$nr_contract=$_POST['nr_contract'];
			$cas=$_POST['denumire_cas'];
			$cnp=$_POST['cnp'];
			$nume_poza= $_FILES['poza_profil']['name'];
			if(!file_exists($nume_poza)){
				$nume_poza='profil_diana.jpg';
			}
			
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');			
			$query = "update medici SET nume='$nume',prenume='$prenume',telefon='$telefon',email='$email',cod_parafa='$cod_parafa',nr_contract_cas='$nr_contract',denumire_cas='$cas',nume_poza='$nume_poza',cnp_medic='$cnp' WHERE id=$id_medic";
			mysqli_query($db,$query);
			 
			$denumire_cabinet=$_POST['denumire_cabinet'];
			$adresa_cabinet=$_POST['adresa_cabinet'];
			$query = "update cabinete SET denumire_cabinet='$denumire_cabinet',adresa_cabinet='$adresa_cabinet' WHERE id_medic=$id_medic";
			mysqli_query($db,$query);
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
		<center><h2 style="color:#ffffff;font: italic bold 40px Georgia, serif;">Profilul meu</h2></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasă</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza ;?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
	<div class="card" style="background-color:#000;padding-top:15px;padding-bottom:15px;height:60px;">
	<span ><?php 
	
	   echo '<a class="btn btn-info bg-primary" style="margin-left:1410px;" href="editare_profil.php?medic=' . $id_medic . '" class="btn btn-success">Editare profil</a>';?></span>
	</div>
</head>
<body>
	<div class="card flex-row flex-wrap" style="margin-top:30px;margin-left:200px;margin-right:200px;background-color:#ffd480;width:1200px;;height:600px;border-radius:15px;">
        <div class="card-header border-0" style="background-color:#ffd480;margin-top:20px;">
		<?php
		  $db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			 if(isset($_POST['update_profil'])){
				 $id_medic=$_POST['id_medic'];
			 }
			 else{
				$id_medic = $_GET['medic'];
			 }
			 
			$query_poza = "SELECT * FROM medici WHERE id = $id_medic";
			$results_poza = mysqli_query($db, $query_poza);
			$row_poza= mysqli_fetch_array($results_poza);
			$nume_poza=$row_poza['nume_poza'];
		  
		  ?>
		  
            <img src="<?php echo $nume_poza ;?>" alt="" style="width:400px;height:310px;border-radius:10px;">
        </div>
        <div class="card-block px-2">
            <h4 class="card-title" style="padding:20px 20px 20px 0px;"><?php
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			 if(isset($_POST['update_profil'])){
				 $id_medic=$_POST['id_medic'];
			 }
			 else{
				$id_medic = $_GET['medic'];
			 }
			 
			$query = "SELECT * FROM medici WHERE id = $id_medic";
			$results = mysqli_query($db, $query);
			
			if (mysqli_num_rows($results) == 1) {
				$row= mysqli_fetch_array($results);
				$nume= $row['nume'];
				$prenume = $row['prenume'];
				echo $nume.' '.$prenume;
				$id_medic=$row['id'];
				$telefon=$row['telefon'];
				$cod_parafa=$row['cod_parafa'];
				$email=$row['email'];
				$nr_contract=$row['nr_contract_cas'];
				$cas=$row['denumire_cas'];
				$cnp=$row['cnp_medic'];
			}
			$query = "SELECT * FROM cabinete WHERE id_medic = '$id_medic'";
			$results = mysqli_query($db, $query);
			
			if (mysqli_num_rows($results) == 1) {
				$row= mysqli_fetch_array($results);
				$denumire_cabinet=$row['denumire_cabinet'];
				$adresa_cabinet=$row['adresa_cabinet'];
			}
			?></h4>
			
			<p><h6>Telefon: <?php echo $telefon;?></p>
			<p>Email: <?php echo $email;?></p>
			<p>Denumire cabinet: <?php echo $denumire_cabinet;?></p>
			<p>Adresa cabinet: <?php echo $adresa_cabinet;?></p>
			<p>Cod parafa: <?php echo $cod_parafa;?></p>
			<p>CNP: <?php echo $cnp;?></p>
			<p>Nr. contract CAS: <?php echo $nr_contract;?></p>
			<p>Denumire CAS: <?php echo $cas;?>
			</h6></p>
			
        </div>
        <div class="w-100"></div>
        
    </div>
</body>
</div>
</html>