
<?php

require_once '../includes/DbConnect.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
	$db =new DbConnect();
	$conn=$db->connect();
	//creating a query
	$id_pacient=$_GET['pacient'];
	$stmt = $conn->prepare("SELECT data,ora,diagnostic,tratament,pret FROM consultatii WHERE id_pacient = $id_pacient");

	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($data, $ora,$diagnostic,$tratament,$pret);
	$products = array(); 
	while($stmt->fetch()){
		$response = array();
		$response['data_consultatie']=$data;
		$response['ora']=$ora;
		$response['diagnostic']=$diagnostic;
		$response['tratament']=$tratament;
		$response['pret']=$pret;
		array_push($products, $response);
		}
	echo json_encode($products);
}

?>