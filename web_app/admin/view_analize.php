<?php
$dbh = new PDO("mysql:host=localhost;dbname=patients_manager","root","");
$id=isset($_GET['id'])?$_GET['id']:"";
$stat=$dbh->prepare("select * from analize where id=?");
$stat->bindParam(1,$id);
$stat->execute();
$row=$stat->fetch();
header('Content-type:'.$row['tip']);
echo $row['continut'];
?>