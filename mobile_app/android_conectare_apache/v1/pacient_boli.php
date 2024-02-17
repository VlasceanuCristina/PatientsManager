
<?php

require_once '../includes/DbConnect.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
	$db =new DbConnect();
	$conn=$db->connect();
	//creating a query
	$id_pacient=$_GET['pacient'];
	$stmt = $conn->prepare("SELECT PB.id,denumire_boala, data, tratament FROM boli B, pacienti_boli PB WHERE id_pacient = $id_pacient AND B.id = Pb.id_boala");

	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $title, $data, $tratament);
	$products = array(); 
	while($stmt->fetch()){
		$response = array();
		$response['id']=$id;
		$response['denumire']=$title;
		$response['tratament']=$tratament;
		$response['data']=$data;
		array_push($products, $response);
		}
	echo json_encode($products);
}

?>