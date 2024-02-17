
<?php

require_once '../includes/DbConnect.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
	$db =new DbConnect();
	$conn=$db->connect();
	//creating a query
	$id_pacient=$_GET['pacient'];
	$stmt = $conn->prepare("SELECT id,data_nastere,inaltime,greutate,rh,puls,tensiune,grupa_sange FROM pacienti WHERE id = 1");

	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $data_natere, $inaltime, $greutate,$rh,$puls,$tensiune,$grupa_sange);
	$products = array(); 
	while($stmt->fetch()){
		$response = array();
		$response['id']=$id;
		$response['data_nastere']=$data_natere;
		$response['inaltime']=$inaltime;
		$response['greutate']=$greutate;
		$response['rh']=$rh;
		$response['puls']=$puls;
		$response['tensiune']=$tensiune;
		$response['grupa_sange']=$grupa_sange;
		array_push($products, $response);
		}
	echo json_encode($products);
}

?>