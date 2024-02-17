<?php 
require_once('fpdf182/fpdf.php');
require_once('FPDI-master/autoload.php');use \setasign\Fpdi\Fpdi;
$pdf = new FPDI();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);


$text = "GEEKS FOR GEEKS";
//cell(width,height,text,border, end line,align))
if(isset($_POST['reteta'])){
	$serie=$_POST['serie_reteta'];
	$denumire_cabinet=$_POST['denumire_cabinet'];
	$nr=$_POST['numar_reteta'];
	$categorie_unitate=$_POST['categorie_unitate'];
	$cui=$_POST['cui'];
	$nr_contract=$_POST['nr_contract'];
	$nume_asigurat=$_POST['nume_asigurat'];
	$prenume_asigurat=$_POST['prenume_asigurat'];
	$cetatenie=$_POST['cetatenie'];
	$cas_asigurat=$_POST['cas_asigurat'];
	$cid=$_POST['cid'];
	$sex=$_POST['sex'];
	$data_nastere=$_POST['data_nastere'];
	$categorie_asigurat=$_POST['categorie_asigurat'];
	$diagnostic=$_POST['diagnostic'];
	$cod_diagnostic=$_POST['cod_diagnostic'];
	$data_prescriere=$_POST['data_prescriere'];
	$nr_zile=$_POST['nr_zile'];
	$cod_parafa=$_POST['parafa_medic'];
	$cod1=$_POST['cod1'];
	$tip1=$_POST['tip1'];
	$denumire1=$_POST['denumire1'];
	$ds1=$_POST['ds1'];
	$cantitate1=$_POST['cantitate1'];
	$pret1=$_POST['pret1'];
	$lista1=$_POST['lista1'];
	$cod2=$_POST['cod2'];
	$tip2=$_POST['tip2'];
	$denumire2=$_POST['denumire2'];
	$ds2=$_POST['ds2'];
	$cantitate2=$_POST['cantitate2'];
	$pret2=$_POST['pret2'];
	$lista2=$_POST['lista2'];
	$cod3=$_POST['cod3'];
	$tip3=$_POST['tip3'];
	$denumire3=$_POST['denumire3'];
	$ds3=$_POST['ds3'];
	$cantitate3=$_POST['cantitate3'];
	$pret3=$_POST['pret3'];
	$lista3=$_POST['lista3'];
	$aprobat_decizie=$_POST['aprobat_comisie'];
	$nr_decizie=$_POST['nr_decizie'];
	$data_decizie=$_POST['data_decizie'];
	$c11='';
	$c12='';
	$c13='';
	$c14='';
	$c15='';
	$ch='';
	$check31='';
	$check32='';
	$check33='';
	$check34='';
	$check35='';
	$check36='';
	$check37='';
	$check38='';
	$check39='';
	$check310='';
	$check311='';
	$check312='';
	$check313='';
	$check314='';
	$check315='';
	$check316='';
	$check317='';
	if($categorie_unitate=="MF"){
		$c11='4';
	}
	elseif($categorie_unitate=="Ambulatoriu"){
		$c12='4';
	}
	elseif($categorie_unitate=="Spital"){
		$c13='4';
	}
	elseif($categorie_unitate=="Altele"){
		$c14='4';
	}
	elseif($categorie_unitate=="MF-MM"){
		$c15='5';
	}
	if($categorie_unitate=="MF"){
		$c11='4';
	}
	if($aprobat_decizie=='DA'){
		$ch='4';
	}
	
	if(isset($_POST['opt6'])){
		$categorie=$_POST['opt6'];
		$check31='4';
	}
	elseif(isset($_POST['opt7'])){
		$categorie=$_POST['opt7'];
		$check32='4';
	}
	elseif(isset($_POST['opt8'])){
		$categorie=$_POST['opt8'];
		$check33='4';
	}
	elseif(isset($_POST['opt9'])){
		$categorie=$_POST['opt9'];
		$check34='4';
	}
	elseif(isset($_POST['opt10'])){
		$categorie=$_POST['opt10'];
		$check35='4';
	}
	elseif(isset($_POST['opt11'])){
		$categorie=$_POST['opt11'];
		$check36='4';
	}
	elseif(isset($_POST['opt12'])){
		$categorie=$_POST['opt12'];
		$check37='4';
	}
	elseif(isset($_POST['opt13'])){
		$categorie=$_POST['opt13'];
		$check38='4';
	}
	elseif(isset($_POST['opt14'])){
		$categorie=$_POST['opt14'];
		$check39='4';
	}
	elseif(isset($_POST['opt15'])){
		$categorie=$_POST['opt15'];
		$check310='4';
	}
	elseif(isset($_POST['opt16'])){
		$categorie=$_POST['opt16'];
		$check311='4';
	}
	elseif(isset($_POST['opt17'])){
		$categorie=$_POST['opt17'];
		$check312='4';
	}
	elseif(isset($_POST['opt18'])){
		$categorie=$_POST['opt18'];
		$check314='4';
	}
	elseif(isset($_POST['opt19'])){
		$categorie=$_POST['opt19'];
		$check315='4';
	}
	elseif(isset($_POST['opt20'])){
		$categorie=$_POST['opt20'];
		$check316='4';
	}
	elseif(isset($_POST['opt21'])){
		$categorie=$_POST['opt21'];
		$check317='4';
	}
	
	$nume_reteta=$nume_asigurat.'_'.$prenume_asigurat.'_'.$serie.'_'.$nr.'_reteta'.'.pdf';
	$pdf->SetTitle($nume_reteta);
	
	//adaugare baza de date
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$query_select_pacient="SELECT * FROM pacienti WHERE nume='$nume_asigurat' AND prenume='$prenume_asigurat'";
	$result_select_pacient=mysqli_query($db, $query_select_pacient);
	$row_select_pacient=mysqli_fetch_array($result_select_pacient);
	$id_pacient=$row_select_pacient['id'];
	$query_insert="INSERT INTO retete(id_pacient,data,nume_reteta,serie_reteta,nr_reteta, diagnostic,nr_zile) VALUES($id_pacient,'$data_prescriere','$nume_reteta', '$serie','$nr','$diagnostic','$nr_zile')";
	$result_insert=mysqli_query($db, $query_insert);
	
}

//randul1
$pdf->Cell(195,5,"",'B',1);
$pdf->Cell(170,5,"",'L',0);
$pdf->Cell(25,5,"",'R',1);

//randul2
$pdf->Cell(193,5,'Prescriere medic','L',0,'C');
$pdf->Cell(2,5,"",'R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul4
$pdf->Cell(15,5,'Serie:','L',0);
$pdf->Cell(20,5,$serie,'B',0);
$pdf->Cell(30,5,'',0,0);
$pdf->Cell(20,5,'Numar:',0,0);
$pdf->Cell(20,5,$nr,'B',0);
$pdf->Cell(90,5,'','R',1);


//randul5-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul6
$pdf->Cell(120,5,'1.Unitatea medicala','L',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5,5,$c11,1,0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(15,5,'MF',0,0);
$pdf->Cell(65,5,'','R',1,'R');

$pdf->Image("http://localhost/licenta08.02.2020/doctor/QR.php",160,30,40,40,"png");

//randul 7
$pdf->Cell(1,5,'','L',0);
$pdf->Cell(100,5,$denumire_cabinet,'B',0);
$pdf->Cell(19,5,'',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5,5,$c12,1,0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(20,5,'Ambulatoriu',0,0);
$pdf->Cell(60,5,'','R',1);

//randul 8
$pdf->Cell(10,5,'CUI:','L',0);
$pdf->Cell(20,5,$cui,'B',0);
$pdf->Cell(90,5,'',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5,5,$c13,1,0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(15,5,'Spital',0,0);
$pdf->Cell(65,5,'','R',1,'R');

//randul 9
$pdf->Cell(55,5,'CAS contract/conventie:','L',0);
$pdf->Cell(20,5,$nr_contract,'B',0);
$pdf->Cell(45,5,'',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5,5,$c14,1,0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(15,5,'Altele',0,0);
$pdf->Cell(65,5,'','R',1);

//randul 10
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(10);
$pdf->Cell(5,5,'',1,0);
$pdf->SetFont('Arial','',14);   
$pdf->Cell(65,5,'Aprobat Comisie',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5,5,$c15,1,0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(15,5,'MF-MM',0,0);
$pdf->Cell(65,5,'','R',1);

//randul 12
$pdf->Cell(1,5,'','L',0);
$pdf->Cell(50,5,$nr_decizie,'B',0);
$pdf->Cell(1,5,'/',0,0);
$pdf->Cell(30,5,$data_decizie,'B',0);
$pdf->Cell(113,5,'','R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//radul1 29-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//
$pdf->Cell(20,5,'2.Asigurat','L',0);
$pdf->Cell(90,5,'',0,0);
$pdf->Cell(5,5,$check31,1,0);
$pdf->Cell(40,5,'salariat',0,0);
$pdf->Cell(5,5,$check310,1,0);
$pdf->Cell(35,5,'revolutionar','R',1);

//
$pdf->Cell(15,5,'Nume:','L',0);
$pdf->Cell(92,5,$nume_asigurat,'B',0);
$pdf->Cell(3,5,'',0,0);
$pdf->Cell(5,5,$check32,1,0);
$pdf->Cell(40,5,'co-asigurat',0,0);
$pdf->Cell(5,5,$check311,1,0);
$pdf->Cell(35,5,'handicap','R',1);

//
$pdf->Cell(22,5,'Prenume:','L',0);
$pdf->Cell(85,5,$prenume_asigurat,'B',0);
$pdf->Cell(3,5,'',0,0);
$pdf->Cell(5,5,$check33,1,0);
$pdf->Cell(40,5,'liber-profesionist',0,0);
$pdf->Cell(5,5,$check312,1,0);
$pdf->Cell(35,5,'PNS','R',1);

//
$pdf->Cell(10,5,'CID:','L',0);
$pdf->Cell(97,5,$cid,'B',0);
$pdf->Cell(3,5,'',0,0);
$pdf->Cell(5,5,$check34,1,0);
$pdf->Cell(40,5,'copil',0,0);
$pdf->Cell(5,5,$check313,1,0);
$pdf->Cell(35,5,'ajutor social','R',1);

//
$pdf->Cell(30,5,'Data nasterii:','L',0);
$pdf->Cell(77,5,$data_nastere,'B',0);
$pdf->Cell(3,5,'',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5,5,'4',1,0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(40,5,'elev',0,0);
$pdf->Cell(5,5,$check314,1,0);
$pdf->Cell(35,5,'somaj','R',1);

//
$pdf->Cell(10,5,'Sex:','L',0);
$pdf->Cell(97,5,$sex,'B',0);
$pdf->Cell(3,5,'',0,0);
$pdf->Cell(5,5,$check36,1,0);
$pdf->Cell(40,5,'gravida',0,0);
$pdf->Cell(5,5,$check315,1,0);
$pdf->Cell(35,5,'card european','R',1);

//
$pdf->Cell(25,5,'Cetatenie:','L',0);
$pdf->Cell(82,5,$cetatenie,'B',0);
$pdf->Cell(3,5,'',0,0);
$pdf->Cell(5,5,$check37,1,0);
$pdf->Cell(40,5,'pensionar',0,0);
$pdf->Cell(5,5,$check316,1,0);
$pdf->Cell(35,5,'acorduri','R',1);

//
$pdf->Cell(10,5,'','L',0);
$pdf->Cell(97,5,'',0,0);
$pdf->Cell(3,5,'',0,0);
$pdf->Cell(5,5,'',0,0);
$pdf->Cell(40,5,'',0,0);
$pdf->Cell(5,5,'',0,0);
$pdf->Cell(35,5,'internationale','R',1);

//
$pdf->Cell(25,5,'','L',0);
$pdf->Cell(82,5,'',0,0);
$pdf->Cell(3,5,'',0,0);
$pdf->Cell(5,5,$check38,1,0);
$pdf->Cell(40,5,'veteran',0,0);
$pdf->Cell(5,5,$check317,1,0);
$pdf->Cell(35,5,'altele','R',1);


//radul1 29-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
//
$pdf->Cell(30,5,'3.Diagnostic:','L',0);
$pdf->Cell(164,5,$diagnostic,'B',0);
$pdf->Cell(1,5,'','R',1);

$pdf->Cell(34,5,'Cod diagnostic:','L',0);
$pdf->Cell(160,5,$cod_diagnostic,'B',0);
$pdf->Cell(1,5,'','R',1);

//radul1 29-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//
$pdf->Cell(35,5,'Data prescriere:','L',0);
$pdf->Cell(30,5,$data_prescriere,'B',0);
$pdf->Cell(50,5,'',0,0);
$pdf->Cell(50,5,'Numar zile prescriere:',0,0);
$pdf->Cell(20,5,$nr_zile,'B',0);
$pdf->Cell(10,5,'','R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//tabel
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(185,5,'','B',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'Poz.','L',0);
$pdf->Cell(25,5,'Cod diag.','L',0);
$pdf->Cell(75,5,'Denumire comuna internationala','L',0);
$pdf->Cell(12,5,'D.S.','L',0);
$pdf->Cell(23,5,'Cantitate','L',0);
$pdf->Cell(20,5,'Pret ref.','L',0);
$pdf->Cell(15,5,'Lista','L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);
//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'1','L',0);
$pdf->Cell(25,5,$cod1,'L',0);
$pdf->Cell(75,5,$denumire1,'L',0);
$pdf->Cell(12,5,$ds1,'L',0);
$pdf->Cell(23,5,$cantitate1,'L',0);
$pdf->Cell(20,5,$pret1,'L',0);
$pdf->Cell(15,5,$lista1,'L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);
//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'2','L',0);
$pdf->Cell(25,5,$cod2,'L',0);
$pdf->Cell(75,5,$denumire2,'L',0);
$pdf->Cell(12,5,$ds2,'L',0);
$pdf->Cell(23,5,$cantitate2,'L',0);
$pdf->Cell(20,5,$pret2,'L',0);
$pdf->Cell(15,5,$lista2,'L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'3','L',0);
$pdf->Cell(25,5,$cod3,'L',0);
$pdf->Cell(75,5,$denumire3,'L',0);
$pdf->Cell(12,5,$ds3,'L',0);
$pdf->Cell(23,5,$cantitate3,'L',0);
$pdf->Cell(20,5,$pret3,'L',0);
$pdf->Cell(15,5,$lista3,'L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'4','L',0);
$pdf->Cell(25,5,$cod3,'L',0);
$pdf->Cell(75,5,$denumire3,'L',0);
$pdf->Cell(12,5,$ds3,'L',0);
$pdf->Cell(23,5,$cantitate3,'L',0);
$pdf->Cell(20,5,$pret3,'L',0);
$pdf->Cell(15,5,$lista3,'L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'5','L',0);
$pdf->Cell(25,5,$cod3,'L',0);
$pdf->Cell(75,5,$denumire3,'L',0);
$pdf->Cell(12,5,$ds3,'L',0);
$pdf->Cell(23,5,$cantitate3,'L',0);
$pdf->Cell(20,5,$pret3,'L',0);
$pdf->Cell(15,5,$lista3,'L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'6','L',0);
$pdf->Cell(25,5,$cod3,'L',0);
$pdf->Cell(75,5,$denumire3,'L',0);
$pdf->Cell(12,5,$ds3,'L',0);
$pdf->Cell(23,5,$cantitate3,'L',0);
$pdf->Cell(20,5,$pret3,'L',0);
$pdf->Cell(15,5,$lista3,'L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(12,5,'7','L',0);
$pdf->Cell(25,5,$cod3,'L',0);
$pdf->Cell(75,5,$denumire3,'L',0);
$pdf->Cell(12,5,$ds3,'L',0);
$pdf->Cell(23,5,$cantitate3,'L',0);
$pdf->Cell(20,5,$pret3,'L',0);
$pdf->Cell(15,5,$lista3,'L',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);



//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(24,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(74,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(11,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(22,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(3,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul3-rand gol
$pdf->Cell(1,5,'','L',0);
$pdf->Cell(193,5,'','B',0);
$pdf->Cell(1,5,'','R',1);

$pdf->Output('F',"documente/".$nume_reteta);
$pdf->Output('D',$nume_reteta);
header('Location:adaugare_consultatie.php');
?>
