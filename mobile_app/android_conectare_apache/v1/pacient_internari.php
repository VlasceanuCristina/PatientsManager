
<?php

require_once '../includes/DbConnect.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
	$db =new DbConnect();
	$conn=$db->connect();
	//creating a query
	$id_pacient=$_GET['pacient'];
	$stmt = $conn->prepare("SELECT data_internare,data_externare,spital, diagnostic_internare,diagnostic_externare,tratament FROM internari WHERE id_pacient = $id_pacient ");

	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($puls, $tensiune,$inaltime,$greutate,$data, $tratament);
	$products = array(); 
	while($stmt->fetch()){
		$response = array();
		$response['data_internare']=$puls;
		$response['data_externare']=$tensiune;
		$response['spital']=$inaltime;
		$response['diagnostic_internare']=$greutate;
		$response['diagnostic_externare']=$data;
		$response['tratament']=$tratament;
		array_push($products, $response);
		}
	echo json_encode($products);
}

?>