<?php
if(isset($_GET['files'])){
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		
		$_delete = $_GET['files'];
		$id_vaccin=$_delete[0];
		$id_pacient=$_delete[1];	
		$id_medic=$_delete[2];
			
		$query = "DELETE FROM pacienti_vaccinuri WHERE id='$id_vaccin'";
		$results = mysqli_query($db, $query);
		$_SESSION['message'] = "Pacientul a fost sters!";
		$_SESSION['msg_type'] = "danger";
		
		$files_add = array();
		$array_add = array($id_pacient,$id_medic);
		foreach ($array_add as $item){
			$files_add[] ='files[]=' . $item;
		}
		$items_add = implode('&', $files_add);
		header('Location:pacient_vaccinuri.php?' . $items_add . '');
	}
?>