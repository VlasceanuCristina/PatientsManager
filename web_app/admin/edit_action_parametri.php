<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<?php
	
		if(isset($_GET['files'])){
			$id_parametru =  $_GET['files'][0];
			$id_medic =  $_GET['files'][2];
			$id_pacient =  $_GET['files'][1];
			
			$files_add = array();
			$array_add = array($id_pacient,$id_medic);
			foreach ($array_add as $item){
				$files_add[] ='files[]=' . $item;
			}
			$items_add = implode('&', $files_add);
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			
			$query = "SELECT * FROM medici WHERE id = $id_medic ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$prenume = $row['prenume'];
			
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
			<?php if(isset($_GET['files'])){ echo '<a href="pacient_parametri.php?' . $items_add . '"class="btn btn-info" style="background-color:white;color:blue;" >Înapoi</a>';}?>
			<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
			<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
			<img src="profil.jpg" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
			
		</nav>
	
	
<head>
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


<body style="background-image:url('pacient2.jpg');background-repeat:no-repeat;background-size:cover;">
	<div class = "card" style="margin:100px 300px 300px 400px; width:800px;opacity: 0.9;"">
		<div class = "card-header" style="background-color:#0275d8;">
			<center><h2>Editare parametri</h2><center>
	    </div>
		<div class="card-body" style="font-size:26; background-color:#ccccb3;">
			<form action="pacient_parametri.php" method = "post">

				<?php
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				if(isset($_GET['files'])){
					$id_parametru =  $_GET['files'][0];
					$query = "SELECT id,puls,tensiune,greutate,inaltime, data FROM parametri WHERE id=$id_parametru ";
					$results = mysqli_query($db, $query);
					if(mysqli_num_rows($results) > 0 ){
						while($row = mysqli_fetch_assoc($results)){
							$id=$row['id'];
							$puls=$row['puls'];
							$tensiune=$row['tensiune'];
							$greutate=$row['greutate'];
							$inaltime=$row['inaltime'];
							$data=$row['data'];
						}
				?>
				<div class="left">
					<span >ID:</span>
					<span>Puls:</span>
					<span >Tensiune:</span>
					<span>Greutate:</span>
					<span>Inaltime:</span>
					<span>Data:</span>
				</div>
				<div class="right">
					<input type="text" name="id_parametru" value=<?php echo $id;?> readonly="readonly">	
					<input type="text" name="puls" value=<?php echo $puls;?>>
					<input type="text" name="tensiune" value=<?php echo $tensiune;?>>
					<input type="text" name="greutate" value=<?php echo $greutate;?>>
					<input type="text" name="inaltime" value=<?php echo $inaltime;?>>
					<input style="height:53px" type="date" name="data" value=<?php echo $data;?>>
					<input type="submit" class="btn btn-success btn-lg" name="update_parametri" value="Salvare">
				</div>
				<?php
				}
				}	
				?>
			</form>
		</div>
	</div>
</body>