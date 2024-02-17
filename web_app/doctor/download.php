<?php
if(isset($_GET['id'])){
	$db = new PDO("mysql:host=localhost;dbname=patients_manager","root","");
	$id = $_GET['id'];
	$stat = $db->prepare("select * from analize where id =?");
	$stat->bindParam(1,$id);
	$stat->execute();
	$data=$stat->fetch();
	$file='upload/'.$data['nume'];
	//echo $file;
	if(file_exists($file)){
		header('Content-Description: '.$data['description']);
		header('Content-Type: '.$data['type']);
		header('Content-Disposition: '.$data['dispozition']);
		header('Expires: '.$data['expires']);
		header('Cache-Control: '.$data['cache']);
		header('Pragma: '.$data['pragmna']);
		header('Content-Length: '.filesize($file));
		readfile($file);
		//echo $data['continut'];
		exit;
	}
}