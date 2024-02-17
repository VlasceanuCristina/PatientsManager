<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_POST['adaugare_boala'])){
$data=$_POST['data_boala'];
$denumire=$_POST['denumire_boala'];
$tratament = $_POST['tratament'];
$query_select="SELECT * FROM boli WHERE denumire_boala='$denumire'";
$result_select=mysqli_query($db,$query_select);
$row=mysqli_fetch_array($result_select);
$id_boala=$row['id'];
$items=$_POST['identificare'];
$ids=explode('&', $items);
$id_pacient=(int)substr($ids[0], -1);
echo $id_pacient;
$query="INSERT INTO pacienti_boli(id_pacient,id_boala,data, tratament) VALUES($id_pacient,$id_boala,'$data','$tratament')";
$result=mysqli_query($db,$query);
header('Location:pacient_boli.php?' . $items . '');
}

?>