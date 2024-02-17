
<!DOCTYPE HTML>
<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Istoric parametri</title>
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
		$_SESSION['id_pacient']=$id_pacient;
		$_SESSION['id_medic']=$id_medic;
	}
	else
	{
		$id_pacient=$_SESSION['id_pacient'];
		$id_medic=$_SESSION['id_medic'];
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$query = "SELECT * FROM medici WHERE id = $id_medic ";
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_array($results);
	$prenume = $row['prenume'];
	$nume_poza= $row['nume_poza'];
		
	?>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="height:60px;">
		<a>
		<img src="brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		<span class="menu-collapsed" style="font-size:22px;color:white;">PatientsManager</span>
		</a>
		<div style="width:1050px;height:60px;">
		<center><span style="color:#ffffff;font: italic bold 40px Georgia, serif;"></span></center>
		</div>
		<a href="acasa.php?medic=<?php echo $id_medic;?>" class="btn btn-info" style="background-color:white;color:blue;"><i class="fa fa-fw fa-home"></i>Acasa</a>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info" style="background-color:white;color:blue;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info" style="background-color:white;color:blue;">Deconectare</a>
		<img src="<?php echo $nume_poza;?>" title="<?php echo $prenume;?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">
	</nav>
	
<div class="card" style="background-color:#000;padding-top:15px;padding-bottom:15px;color:white">
<form action="grafic_greutate.php" method = "post">
	<p >Selectează intervalul de timp:</p>
	<p> De la :<input type="date" name="data_inceput">pana la:<input type="date" name="data_sfarsit"></p>
	<input type="submit" class="btn btn-success btn-xs" name="interval_timp" value="Confirmare dată">
</form>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script> var dataPoints1=[];
var dataPoints2=[];
var dataPoints3=[];</script>
<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');	
$dataPoints = array();
if(isset($_GET['files'])){
		$param = $_GET['files'];
		$id_pacient=$param[0];
		$id_medic=$param[1];
		
	}
 $query = "SELECT id,puls,tensiune,greutate,inaltime, data FROM parametri WHERE id_pacient = $id_pacient ";
$results = mysqli_query($db, $query);
	//echo mysqli_num_rows($results);
	if(mysqli_num_rows($results) > 0 ){
	while($row = mysqli_fetch_assoc($results)){
		
		if(isset($_POST["interval_timp"])){
			$data_inceput=$_POST["data_inceput"];
			//echo $data_inceput;
			
			$data_sfarsit=$_POST["data_sfarsit"];
			//echo $data_sfarsit;
			if($row['data'] >= $data_inceput and $row['data'] <= $data_sfarsit)
				{
					//echo $row['data'];
			$an=date("Y",strtotime($row['data']));
			$luna=date("m",strtotime($row['data']));
			$zi=date("d",strtotime($row['data']));
			
			
			$tensiune=$row['tensiune'];
			$t=explode('/',$tensiune);
			$sistolica=(int)($t[0]);
			$diastolica=(int)($t[1]);
				}
			
		}
		else{
			/*$an=date("Y",strtotime($row['data']));
			$luna=date("m",strtotime($row['data']));
			$zi=date("d",strtotime($row['data']));*/
			$tensiune=$row['tensiune'];
			$t=explode('/',$tensiune);
			$sistolica=(int)($t[0]);
			$diastolica=(int)($t[1]);
			}
			?>
			<script>
			var data= new Date(<?php echo $an;?>,<?php echo $luna;?>,<?php echo $zi;?>);
			
			//var data1=CanvasJS.formatDate( data, "DD MMM, YYYY");
			//document.write(data1);
			dataPoints1.push({"x":data, "y":<?php echo $sistolica;?>});	
			dataPoints2.push({"x":data, "y":<?php echo $diastolica;?>});	
			</script>
	<?php		
	}
	}
	//echo json_encode($dataPoints, JSON_NUMERIC_CHECK); 
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Fluctuație tensiune"
	},
	axisY: {
		title: "Tensiune",
		suffix: "mm Hg",
		prefix: ""
	},
	 axisX:{
	    valueFormatString: "DD-MM-YYYY",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
        },
	legend:{
		cursor:"pointer",
	},
	data: [{
		type: "line",
		markerSize: 10,
		showInLegend: true,
		name: "Presiune sistolica",
		xValueFormatString: "DD-MM-YYYY",
		dataPoints: dataPoints1
	}, 
	{
		type: "line",
		markerSize: 10,
		showInLegend: true,
		name: "Presiune diastolica",
		xValueFormatString: "DD-MM-YYYY",
		dataPoints: dataPoints2
	},
	]
});
 
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div style="margin-top:50px;margin-left:100px;" >
<h5 style="padding-left:100px;">Tabel valori de referință</h5>
<img src="tens.png">
</div>

</body>
</html>      
</div>        