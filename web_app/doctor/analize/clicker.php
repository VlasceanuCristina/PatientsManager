<?php
if (isset($_GET['date'])){
	$date = $_GET['date'];
}
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mysqli = new mysqli('localhost','root','','patients_manager');
	$stmt = $mysqli->prepare("INSERT INTO programari(nume,email,data) values(?,?,?)");
	$stmt->bind_param('sss',$name, $email, $date);
	$stmt->execute();
	$msg = "<div class = 'alert alert-success'>Programare facuta cu succes!</div>";
	$stmt->close();
	$mysqli->close();
}
$duration = 10;
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
<html lang="ro">
<head>
	<meta charset ="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel = "stylesheet" href ="/main.css";
</head>



<body>
  <script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
  <button class="btn btn-success" id ="clicker1">Click</button>
  <div class="container">
		<h1 class="text-center">Programare pentru data: <?php echo date('d/m/Y',strtotime($date));?></h1><hr>
		<div class="row">
			<?php $timeslots = timeslots($duration,$cleanup, $start, $end);
				foreach($timeslots as $ts){
			?>
			<div class="col-md-2">
				<div class = "form-group">
					<button class="btn btn-success" id ="clicker"><?php echo $ts;?></button>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
  <!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
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
									<label for="">Timeslot</label>
									<input required type ="text" readonly name = "timeslot" id= "timeslot" class="form-control">
								</div>
							    <div class="fomr-group">
									<label for="">Name</label>
									<input required type = "text" readonly name="name" class="form-control">
								</div>
								<div class="fomr-group">
									<label for="">Email</label>
									<input required type = "email" readonly name="email" class="form-control">
								</div>
							</form>
						</div>		
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
  <script type="text/javascript">

        $("#clicker").click(function () {
            var timeslot = $(this).attr('data-timeslot');
			$("#slot").html(timeslot);
			$("#timeslot").val(timeslot);
			$("#myModal").modal("show");
        });
    

</script>
  
 
<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel = "stylesheet" href ="/main.css";


</body>
</html>