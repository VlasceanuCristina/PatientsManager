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
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;"> Raport încasări</span></center>
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
		<img src="<?php echo $nume_poza;?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>		
			<!--<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>-->	
	
	
		<div class="container mb-3 mt-3">
			<table class="table table-striped table-bordered mydatatable" style="width:100%; ">
				<thead>
					<tr>
					  <th scope="col">Nr.crt.</th>
					  <th scope="col" style="width:100px;">Luna</th>
					  <th scope="col">Nr. total consultații</th>
					  <th scope="col">Nr.consultații pacienți asigurați</th>
					  <th scope="col">Total încasări(lei)</th>
					  <th scope="col">Sume decontate(lei)</th>
					 
					</tr>
				</thead>
				<tbody>
				<?php
				
				$date=date('Y-m-d');
				
				// connect to database
				$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
				$query = "SELECT * from incasari where id_medic=$id_medic";
				$results = mysqli_query($db, $query);
				$i=0;
				if(mysqli_num_rows($results) > 0 ){
					while($row = mysqli_fetch_assoc($results)){?>
						<tr>
							<td><?php $i=$i+1; echo $i;?></td>
							<td><?php echo $row['luna'];?></td>
							<td><?php echo $row['total_consultatii'];?></td>
							<td><?php echo $row['total_asigurati'];?></td>
							<td><?php echo $row['incasari'];?></td>
							<td><?php echo $row['sume_decontate'];?></td>
						</tr>
				<?php	} 
				}				
				?>
				
				</tbody>
				
			</table>
		</div>
	<?php
	function redenumire_luna($monthName){
		if($monthName=='January')
		$monthNameRO='Ianuarie';
	elseif($monthName=='February')
		$monthNameRO='Februarie';
	elseif($monthName=='March')
		$monthNameRO='Martie';
	elseif($monthName=='April')
		$monthNameRO='Aprilie';
	elseif($monthName=='May')
		$monthNameRO='Mai';
	elseif($monthName=='June')
		$monthNameRO='Iunie';
	elseif($monthName=='July')
		$monthNameRO='Iulie';
	elseif($monthName=='August')
		$monthNameRO='August';
	elseif($monthName=='September')
		$monthNameRO='Septembrie';
	elseif($monthName=='October')
		$monthNameRO='Octombrie';
	elseif($monthName=='November')
		$monthNameRO='Noiembrie';
	else
		$monthNameRO='Decembrie';
	return $monthNameRO;
	}
	$total_consultatii=0;
	$total_asigurati=0;
	$incasari=0;
	$sume_decontate=0;
	$suma_totala =0;
	$query_consultatii = "SELECT * from consultatii C, pacienti P WHERE P.id_medic=$id_medic AND C.id_pacient=P.id";
	$results_consultatii = mysqli_query($db, $query_consultatii);
	while($row_consultatii = mysqli_fetch_assoc($results_consultatii)){
		
		$date1=date("m", strtotime($row_consultatii['data']));
		$date2=date("m");
		//echo $date1.' '.$date2;
		if($date1 == $date2){
			
			$total_consultatii=$total_consultatii+1;
			$suma_totala=$suma_totala+$row_consultatii['pret'];
			if($row_consultatii['asigurat']=="DA"){
				$total_asigurati=$total_asigurati+1;
				$sume_decontate=$sume_decontate+$row_consultatii['pret'];
			}
		}
	}
	$incasari=$suma_totala - $sume_decontate;
	
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
					$an=strtolower(date("Y",strtotime($t)));
					$firstDayOfMonth = mktime(0,0,0,$luna,1,2020);
					$numberDays = date('t',$firstDayOfMonth);
					$dateComponents= getdate($firstDayOfMonth);
					$monthName = $dateComponents['month'];
					$month=redenumire_luna($monthName);
					$month1=$month.' '.$an;					
					$query = "INSERT into incasari(luna,total_consultatii, total_asigurati, incasari,sume_decontate,id_medic) 
					VALUES('$month1',$total_consultatii, $total_asigurati, $incasari,$sume_decontate,$id_medic)";
					$res=mysqli_query($db, $query);
					
					
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