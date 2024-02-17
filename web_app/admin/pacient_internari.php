<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Istoric internari</title>
	<script>
	function goBack() {
	  window.history.back()
	}
	function goForward() {
      window.history.forward();
	}
	</script>
	
	<?php 
	session_start();
	if(isset($_GET['files'])){
		$param = $_GET['files'];
		$id_pacient=$param[0];
		$id_medic=$param[1];
	}
	else
	{
		$id_pacient=$_SESSION['id_pacient'];
		$id_medic=$_SESSION['id_medic'];
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$query = "SELECT * FROM administratori WHERE id = $id_medic ";
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_array($results);
	$prenume = $row['prenume'];
	?>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1050px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;">Istoric internari</span></center>
		</div>
		<a href="acasa_admin.php?admin=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="profil.jfif" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>
	
</head>
<body>
<body style="background-image:url('sfat.jpg');background-repeat:no-repeat;background-size:cover;">
	<div class="container mb-3 mt-3">
	<table class="table table-striped table-bordered mydatatable" style="width:100%; background-color:#ff794d;opacity: 0.9;">
	<thead>
		<tr>
		  <th scope="col">Nr.crt.</th>
		  <th scope="col">Data_internare</th>
		  <th scope="col">Data_externare</th>
		  <th scope="col">Diagnostic internare</th>
		  <th scope="col">Diagnostic externare</th>
		  <th scope="col">Denumire spital</th>
		  <th scope="col">Tratament</th>
		</tr>
	</thead>
	<tbody>
		<?php
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				
				if(isset($_POST['update_internari'])){
					$id_pacient = $_SESSION['id_pacient'];
					$id_internare=$_POST['id_internare'];
					$data_internare = $_POST['data_internare'];
					$data_externare=$_POST['data_externare'];
					$diagnostic_internare=$_POST['diagnostic_internare'];
					$diagnostic_externare=$_POST['diagnostic_externare'];
					$query_update = "UPDATE internari SET data_internare='$data_internare', data_externare='$data_externare',diagnostic_internare='$diagnostic_internare',diagnostic_externare='$diagnostic_externare' WHERE id= $id_internare;";
					$results_update = mysqli_query($db, $query_update);
					$query = "SELECT id,data_internare, data_externare,diagnostic_internare, diagnostic_externare,spital FROM internari WHERE id_pacient = $id_pacient ";
					$results = mysqli_query($db, $query);
					if(mysqli_num_rows($results) > 0 ){
						while($row = mysqli_fetch_assoc($results)){?>
							<tr>
								<td><?php echo $row['id'];?></td>
								<td><?php echo $row['data_internare'];?></td>
								<td><?php echo $row['data_externare'];?></td>
								<td><?php echo $row['diagnostic_internare'];?></td>
								<td><?php echo $row['diagnostic_externare'];?></td>
								<td><?php echo $row['spital'];?></td>
								<td><?php echo $row['tratament'];?></td>
							</tr>
					<?php
						}
					}	
				}
				else{
				$param = $_GET['files'];
				$id_pacient=$param[0];
				$id_medic=$param[1];
				$_SESSION['id_medic']=$id_medic;
				$_SESSION['id_pacient']=$id_pacient;
				$query = "SELECT id,data_internare, data_externare,diagnostic_internare, diagnostic_externare,spital,tratament FROM internari WHERE id_pacient = $id_pacient ";
				$results = mysqli_query($db, $query);
				$i=0;
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){?>
						<tr>
							<td><?php $i=$i+1;echo $i;?></td>
							<td><?php echo $row['data_internare'];?></td>
							<td><?php echo $row['data_externare'];?></td>
							<td><?php echo $row['diagnostic_internare'];?></td>
							<td><?php echo $row['diagnostic_externare'];?></td>
							<td><?php echo $row['spital'];?></td>
							<td><?php echo $row['tratament'];?></td>
							</tr>
				<?php
				}
				}
				}?>
	
	</tbody>
</table>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<script>
		$('.mydatatable').DataTable();
	</script>
</body>
</div>