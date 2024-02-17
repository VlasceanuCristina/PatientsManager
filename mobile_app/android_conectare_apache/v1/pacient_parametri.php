
<?php

require_once '../includes/DbConnect.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
	$db =new DbConnect();
	$conn=$db->connect();
	//creating a query
	$id_pacient=$_GET['pacient'];
	$stmt = $conn->prepare("SELECT puls,tensiune,inaltime,greutate,data FROM parametri WHERE id_pacient = $id_pacient ");

	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($puls, $tensiune,$inaltime,$greutate,$data);
	$products = array(); 
	while($stmt->fetch()){
		$response = array();
		$response['puls']=$puls;
		$response['tensiune']=$tensiune;
		$response['inaltime']=$inaltime;
		$response['greutate']=$greutate;
		$response['data']=$data;
		array_push($products, $response);
		}
	echo json_encode($products);
}

?>