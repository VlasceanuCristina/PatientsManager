
<?php

require_once '../includes/DbConnect.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$db =new DbConnect();
	$conn=$db->connect();
	//creating a query
	$id_pacient=$_POST['id_pacient'];
	$nume=$_POST['nume'];
	$prenume=$_POST['prenume'];
	$data=$_POST['data'];
	$ora=$_POST['ora'];
	$pacient=$nume.' '.$prenume;
	
	//binding results to the query 
	$stmt = $conn->prepare("INSERT INTO `programari` (`id`, `nume`, `data`, `interval_timp`,`id_pacient`) VALUES (NULL, ?, ?, ?,?);");
	$stmt->bind_param("ssss",$pacient,$data,$ora,$id_pacient);
	$stmt->execute();
	$repsonse['error'] = false;
   $response['message'] = 'Insesare facuta';			
}
echo json_encode($response);
?>