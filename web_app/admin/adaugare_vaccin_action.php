<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_POST['adaugare_vaccin'])){
$data=$_POST['data_vaccin'];
$denumire=$_POST['denumire_vaccin'];
$query_select="SELECT * FROM vaccinuri WHERE denumire='$denumire'";
$result_select=mysqli_query($db,$query_select);
$row=mysqli_fetch_array($result_select);
$id_vaccin=$row['id'];
$items=$_POST['identificare'];
$ids=explode('&', $items);
$id_pacient=(int)substr($ids[0], -1);
$query="INSERT INTO pacienti_vaccinuri(id_pacient,id_vaccin,data) VALUES($id_pacient,$id_vaccin,$data)";
$result=mysqli_query($db,$query);
header('Location:pacient_vaccinuri.php?' . $items . '');
}
?>