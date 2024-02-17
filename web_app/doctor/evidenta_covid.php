<!DOCTYPE html>
<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script type="text/javascript">
		function openNav(){
			$(".sidebar").toggleClass('is-active');
		}
	</script>
	
	<script>
	function goBack() {
	  window.history.back()
	}
	function goForward() {
      window.history.forward();
	}
	</script>	
	<style>
	@media (min-width:848px) {
  html {
    overflow-x: auto; 
    overflow-y: auto;
  }
}
	</style>
</head>	

<body >
    <?php $id_medic=$_GET['medic'];?>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1050px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;"> Evidență COVID-19</span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<?php 
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$id = $_GET['medic'];
			$query = "SELECT * FROM medici WHERE id = $id ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$nume= $row['nume'];
			$prenume = $row['prenume'];
			$nume_poza=$row['nume_poza'];
			?>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>		
			<!--<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>-->	
	
	
		<div class="container mb-3 mt-3">
			<table class="table table-striped table-bordered mydatatable" style="width:100%; ">
				<thead>
					<tr>
					  <th scope="col">Nr.crt.</th>
					  <th scope="col">Luna</th>
					  <th scope="col">Nr. total cazuri infectati</th>
					  <th scope="col">Nr. cazuri noi infectati</th>
					  <th scope="col">Nr. total cazuri vindecati</th>
					  <th scope="col">Nr. cazuri noi vindecati</th>
					  <th scope="col">Nr. total cazuri carantina</th>
					  <th scope="col">Nr. cazuri noi carantina</th>
					  
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				$date=date('Y-m-d');
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				
				
				
				$query = "SELECT * from evidenta_covid where id_medic=$id";
				$results = mysqli_query($db, $query);
				if(mysqli_num_rows($results)>0){
					while($row = mysqli_fetch_assoc($results)){?>
						<tr>
							<td><?php $i=$i+1; echo $i;?></td>
							<td><?php echo $row['luna'];?></td>
							<td><?php echo $row['cazuri_infectati_total'];?></td>
							<td><?php echo $row['cazuri_infectati_noi'];?></td>
							<td><?php echo $row['cazuri_videcati_total'];?></td>
							<td><?php echo $row['cazuri_vindecati_noi'];?></td>
							<td><?php echo $row['carantina_total'];?></td>
							<td><?php echo $row['carantina_noi'];?></td>
							
							
						</tr>
				<?php	} 
				}				
				?>
				
				</tbody>
				
			</table>
		</div>
	
	
	<?php
	$cazuri_infectati_total=0;
	$cazuri_infectati_noi=0;
	$cazuri_vindecati_noi=0;
	$cazuri_vindecati_total=0;
	$cazuri_carantina_noi=0;
	$cazuri_carantina_total=0;
	 $t=date('d-m-Y');
            $day = strtolower(date("D",strtotime($t)));
            $month = strtolower(date("m",strtotime($t)));
            $dayNum = strtolower(date("d",strtotime($t)));
            $weekno = floor(($dayNum - 1) / 7) + 1;

            if($weekno=="4" or $weekno=="5")
            {
                $Date = date("d-m-Y");
                $new_month = date('m', strtotime($Date. ' + 7 days'));
                if($new_month != $month)
                {
                    $luna=strtolower(date("m",strtotime($t)));
					$query = "INSERT into evidenta_covid(luna,cazuri_infectati_total, cazuri_infectati_noi, cazuri_videcati_total,cazuri_vindecati_noi, carantina_total, carantina_noi) 
					VALUES($luna,$cazuri_infectati_total,$cazuri_infectati_noi,$cazuri_vindecati_total,$cazuri_carantina_noi,$cazuri_carantina_total) where id_medic=$id_medic";
					$results = mysqli_query($db, $query);
					
                }
            }

	
	?>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$('.mydatatable').DataTable();
	</script>	
</body>
</div>
</html>