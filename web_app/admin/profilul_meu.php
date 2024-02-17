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
		if(isset($_GET['admin'])){
			$id_admin =  $_GET['admin'];
			$_SESSION['id_admin']=$id_admin;
		}
		elseif(isset($_POST['update_profil'])){
			  $id_admin=$_POST['id_admin'];
		}
		if(isset($_POST['update_profil'])){
			$nume= $_POST['nume'];
			$prenume = $_POST['prenume'];
		    $id_admin=$_POST['id_admin'];
			$telefon=$_POST['telefon'];
			$email=$_POST['email'];
			$nume_poza= $_FILES['poza_profil']['name'];
			if(!file_exists($nume_poza)){
				$nume_poza='profil.jfif';
			}
			
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');			
			$query = "update administratori SET nume='$nume',prenume='$prenume',telefon='$telefon',email='$email',nume_poza='$nume_poza' WHERE id=$id_admin";
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
		 $query1 = "SELECT * FROM administratori WHERE id = $id_admin";
		 $results1 = mysqli_query($db, $query1);
		$row1= mysqli_fetch_array($results1);
		$prenume=$row1['prenume'];
		$poza_profil=$row1['nume_poza'];
		
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
		<a href="acasa_admin.php?admin=<?php echo $id_admin;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasă</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $poza_profil; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
	<div class="card" style="background-color:#000;padding-top:15px;padding-bottom:15px;height:60px;">
	<span ><?php 
	
	   echo '<a class="btn btn-info bg-primary" style="margin-left:1410px;" href="editare_profil.php?admin=' . $id_admin . '" class="btn btn-success">Editare profil</a>';?></span>
	</div>
</head>
<body>
	<div class="card flex-row flex-wrap" style="margin-top:30px;margin-left:200px;margin-right:200px;background-color:#ffd480;width:1200px;;height:600px;border-radius:15px;">
        <div class="card-header border-0" style="background-color:#ffd480;margin-top:20px;">
		<?php
		  $db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			 if(isset($_POST['update_profil'])){
				 $id_admin=$_POST['id_admin'];
			 }
			 else{
				$id_admin = $_GET['admin'];
			 }
			 
			$query_poza = "SELECT * FROM administratori WHERE id = $id_admin";
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
				 $id_admin=$_POST['id_admin'];
			 }
			 else{
				$id_admin = $_GET['admin'];
			 }
			 
			$query = "SELECT * FROM administratori WHERE id = $id_admin";
			$results = mysqli_query($db, $query);
			
			if (mysqli_num_rows($results) == 1) {
				$row= mysqli_fetch_array($results);
				$nume= $row['nume'];
				$prenume = $row['prenume'];
				echo $nume.' '.$prenume;
				$id_admin=$row['id'];
				$telefon=$row['telefon'];
				$email=$row['email'];

			}
			?></h4>
			
			<p><h6>Telefon: <?php echo $telefon;?></p>
			<p>Email: <?php echo $email;?></p>
			</h6></p>
			
        </div>
        <div class="w-100"></div>
        
    </div>
</body>
</div>
</html>