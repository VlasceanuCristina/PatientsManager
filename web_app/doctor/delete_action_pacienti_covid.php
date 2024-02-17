<?php
if(isset($_GET['files'])){
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$_delete = $_GET['files'];
	$id_boala=$_delete[0];
	$id_medic=$_delete[1];
	$query = "DELETE FROM pacienti_covid WHERE id='$id_boala'";
	$results = mysqli_query($db, $query);

	$items_add = implode('&', $files_add);
	header('Location:pacienti_covid.php?medic='.$id_medic);
	}
?>