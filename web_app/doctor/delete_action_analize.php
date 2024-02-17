<?php
if(isset($_GET['files'])){
		//$id=$_GET['delete'];
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		
		$_delete = $_GET['files'];
		$id_analiza=$_delete[0];
		$id_pacient=$_delete[1];	
		$id_medic = $_delete[2];
		echo $id_analiza;
		$query = "DELETE  FROM analize WHERE id=$id_analiza";
		$results = mysqli_query($db, $query);
		echo $results;
		
		$_SESSION['msg_type'] = "danger";
		$files_add = array();
		$array_add = array($id_pacient,$id_medic);
		foreach ($array_add as $item){
			$files_add[] ='files[]=' . $item;
		}
		$items_add = implode('&', $files_add);
		header('Location:analize.php?' . $items_add . '');
			
	}
?>