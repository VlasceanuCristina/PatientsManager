<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Adaugare boala</title>
	<?php
		session_start();
		if(isset($_GET['files'])){
			$id_medic =  $_GET['files'][1];
			$id_pacient =  $_GET['files'][0];
			
			$files_add = array();
			$array_add = array($id_pacient,$id_medic);
			foreach ($array_add as $item){
			  $files_add[] ='files[]=' . $item;
			}
			$items_add = implode('&', $files_add);
			$_SESSION['date_identificare']=$items_add;
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
		<img src="profil.jpg" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
	
</head>
<style>
	.left, .right { width: 50%; float: left; }

	.left  { text-align: right; }
	.right { text-align: left;  }

	label, span, input, select { display: block; padding: 10px; margin: 10px; }

	label,span   { font-family: sans-serif; line-height: 20px; font-weight: bold; margin:10px 0px 20px 0px; }
	input  { width: 300px;            height: 53px;      box-sizing:border-box;margin:10px 0px 20px 0px; }
	select { width: 300px;            height: 53px;      box-sizing:border-box;margin:0px 0px 20px 0px;}
	</style>
<body style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">
<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
?>
<div class = "card"  style="margin:150px 300px 300px 300px; width:1000px;opacity:0.9;">
	<div class = "card-header" style="background-color:#0275d8;">
		<center><h2>Adăugare boală</h2><center>
	</div>
	<div class="card-body" style="font-size:26; background-color:#ccccb3;">
		<form method="post" action="adaugare_boala_action.php">
			<div class="left">
				<span>Denumire:</span>
				<span>Data:</span>
				<span>Tratament:</span>
			</div>
			<div class="right">
				<select name="denumire_boala">
							<?php $db = mysqli_connect('localhost', 'root', '', 'patients_manager');
								$query_vaccin="SELECT * FROM boli";
								$result=mysqli_query($db,$query_vaccin);
								while($row=mysqli_fetch_array($result))
							{ ?>
						  <option value="<?php echo $row['denumire_boala']; ?>" ><?php echo $row['denumire_boala'];?></option>
							<?php } ?>
						</select>
				<input type= "date" name = "data_boala"> 
				<input type= "text" name = "tratament">
				<?php if(isset($_GET['files'])){?>
				<input type="hidden" name="identificare" value=<?php echo $items_add;?>>
				<?php }?>
				<input type="submit" name = "adaugare_boala" class="btn btn-success" style = " width: 100px;height:40px;text-align: center;"value = "Adauga"/>		
			</div>
		</form>
	</div>
</div>
</body>