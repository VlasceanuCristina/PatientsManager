
<?php

require_once '../includes/DbConnect.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
	$db =new DbConnect();
	$conn=$db->connect();
	//creating a query
	$id_pacient=$_GET['pacient'];
	$stmt = $conn->prepare("SELECT denumire, data FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id = PV.id_vaccin");

	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($title, $data);
	$products = array(); 
	while($stmt->fetch()){
		$response = array();
		$response['denumire']=$title;
		$response['data']=$data;
		array_push($products, $response);
		}
	echo json_encode($products);
}

?>