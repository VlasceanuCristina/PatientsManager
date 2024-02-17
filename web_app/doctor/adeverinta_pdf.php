<?php 
require('fpdf182/fpdf.php');



$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
//cell(width,height,text,border, end line,align))
if(isset($_POST['adeverinta'])){
	$judet=$_POST['judet'];
	$localitate=$_POST['localitate'];
	$nr_fisa=$_POST['nr_fisa'];
	$unitate=$_POST['unitate'];
	$nume=$_POST['nume'];
	$prenume=$_POST['prenume'];
	$sex=$_POST['sex'];
	$an=$_POST['an_nastere'];
	$luna=$_POST['luna_nastere'];
	$zi=$_POST['ziua_nastere'];
	$judet_pacient=$_POST['judet_pacient'];
	$localitate_pacient=$_POST['localitate_pacient'];
	$str_pacient=$_POST['str_pacient'];
	$nr_pacient=$_POST['nr_pacient'];
	$ocupatie=$_POST['ocupatie'];
	$firma=$_POST['loc_munca'];
	$boala=$_POST['boala'];
	$recomandari=$_POST['recomandari'];
	$scop=$_POST['scop'];
	$an_data=$_POST['an'];
	$luna_data=$_POST['luna'];
	$zi_data=$_POST['zi'];
	$nume_adeverinta=$nume.'_'.$prenume.'_'.$nr_fisa.'_adeverinta'.'.pdf';
	$pdf->SetTitle($nume_adeverinta);
	$arr=array($an_data,$luna_data,$zi_data);
	$data=implode('-',$arr);
	//adaugare baza de date
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$query_select_pacient="SELECT * FROM pacienti WHERE nume='$nume' AND prenume='$prenume' AND firma='$firma'";
	$result_select_pacient=mysqli_query($db, $query_select_pacient);
	$row_select_pacient=mysqli_fetch_array($result_select_pacient);
	$id_pacient=$row_select_pacient['id'];
	$query_insert="INSERT INTO adeverinte(id_pacient,data,scop,recomandare,nr_fisa,nume_adeverinta) VALUES($id_pacient,'$data','$scop','$recomandari','$nr_fisa','$nume_adeverinta')";
	$result_insert=mysqli_query($db, $query_insert);
	/*$query="SELECT id FROM adeverinte WHERE nr_fisa='$nr_fisa'";
	$result=mysqli_query($db, $query);
	$row=mysqli_fetch_array($result);
	$id_adeverinta=$row['id'];*/
	}
//randul1
$pdf->Cell(195,5,"",'B',1);
$pdf->Cell(170,5,"",'L',0);
$pdf->Cell(25,5,"",'R',1);
//randul2
$pdf->Cell(12,5,'Judet:','L',0);
$pdf->Cell(130,5,$judet,0,0);
$pdf->Cell(53,5,"Nr.fisa/carnet de sanatate:",'R',1,'R');
//set firnt arail regukar 12
//$pdf->SetFont('Arial','',12);

//randul3
$pdf->Cell(20,5,'Localitate:','L',0);
$pdf->Cell(130,5,$localitate,0,0);
$pdf->Cell(40,5,$nr_fisa,'B',0);
$pdf->Cell(5,5,"",'R',1);

//randul4
$pdf->Cell(34,5,'Unitatea sanitara:','L',0);
$pdf->Cell(80,5,$unitate,0,0);
$pdf->Cell(81,5,'','R',1);

//randul5
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul6
$pdf->Cell(70,5,'','L',0);
$pdf->Cell(125,5,'ADEVERINTA MEDICALA','R',1);

//randul7
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul8
$pdf->Cell(35,5,'Se adevereste ca','L',0);
$pdf->Cell(10,5,'','B',0);
$pdf->Cell(50,5,$nume,'B',0);
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(50,5,$prenume,'B',0);
$pdf->Cell(15,5,'sexul',0,0);
$pdf->Cell(15,5,$sex,'B',0);
$pdf->Cell(10,5,'','R',1);

//randul9
$pdf->Cell(15,5,'Nascut:','L',0);
$pdf->Cell(10,5,'','B',0);
$pdf->Cell(40,5,$an,'B',0);
$pdf->Cell(15,5,'luna',0,0);
$pdf->Cell(40,5,$luna,'B',0);
$pdf->Cell(15,5,'ziua',0,0);
$pdf->Cell(40,5,$zi,'B',0);
$pdf->Cell(20,5,'','R',1);

//randul10
$pdf->Cell(40,5,'Cu domiciliul in: jud.','L',0);
$pdf->Cell(30,5,$judet_pacient,'B',0);
$pdf->Cell(20,5,'localitate',0,0);
$pdf->Cell(30,5,$localitate_pacient,'B',0);
$pdf->Cell(8,5,'str.',0,0);
$pdf->Cell(50,5,$str_pacient,'B',0);
$pdf->Cell(6,5,'nr.',0,0);
$pdf->Cell(6,5,$nr_pacient,'B',0);
$pdf->Cell(5,5,'','R',1);

//randul11
$pdf->Cell(40,5,'Avand ocupatia de:','L',0);
$pdf->Cell(40,5,$ocupatie,'B',0);
$pdf->Cell(5,5,'la',0,0);
$pdf->Cell(105,5,$firma,'B',0);
$pdf->Cell(5,5,'','R',1);

//radul12-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul13-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul14
$pdf->Cell(33,5,'Este duferind de:','L',0);
$pdf->Cell(160,5,$boala,'B',0);
$pdf->Cell(2,5,'','R',1);

//randul15
$pdf->Cell(30,5,'Se recomanda:','L',0);
$pdf->Cell(163,5,$recomandari,'B',0);
$pdf->Cell(2,5,'','R',1);

//radul16-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul17-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul18
$pdf->Cell(80,5,'Se elibereaza prezenta pentru a-i servi la:','L',0);
$pdf->Cell(113,5,$scop,'B',0);
$pdf->Cell(2,5,'','R',1);

//radul19-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul20-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul21
$pdf->Cell(145,5,'Data eliberarii:','L',0);
$pdf->Cell(45,5,'Semnatura si parafa medicului,',0,0,'R');
$pdf->Cell(5,5,'','R',1);

//radul 22
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(15,5,$an_data,'B',0);
$pdf->Cell(10,5,'luna',0,0);
$pdf->Cell(15,5,$luna_data,'B',0);
$pdf->Cell(10,5,'ziua',0,0);
$pdf->Cell(15,5,$zi_data,'B',0);
$pdf->Cell(80,5,'',0,0);
$pdf->Cell(45,5,'','B',0);
$pdf->Cell(3,5,'','R',1);

//radul23-linie
$pdf->Cell(170,5,"",'L',0);
$pdf->Cell(25,5,"",'R',1);
$pdf->Cell(195,5,"",'T',1);
//$pdf->Output();
$pdf->Output('F',"documente/".$nume.'_'.$prenume.'_'.$nr_fisa.'_adeverinta'.'.pdf');
$pdf->Output('D',$nume.'_'.$prenume.'_'.$nr_fisa.'_adeverinta'.'.pdf');
?>