<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');	
 $query = "SELECT id,puls,tensiune,greutate,inaltime, data FROM parametri WHERE id_pacient = $id_pacient ";
$results = mysqli_query($db, $query);
	echo mysqli_num_rows($results);		
	if(mysqli_num_rows($results) > 0 ){
	$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
	}
?>