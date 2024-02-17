<?php
if(isset($_GET['files'])){
		$id_pacient=$_GET['files'][0];
		$id_medic=$_GET['files'][1];
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		$query = "DELETE FROM pacienti WHERE id= $id_pacient";
		$results = mysqli_query($db, $query);
		$_SESSION['message'] = "Pacientul a fost sters!";
		$_SESSION['msg_type'] = "danger";
		header("Location:afisare_pacienti.php?medic=".$id_medic);
	}
?>