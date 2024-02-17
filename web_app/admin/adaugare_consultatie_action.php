<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_POST['adaugare_consultatie'])){
$data=$_POST['data'];
$ora=$_POST['ora'];
$tratament = $_POST['tratament'];
$diagnostic=$_POST['diagnostic'];
$pret=$_POST['pret'];
$comentarii=$_POST['comentarii'];


$id_reteta=NULL;
$id_trimitere=NULL;
$id_adeverinta=NULL;
//identificare id_adeverinta
$query_adeverinta="SELECT id FROM adeverinte WHERE data='$data'";
$result_adeverinta=mysqli_query($db,$query_adeverinta);
if($result_adeverinta){
if(mysqli_num_rows($result_adeverinta)>0){
	$row_adeverinta = mysqli_fetch_assoc($result_adeverinta);
	$id_adeverinta=$row_adeverinta['id'];
}
}

//identificare id_reteta
$query_reteta="SELECT id FROM retete WHERE data='$data'";
$result_reteta=mysqli_query($db,$query_reteta);
if($result_reteta){
if(mysqli_num_rows($result_reteta)>0)
{
	$row_reteta = mysqli_fetch_assoc($result_reteta);
	$id_reteta=$row_reteta['id'];
}
}
//identificare id_trimitere

$query_trimitere="SELECT id FROM bilete_trimitere WHERE data_trimiterii='$data'";
$result_trimitere=mysqli_query($db,$query_trimitere);
if($result_trimitere){
if(mysqli_num_rows($result_trimitere)>0){
	$row_trimitere = mysqli_fetch_assoc($result_trimitere);
	$id_trimitere=$row_trimitere['id'];
}
}

//inserare consulttatie noua
$items=$_POST['identificare'];
$ids=explode('&', $items);
$id_pacient=(int)substr($ids[0], -1);
echo $id_adeverinta;
echo $id_reteta;
echo $id_trimitere;
if((!is_null($id_adeverinta)) AND (!is_null($id_reteta)) AND (!is_null($id_trimitere)))
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret,id_adeverinta,id_reteta,id_bilet_trimitere) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret,$id_adeverinta,$id_reteta,$id_trimitere)";
elseif((!is_null($id_adeverinta)) AND (!is_null($id_reteta)))
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret,id_adeverinta,id_reteta) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret,$id_adeverinta,$id_reteta)";
elseif((!is_null($id_adeverinta)) AND (!is_null($id_trimitere)))
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret,id_adeverinta,id_bilet_trimitere) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret,$id_adeverinta,$id_trimitere)";
elseif((!is_null($id_reteta)) AND (!is_null($id_trimitere)))
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret,id_bilet_trimitere,id_reteta) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret,$id_trimitere,$id_reteta)";
elseif((!is_null($id_trimitere)))
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret,id_bilet_trimitere) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret,$id_trimitere)";
elseif((!is_null($id_reteta)))
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret,id_reteta) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret,$id_reteta)";
elseif(!is_null($id_adeverinta))
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret,id_bilet_trimitere) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret,$id_adeverinta)";
else
	$query="INSERT INTO consultatii(id_pacient,data,ora, tratament,diagnostic,comentarii,pret) VALUES($id_pacient,'$data','$ora','$tratament','$diagnostic','$comentarii',$pret)";
echo $query;
$result=mysqli_query($db,$query);
echo $result;
header('Location:pacient_consultatii.php?' . $items . '');
}
?>