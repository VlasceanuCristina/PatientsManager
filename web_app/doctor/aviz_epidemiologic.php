<?php 
require_once('fpdf182/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
if(isset($_GET['files'])){
$_param = $_GET['files'];
$id_medic=$_param[1];
$id_pacient=$_param[0];

$files = array();
$array1 = array($id_pacient,$id_medic);
foreach ($array1 as $item){
	$files[] ='files[]=' . $item;
	}
$items = implode('&', $files);
}
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
$query_select_pacient="SELECT * FROM pacienti WHERE id=$id_pacient";
$result_select_pacient=mysqli_query($db, $query_select_pacient);
$row_select_pacient=mysqli_fetch_array($result_select_pacient);
$nume_pacient=$row_select_pacient['nume'];
$prenume_pacient=$row_select_pacient['prenume'];
$firma=$row_select_pacient['firma'];


$data_nastere = date('Y-m-d',strtotime($row_select_pacient['data_nastere']));
$data_actuala= date('Y-m-d');
$diff=date_diff(date_create($data_actuala),date_create($data_nastere));
$varsta=$diff->format("%Y");
$sex=$row_select_pacient['sex'];
$adresa=$row_select_pacient['adresa'];
$carnet_vaccinari=$row_select_pacient['carnet_vaccinari'];
$id_parinte=$row_select_pacient['id_parinte'];
$nume_fisa=$nume_pacient.'_'.$prenume_pacient.'_fisa_vaccinari_'.$data_actuala.'.pdf';


$query_parinte_pacient="SELECT * FROM pacienti WHERE id=$id_parinte";
$result_parinte_pacient=mysqli_query($db, $query_parinte_pacient);
$row_parinte_pacient=mysqli_fetch_array($result_parinte_pacient);
$nume_parinte=$row_parinte_pacient['nume'];
$prenume_parinte = $row_parinte_pacient['prenume'];
$telefon_parinte=$row_parinte_pacient['telefon'];

$query_cabinet="SELECT * FROM cabinete C, medici M  WHERE M.id=$id_medic AND C.id_medic=M.id";
$result_cabinet=mysqli_query($db, $query_cabinet);
$row_cabinet=mysqli_fetch_array($result_cabinet);
$denumire_cabinet = $row_cabinet['denumire_cabinet'];
$adresa_cabinet = $row_cabinet['adresa_cabinet'];
$telefon_cabinet = $row_cabinet['telefon_cabinet'];


//randul1
$pdf->Cell(195,5,"",'B',1);
$pdf->Cell(170,5,"",'L',0);
$pdf->Cell(25,5,"",'R',1);

//randul2
$pdf->Cell(40,5,'Unitatea sanitara: ','L',0);
$pdf->Cell(150,5,$denumire_cabinet,'B',0);
$pdf->Cell(5,5,"",'R',1);

//randul2
$pdf->Cell(60,5,'(denumire,adresa,telefon)','L',0);
$pdf->Cell(130,5,$adresa_cabinet.','.$telefon_cabinet,'B',0);
$pdf->Cell(5,5,"",'R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);


$pdf->SetFont('Arial','',24);
//randul2
$pdf->Cell(60,5,'Fisa vaccinari','L',0);
$pdf->Cell(130,5,'',0,0);
$pdf->Cell(5,5,"",'R',1);

//radul1 29-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);


//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);

//randul2
$pdf->Cell(50,5,'Numele si prenumele:','L',0);
$pdf->Cell(140,5,$nume_pacient.' '.$prenume_pacient,'B',0);
$pdf->Cell(5,5,"",'R',1);

//randul2
$pdf->Cell(15,5,'Sexul:','L',0);
$pdf->Cell(10,5,$sex,'B',0);
$pdf->Cell(15,5,'Varsta',0,0);
$pdf->Cell(10,5,$varsta,'B',0);
$pdf->Cell(10,5,'ani',0,0);
$pdf->Cell(135,5,"",'R',1);

//randul2
$pdf->Cell(20,5,'Adresa:','L',0);
$pdf->Cell(170,5,$adresa,'B',0);
$pdf->Cell(5,5,"",'R',1);


//randul2
$pdf->Cell(85,5,'Institutia la care doreste sa se inscrie:','L',0);
$pdf->Cell(105,5,$firma,'B',0);
$pdf->Cell(5,5,"",'R',1);


//randul2
$pdf->Cell(70,5,'Numele si prenumele parintelui:','L',0);
$pdf->Cell(120,5,$nume_parinte.' '.$prenume_parinte,'B',0);
$pdf->Cell(5,5,"",'R',1);

//randul2
$pdf->Cell(85,5,'Telefoanele de contact ale parintelui:','L',0);
$pdf->Cell(105,5,$telefon_parinte,'B',0);
$pdf->Cell(5,5,"",'R',1);


$pdf->SetFont('Arial','',14);
$pdf->Cell(95,5,'Numarul carnetului de vaccinari al copilului:','L',0);
$pdf->Cell(95,5,$carnet_vaccinari,'B',0);
$pdf->Cell(5,5,"",'R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);


//randul2
$pdf->SetFont('Arial','',18);
$pdf->Cell(20,5,'Vaccinari','L',0);
$pdf->Cell(170,5,'',0,0);
$pdf->Cell(5,5,"",'R',1);




//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);


$pdf->SetFont('Arial','',18);
$pdf->Cell(115,5,'a)vaccinari conform programului national de vaccinare','L',0);
$pdf->Cell(75,5,'',0,0);
$pdf->Cell(5,5,"",'R',1);



//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);

//hwp B
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=1";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1b='';
$d2b='';
$d3b='';
$d4b='';
if(count($data_hep)==1)
	$d1b=$data_hep[0];
elseif(count(data_hep)==2)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
}
elseif(count(data_hep)==3)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
$d3b=$data_hep[2];
}
elseif(count(data_hep)==4)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
$d3b=$data_hep[2];
$d4b=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'hepatita B ','L',0);
$pdf->Cell(30,5,$d1b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d3b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d4b,'B',0);
$pdf->Cell(44,5,"",'R',1);


//BCG
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=2";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
$data_bcg='';
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_bcg=$row_vaccin['data'];
	
}
$pdf->Cell(25,5,'BCG ','L',0);
$pdf->Cell(30,5,$data_bcg,'B',0);
$pdf->Cell(140,5,'','R',1);



//DTP
//hwp B
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=3";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1d='';
$d2d='';
$d3d='';
$d4d='';
$d5d='';
$d6d='';
if(count($data_hep)==1)
	$d1d=$data_hep[0];
elseif(count($data_hep)==2)
{$d1d=$data_hep[0];
$d2d=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1d=$data_hep[0];
$d2d=$data_hep[1];	
$d3d=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1d=$data_hep[0];
$d2d=$data_hep[1];	
$d3d=$data_hep[2];
$d4d=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'DTP ','L',0);
$pdf->Cell(30,5,$d1d,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2d,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d3d,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d4d,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d5d,'B',0);
$pdf->Cell(12,5,"",'R',1);


//HIB
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=8";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1h='';
$d2h='';
$d3h='';
$d4h='';
if(count($data_hep)==1)
	$d1h=$data_hep[0];
elseif(count($data_hep)==2)
{$d1h=$data_hep[0];
$d2h=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1h=$data_hep[0];
$d2h=$data_hep[1];	
$d3h=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1h=$data_hep[0];
$d2h=$data_hep[1];	
$d3h=$data_hep[2];
$d4h=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'HiB ','L',0);
$pdf->Cell(30,5,$d1h,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2h,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d3h,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d4h,'B',0);
$pdf->Cell(44,5,"",'R',1);



//Polio
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=9";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1p='';
$d2p='';
$d3p='';
$d4p='';
$d5p='';
$d6p='';
if(count($data_hep)==1)
	$d1p=$data_hep[0];
elseif(count($data_hep)==2)
{$d1p=$data_hep[0];
$d2p=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1p=$data_hep[0];
$d2p=$data_hep[1];	
$d3p=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1p=$data_hep[0];
$d2p=$data_hep[1];	
$d3p=$data_hep[2];
$d4p=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'Polio ','L',0);
$pdf->Cell(30,5,$d1p,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2p,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d3p,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d4p,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d5p,'B',0);
$pdf->Cell(12,5,"",'R',1);


//ror
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=3";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1r='';
$d2r='';
$d3r='';
$d4r='';
$d5r='';
$d6r='';
if(count($data_hep)==1)
	$d1r=$data_hep[0];
elseif(count($data_hep)==2)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
$d4r=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'ROR ','L',0);
$pdf->Cell(30,5,$d1r,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2r,'B',0);
$pdf->Cell(108,5,"",'R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);

$pdf->SetFont('Arial','',18);
$pdf->Cell(115,5,'a)vaccinari optionale','L',0);
$pdf->Cell(75,5,'',0,0);
$pdf->Cell(5,5,"",'R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);


//gripal
//hwp B
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=10";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1b='';
$d2b='';
$d3b='';
$d4b='';
if(count($data_hep)==1)
	$d1b=$data_hep[0];
elseif(count($data_hep)==2)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
$d3b=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
$d3b=$data_hep[2];
$d4b=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'gripal','L',0);
$pdf->Cell(30,5,$d1b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d3b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d4b,'B',0);
$pdf->Cell(44,5,"",'R',1);


//pneumococic
//hwp B
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=11";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1b='';
$d2b='';
$d3b='';
$d4b='';
if(count($data_hep)==1)
	$d1b=$data_hep[0];
elseif(count($data_hep)==2)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
$d3b=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1b=$data_hep[0];
$d2b=$data_hep[1];	
$d3b=$data_hep[2];
$d4b=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'pneumococic ','L',0);
$pdf->Cell(30,5,$d1b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d3b,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d4b,'B',0);
$pdf->Cell(44,5,"",'R',1);



//rotavirus
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=12";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1r='';
$d2r='';
$d3r='';
$d4r='';
$d5r='';
$d6r='';
if(count($data_hep)==1)
	$d1r=$data_hep[0];
elseif(count($data_hep)==2)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
$d4r=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'rotavirus ','L',0);
$pdf->Cell(30,5,$d1r,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2r,'B',0);
$pdf->Cell(108,5,"",'R',1);



//varicela
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=13";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1r='';
$d2r='';
$d3r='';
$d4r='';
$d5r='';
$d6r='';
if(count($data_hep)==1)
	$d1r=$data_hep[0];
elseif(count($data_hep)==2)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
$d4r=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'varicela ','L',0);
$pdf->Cell(30,5,$d1r,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2r,'B',0);
$pdf->Cell(108,5,"",'R',1);



//hpv
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=14";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1r='';
$d2r='';
$d3r='';
$d4r='';
$d5r='';
$d6r='';
if(count($data_hep)==1)
	$d1r=$data_hep[0];
elseif(count($data_hep)==2)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
$d4r=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'HPV','L',0);
$pdf->Cell(30,5,$d1r,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2r,'B',0);
$pdf->Cell(108,5,"",'R',1);


//hep A
$query_vaccin="SELECT * FROM vaccinuri V, pacienti_vaccinuri PV WHERE id_pacient = $id_pacient AND V.id=PV.id_vaccin AND V.id=15";
$result_vaccin=mysqli_query($db, $query_vaccin);
$data_hep=array();
while($row_vaccin=mysqli_fetch_array($result_vaccin)){
	
	$data_hep[]=$row_vaccin['data'];
	
}
$d1r='';
$d2r='';
$d3r='';
$d4r='';
$d5r='';
$d6r='';
if(count($data_hep)==1)
	$d1r=$data_hep[0];
elseif(count($data_hep)==2)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
}
elseif(count($data_hep)==3)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
}
elseif(count($data_hep)==4)
{$d1r=$data_hep[0];
$d2r=$data_hep[1];	
$d3r=$data_hep[2];
$d4r=$data_hep[4];
}
$pdf->SetFont('Arial','',14);
$pdf->Cell(25,5,'hepatita A ','L',0);
$pdf->Cell(30,5,$d1r,'B',0);
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(30,5,$d2r,'B',0);
$pdf->Cell(108,5,"",'R',1);


//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);

$pdf->Cell(15,5,'Data:','L',0);
$pdf->Cell(30,5,date('Y-m-d'),'B',0);
$pdf->Cell(30,5,'',0,0);
$pdf->Cell(30,5,'Nume medic:',0,0);
$query_vaccin="SELECT * FROM medici  WHERE id=$id_medic";
$result_vaccin=mysqli_query($db, $query_vaccin);
$row_vaccin=mysqli_fetch_array($result_vaccin);
$nume_medic=$row_vaccin['nume'];
$prenume_medic=$row_vaccin['prenume'];
$pdf->Cell(60,5,$nume_medic.' '.$prenume_medic,0,0);
$pdf->Cell(30,5,"",'R',1);

$pdf->Cell(75,5,'','L',0);
$pdf->Cell(27,5,'Semnatura:',0,0);
$pdf->Cell(30,5,'','B',0);
$pdf->Cell(63,5,'','R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
$pdf->SetFont('Arial','',14);

//randul3-rand gol
$pdf->Cell(1,5,'','L',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(144,5,'','B',0);
$pdf->Cell(1,5,'','R',1);

$pdf->Output('F',"documente/".$nume_fisa);
$pdf->Output('D',$nume_fisa);


?>