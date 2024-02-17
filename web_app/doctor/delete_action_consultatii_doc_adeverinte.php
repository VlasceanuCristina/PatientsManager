<?php
if(isset($_GET['files'])){
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$_delete = $_GET['files'];
	$id_adeverinta=$_delete[0];
	$id_pacient=$_delete[1];	
	$id_medic=$_delete[2];
	$id_consultatie=$_delete[3];
	$query = "DELETE FROM adeverinte WHERE id=$id_adeverinta";
	$results = mysqli_query($db, $query);

	$files_add = array();
	$array_add = array($id_consultatie,$id_pacient,$id_medic);
	foreach ($array_add as $item){
		$files_add[] ='files[]=' . $item;
	}
	$items_add = implode('&', $files_add);
	header('Location:edit_action_consultatii.php?' . $items_add . '');
	}
?>