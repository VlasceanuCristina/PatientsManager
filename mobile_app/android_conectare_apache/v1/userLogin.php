<?php 
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) and isset($_POST['password'])){
		$db = new DbOperations();
		if($db->userLogin($_POST['email'],$_POST['password'])){
			$user = $db->getUserByEmail($_POST['email']);
			$response['error']=false;
			$response['id']=$user['id'];
			$response['email']=$user['email'];
			$response['password']=$user['password'];
			
			
		}
		else{
			$repsonse['error'] = true;
			$response['message'] = 'Required fields are missing';
		}
		
	}else{
		$repsonse['error'] = true;
		$response['message'] = 'Required fields are missing';
	}
}
echo json_encode($response);
?>