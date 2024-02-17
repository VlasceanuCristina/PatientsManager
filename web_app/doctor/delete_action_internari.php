<?php
if(isset($_GET['files'])){
		//$id=$_GET['delete'];
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		
		$id_internare=$_GET['files'][0];
		$id_pacient=$_GET['files'][1];	
		$id_medic=$_GET['files'][2];
		$query = "DELETE FROM internari WHERE id='$id_internare'";
		$results = mysqli_query($db, $query);
		$_SESSION['message'] = "Pacientul a fost sters!";
		$_SESSION['msg_type'] = "danger";
		$files_add = array();
		$array_add = array($id_pacient,$id_medic);
		foreach ($array_add as $item){
			$files_add[] ='files[]=' . $item;
		}
		$items_add = implode('&', $files_add);
		header('Location:pacient_internari.php?' . $items_add . '');
		
	}
?>