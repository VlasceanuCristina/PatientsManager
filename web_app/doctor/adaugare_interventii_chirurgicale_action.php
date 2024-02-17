<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_POST['adaugare_interventie'])){
$denumire = $_POST['denumire'];
$recomandari = $_POST['recomandari'];
$data = $_POST['data'];
$spital = $_POST['spital'];
$id_pacient=$_POST['id_pacient'];
$items=$_POST['identificare'];
$ids=explode('&', $items);
$id_pacient=(int)substr($ids[0], -1);
$query="INSERT INTO interventii_chirurgicale(id_pacient,data,recomandari,denumire,spital) VALUES($id_pacient,'$data','$recomandari','$denumire','$spital')";
$result=mysqli_query($db,$query);
header('Location:interventii_chirurgicale.php?' . $items . '');
}
?>