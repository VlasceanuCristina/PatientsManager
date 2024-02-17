<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_POST['adaugare_internare'])){
$data_internare=$_POST['data_internare'];
$data_externare=$_POST['data_externare'];
$diagnostic_internare = $_POST['diagnostic_internare'];
$diagnostic_externare = $_POST['diagnostic_externare'];
$tratament = $_POST['tratament'];
$spital = $_POST['spital'];
$items=$_POST['identificare'];
$ids=explode('&', $items);
$id_pacient=(int)substr($ids[0], -1);
$query="INSERT INTO internari(id_pacient,data_internare,data_externare,diagnostic_internare,diagnostic_externare, tratament,spital) VALUES($id_pacient,'$data_internare','$data_externare','$diagnostic_internare','$diagnostic_externare','$tratament','$spital')";
$result=mysqli_query($db,$query);
echo $result;
header('Location:pacient_internari.php?' . $items . '');
}
?>