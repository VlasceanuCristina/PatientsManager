<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_POST['adaugare_parametru'])){
$puls=$_POST['puls'];
$tensiune=$_POST['tensiune'];
$greutate = $_POST['greutate'];
$inaltime = $_POST['inaltime'];
$data = $_POST['data'];
$id_pacient=$_POST['id_pacient'];
$items=$_POST['identificare'];
$ids=explode('&', $items);
$id_pacient=(int)substr($ids[0], -1);
$query="INSERT INTO parametri(id_pacient,puls,tensiune,greutate,inaltime,data) VALUES($id_pacient,'$puls','$tensiune','$greutate','$inaltime','$data')";
$result=mysqli_query($db,$query);
$items=$_POST['identificare'];
header('Location:pacient_parametri.php?' . $items . '');
}
?>