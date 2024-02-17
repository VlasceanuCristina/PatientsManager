<?php
$mysqli = new mysqli('localhost','root','','patients_manager');
if (isset($_GET['date'])){
	$date = $_GET['date'];
	
	$stmt = $mysqli->prepare("select * from programari where data=? ");
	$stmt->bind_param('s',$date);
	$programari = array();
	if($stmt->execute()){	
		$result = $stmt->get_result();
		if($result->num_rows > 0){	
			while($row= $result->fetch_assoc()){
				$programari[]=$row['interval_timp'];
			}
			$stmt->close();
		}
		}
	}	
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$timeslot = $_POST['timeslot'];
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager'); 
	$query = "SELECT id, nume, prenume, cnp,email FROM pacienti WHERE email='$email'";
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($results);
	$id_pacient=$row ['id'];
	//$nume_pacient=$row['nume'].' '.$row['prenume'];
	
	$stmt = $mysqli->prepare("select * from programari where data=? and interval_timp=?");
	$stmt->bind_param('ss',$date, $timeslot);
	if($stmt->execute()){
		$result = $stmt->get_result();
		if($result->num_rows > 0){	
			$msg = "<div class = 'alert alert-danger'>Programare deja facuta!</div>";
		}else{
			$stmt = $mysqli->prepare("INSERT INTO programari(nume,interval_timp,email,data,id_pacient) values(?,?,?,?,?)");
			$stmt->bind_param('sssss',$name,$timeslot, $email, $date, $id_pacient);
			$stmt->execute();
			$msg = "<div class = 'alert alert-success'>Programare facuta cu succes!</div>";
			$programari[] = $timeslot;
			$stmt->close();
			$mysqli->close();
		}
	}
	
	
}
$duration = 20;
$cleanup = 0;
$start = "09:00";
$end = "15:00";

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
?>
<!doctype html>

<div class="wrapper" style="margin-left:auto;margin-right:auto;width:1705px;">
<html lang="ro">
<head>
	<meta charset ="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php
		session_start();
		if(isset($_GET['medic'])){
			$id_medic =  $_GET['medic'];
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$query = "SELECT * FROM medici WHERE id = $id_medic ";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$nume= $row['nume'];
			$prenume = $row['prenume'];
			$nume_poza=$row['nume_poza'];
			//$_SESSION['poza']=$nume_poza;
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
		<a href="acasa.php?medic=<?php echo $_SESSION['id_medic'];?>" class="btn btn-info btn-lg" style="background-color:white;color:blue;width:80px;height:40px;font-size:16px;"><i class="fa fa-fw fa-home"></i>Acasă</a>
		<button class="btn btn-info" style="background-color:white;color:blue;width:80px;height:40px;font-size:16px;" onclick="goBack()">Înapoi</button>
		<button class="btn btn-info btn-lg" style="background-color:white;color:blue;width:80px;height:40px;font-size:16px;" onclick="goForward()">Înainte</button>
		<a href="logout.php" class="btn btn-info btn-lg" style="background-color:white;color:blue;width:110px;height:40px;font-size:16px;">Deconectare</a>
		<img src="<?php echo  $_SESSION['poza'];?>" title="<?php echo $_SESSION['prenume_medic'];?>"alt="Avatar" class="avatar" style="width:40px;height:40px;border-radius: 50%;margin-left:0px;">	
	</nav>
	
	</head>
</head>

<style>
.btn btn-danger{
 transition: all ease-in-out 0.2s;
 cursor: pointer;
}
.btn btn-danger:hover{
 border: 1px solid #888;
 background-color: #ddd;

}
</style>
<body style="background-color:#ffffcc">
	<div class="container" style="margin-top:20px;margin-bottom:20px;">
		<h1 class="text-center">Programare pentru data: <?php echo date('d/m/Y',strtotime($date));?></h1><hr>
		<div class="row" style="background-color:#0275d8;padding:20px;">
			<div class="col-md-12" >
				<?php echo isset($msg)?$msg:'';?>
			</div>
			<?php $timeslots = timeslots($duration,$cleanup, $start, $end);
				foreach($timeslots as $ts){
			?>
			<div class="col-md-2">
				<div class = "form-group">
					<?php
					$mysqli = new mysqli('localhost','root','','patients_manager');
					$stmt = $mysqli->prepare("select * from programari where interval_timp= ? AND data=?");
					$stmt->bind_param('ss',$ts,$date);
					$stmt->execute();
					$result = $stmt->get_result();
					$row= $result->fetch_assoc();
					//trebuie sa iau si data in care sunt si de acolo iau nume pacient
					/*$date = date('d/m/Y',strtotime($date));
					echo $date;
					$db = mysqli_connect('localhost', 'root', '', 'patients_manager'); 
					$query = "SELECT * FROM programari WHERE interval_timp='$ts' AND data = $date";
					$results = mysqli_query($db, $query);
					$row_pacient = mysqli_fetch_assoc($results);
					$nume_pacient=$row ['nume'];
					*/
					
					///
					$nume_pacient = $row['nume'];
					if(in_array($ts, $programari)){ ?>
					<button class="btn btn-danger" title="<?php echo $nume_pacient; ?>" style = "transition: all ease-in-out 0.2s; cursor: pointer;width:150px;height:40px;font-size:16px;"><?php echo $ts;?></button>
					<?php }else{?>
					<button class="btn btn-success book" data-timeslot="<?php echo $ts;?>" style="width:150px;height:40px;font-size:16px;"><?php echo $ts;?></button>
					<?php }?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="card" style="margin-left:270px; width:1140px;">
		<img src="progr.jpg" class="card-img-left">
		
	</div>
	<div style="margin-top:50px;margin-bottom:50px;">
	<center><a href='afisare_programari.php' class="btn btn-info" style="width:210px;height:40px;font-size:16px;">Vizualizare întreaga lună</a><center>
	</div>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog" style="font-size:16px;">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Programare:<span id="slot"></span></h4>
				</div>
				<div class="modal-body">
					<div class = "row">
						<div class="col-md-12">
							<form action="" method="post">
								<div class = "form-group">
									<label for="">Interval de timp</label>
									<input required type ="text" readonly name = "timeslot" id= "timeslot" class="form-control" style="height:30px;">
								</div>
							    <div class="form-group">
									<label for="">Nume</label>
									
									<select  name="name" class="form-control" style="height:30px;">
									<?php
									$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
									$query = "SELECT id, nume, prenume, cnp,email FROM pacienti";
									$results = mysqli_query($db, $query);
									if(mysqli_num_rows($results) > 0 ){
										while($row = mysqli_fetch_assoc($results)){?>
										<option value="<?php echo $row['nume'].' '.$row['prenume'];?>"><?php echo $row['nume'].' '.$row['prenume'];?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<select  name="email" class="form-control" style="height:30px;">
									<?php 
									$query = "SELECT id, nume, prenume, cnp,email FROM pacienti";
									$results = mysqli_query($db, $query);
									while($row = mysqli_fetch_assoc($results)){?>
										<option value="<?php echo $row['email'];?>"><?php echo $row['email'];?></option>
									<?php }?>
									</select>
								</div>
								<?php
									}
								?>
								<div class="form-group  pull-right">
									<button class="btn btn-primary btn-lg" type = "submit" name="submit">Submit</button>
								</div>
							</form>
						</div>		
					</div>
				</div>
			</div>

		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!--<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(".book").click(function(){
			var timeslot = $(this).attr('data-timeslot');
			$("#slot").html(timeslot);
			$("#timeslot").val(timeslot);
			$("#myModal").modal("show");
		});
	</script>	
</body>
</html>
</div>