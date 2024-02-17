<?php
///////////am adaugat eu 
///cel din pacienti

function timeslots($duration, $cleanup, $start, $end){
	$start = new DateTime($start);
	$end = new DateTime($end);
	$interval = new DateInterval("PT".$duration."M");
	$cleanupInterval = new DateInterval("PT".$cleanup."M");
	$slots = array();
	for($intStart = $start; $intStart<$end;$intStart->add($interval)->add($cleanupInterval)){
		$endPeriod = clone $intStart;
		$endPeriod->add($interval);
		if($endPeriod > $end){
			break;
		}
		$slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
	}
	return $slots;
}
//////////

function build_calendar($month,$year){
	$mysqli = new mysqli('localhost','root','','patients_manager');
	$daysOfWeek= array('Duminică','Luni','Marți','Miercuri','Joi','Vineri','Sambată');
	$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
	$numberDays = date('t',$firstDayOfMonth);
	$dateComponents= getdate($firstDayOfMonth);
	$monthName = $dateComponents['month'];
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
	
	$dayOfWeek = $dateComponents['wday'];
	$dateToday = date('Y-m-d');
	$calendar = "<table class='table table-bordered'>";
	$calendar .= "<center><h2>$monthNameRO $year</h2>";
	$calendar .="<a class ='btn btn-sm btn-primary' href='?month=".date('m',mktime(0,0,0,$month-1,1,$year))."&year=".date('Y',mktime(0,0,0,$month-1,1,$year))."'>Luna anterioara</a> ";
	$calendar .= "<a class ='btn btn-sm btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Luna curenta</a> ";
	$calendar .= "<a class ='btn btn-sm btn-primary' href='?month=".date('m',mktime(0,0,0,$month+1,1,$year))."&year=".date('Y',mktime(0,0,0,$month+1,1,$year))."'>Luna urmatoare</a></center><br>";
	$calendar .= "<tr>";
	foreach($daysOfWeek as $day){
		$calendar .= "<th class='header'>$day</th>";
	}
	$calendar .= "</tr><tr>";
	if($dayOfWeek > 0){
		for($k=0;$k<$dayOfWeek;$k++){
			$calendar .="<td class = 'empty'></td>";
		}
	}
	$currentDay = 1;
	$month = str_pad($month, 2, "0",STR_PAD_LEFT);
	while($currentDay <= $numberDays){
		if($dayOfWeek ===7){
			$dayOfWeek = 0;
			$calendar .= "</tr><tr>";
			
		}
		
		$currentDayRel = str_pad($currentDay, 2,"0",STR_PAD_LEFT);
		$date= "$year-$month-$currentDayRel";
		
		$dayname=strtolower(date('l',strtotime($date)));
		$eventNum = 0;
		$today = $date==date('Y-m-d')?"today":"";
		if($date < date('Y-m-d')){
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager'); 
			$query = "SELECT * FROM programari WHERE data='$date'";
			$results = mysqli_query($db, $query);
			$pacienti='';
			$intervale = array();
			if(mysqli_num_rows($results) > 0 ){
				while($row = mysqli_fetch_assoc($results)){
					$pacienti=$pacienti."\r\n ".$row['nume'];
					$intervale[]=$row['interval_timp'];
				}
			}
			$duration = 20;
			$cleanup = 0;
			$start = "09:00";
			$end = "15:00";
			
			$slots = timeslots($duration, $cleanup, $start, $end);
			sort($slots);
			sort($intervale);
			
			$egal=0;
			if ($slots==$intervale){
				$egal = 1;
			}
			$design='';
			if(($pacienti !='') and ($date!=date('Y-m-d')) and ($egal==0)){
				$design="partial_rezerved";
				
			}
			elseif($pacienti and ($date!=date('Y-m-d')) and ($egal==1)){
				$design="total_rezerved";
				
			}
			
			$calendar .= "<td  class ='$design' title='$pacienti' ><h4>$currentDay</h4><button class = 'btn btn-danger btn-sm'>Expirat</button>";
		}/*elseif(in_array($date,$programari)){
			$calendar .= "<td><h4>$currentDay</h4><button class = 'btn btn-danger btn-xs'>Programare facuta deja</button>";
		}*/
		else{
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager'); 
			$query = "SELECT * FROM programari WHERE data='$date'";
			$results = mysqli_query($db, $query);
			$pacienti='';
			$intervale = array();
			if(mysqli_num_rows($results) > 0 ){
				while($row = mysqli_fetch_assoc($results)){
					$pacienti=$pacienti."\r\n ".$row['nume'];
					$intervale[]=$row['interval_timp'];
				}
			}
			$duration = 20;
			$cleanup = 0;
			$start = "09:00";
			$end = "15:00";
			
			$slots = timeslots($duration, $cleanup, $start, $end);
			sort($slots);
			sort($intervale);
			
			$egal=0;
			if ($slots==$intervale){
				$egal = 1;
			}
			
			$design=$today;
			if($pacienti and ($date!=date('Y-m-d')) and ($egal==0)){
				$design="partial_rezerved";
				$calendar .= "<td class = '$design' title='$pacienti' style = 'transition: all ease-in-out 0.2s; cursor: pointer;'><h4>$currentDay</h4><a href = 'programare.php?date=".$date."' class ='btn btn-success btn-sm'>Programare noua</a>";
			}
			elseif($pacienti and ($date!=date('Y-m-d')) and ($egal==1)){
				$design="total_rezerved";
				$calendar .= "<td class = '$design' title='$pacienti' style = 'transition: all ease-in-out 0.2s; cursor: pointer;'><h4>$currentDay</h4><a href = 'programare.php?date=".$date."' class ='btn btn-success btn-sm'>Vezi programarile</a>";
			}
			else{
			 $calendar .= "<td class = '$design' title='$pacienti' style = 'transition: all ease-in-out 0.2s; cursor: pointer;'><h4>$currentDay</h4><a href = 'programare.php?date=".$date."' class ='btn btn-success btn-sm'>Programare noua</a>";
			}
		}
	
		/*if($dateToday == $date){
			$calendar .= "<td class ='today' rel ='$date'><h4>$currentDay</h4>";
		}
		else{
			$calendar .= "<td><h4>$currentDay</h4>";
		}*/
		$calendar .= "</td>";
		$currentDay++;
		$dayOfWeek++;
	}
	if($dayOfWeek != 7){
		$remainingDays = 7-$dayOfWeek;
		for($i=0;$i<$remainingDays; $i++){
			$calendar .= "<td class = 'empty'></td>";
		}
	}
	$calendar .= "</tr>";
	$calendar .= "</table>";
	echo $calendar;
}
?>
<html>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	<?php
		session_start();
		if(isset($_GET['pacient'])){
			$id_pacient =  $_GET['pacient'];
			$_SESSION['id_pacient']=$id_pacient;
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$query = "SELECT * FROM pacienti WHERE id = $id_pacient ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$nume= $row['nume'];
			$prenume = $row['prenume'];
			$_SESSION['prenume_pacient']=$prenume;
			$nume_poza=$row['nume_poza'];
			$_SESSION['poza']=$nume_poza;
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
		<center><h2 style="color:#ffffff;font: italic bold 40px Georgia, serif;margin-left:90px;">Progrămari</h2></center>
		</div>
		<a href="acasa_pacient.php?pacient=<?php echo $id_pacient;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasă</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza; ?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
	<style>
		table{
			table-layout:fixed;
		}
		td{
			width:33%;
			word-wrap: break-word;
		}
		.today{
			background:pink;
		}
		.total_rezerved{
			background:red;
		}
		.partial_rezerved{
			background:yellow;
		}
	</style>
</head>
<body style="background-color:#ffffcc">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				$dateComponents = getDate();
				if(isset($_GET['month']) && isset($_GET['year'])){
					$month = $_GET['month'];
					$year = $_GET['year'];
				}else{
					$month = $dateComponents['mon'];
					$year = $dateComponents['year'];
				}
				echo build_calendar($month, $year);
				?>
			</div>
		</div>
	</div>
	<div class ="card" style="margin-top:50px;margin-left:300px;margin-bottom:100px;height:200px;width:500px;">
	<div class = "card-header" style="background-color:#0275d8;">
		<center><h5>Legendă culori</h5><center>
	</div>
	<div class="card-body" style="font-size:26; background-color:#ccccb3;">
		<table style="margin-left:10px;">
		<tr>
		<td style="background:pink;"></td>
		<td>Ziua curentă</td>
		</tr>
		<tr>
		<td style="background:yellow;"></td>
		<td>Zi  parțial ocupată</td>
		</tr>
		<tr>
		<td style="background:red;"></td>
		<td>Zi complet ocupată</td>
		</tr>
		<tr>
		<td style="background:#ffffcc"></td>
		<td>Zi liberă</td>
		</tr>
		</table>
	</div>
	</div>
</body>
</html>