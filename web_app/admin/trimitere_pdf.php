<?php 
//require('fpdf182/fpdf.php');
require('pdf_barcode.php');


$pdf = new PDF_BARCODE('P','mm','A4');
//$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
//cell(width,height,text,border, end line,align))
if(isset($_POST['bilet_trimitere'])){
	$serie=$_POST['serie_trimitere'];
	$nr=$_POST['numar_trimitere'];
	$cui=$_POST['cui'];
	$sediu=$_POST['adresa'];
	$judet=$_POST['judet'];
	$nr_contract=$_POST['nr_contract'];
	$cas=$_POST['cas'];
	$nume_asigurat=$_POST['nume_asigurat'];
	$prenume_asigurat=$_POST['prenume_asigurat'];
	$adresa_asigurat=$_POST['adresa_asigurat'];
	$cetatenie=$_POST['cetatenie'];
	$cas_asigurat=$_POST['cas_asigurat'];
	$data_trimitere=$_POST['data_trimitere'];
	$cod_parafa=$_POST['cod_parafa'];
	$cnp=$_POST['cnp_asigurat'];
	$check11='';
	$check12='';
	$check13='';
	$check21='';
	$check22='';
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
	$check41='';
	$check42='';
	$check43='';
	$check44='';
	$cod_inv1=$_POST['cod1'];
	$inv_rec1=$_POST['rec1'];
	$cod_inv2=$_POST['cod2'];
	$inv_rec2=$_POST['rec2'];
	if(isset($_POST['opt1'])){
		$dest=$_POST['opt1'];
		$check11='4';
	}
	else{
		if(isset($_POST['opt2'])){
			$dest=$_POST['opt2'];
			$check12='4';
		}
		else{
			if(isset($_POST['opt2']))
				$dest=$_POST['opt3'];
				$check13='4';
		}
	}
	
	
	if(isset($_POST['opt4'])){
		$prioritate=$_POST['opt4'];
		$check21='4';
	}
	else{
		if(isset($_POST['opt5'])){
			$prioritate=$_POST['opt5'];
			$check22='4';
		}
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
	
	$cod_diagnostic=$_POST['cod_diagnostic'];
	$diagnostic=$_POST['diagnostic'];
	if(isset($_POST['opt22'])){
		$optiune=$_POST['opt22'];
		$check41='4';
	}
	elseif(isset($_POST['opt23'])){
		$optiune=$_POST['opt23'];
		$check42='4';
	}
	elseif(isset($_POST['opt24'])){
		$optiune=$_POST['opt24'];
		$check43='4';
	}
	elseif(isset($_POST['opt25'])){
		$optiune=$_POST['opt25'];
		$check44='4';
	}
	
	$persoana_servicii=$_POST['persoana_servicii'];
	$data_prezentare=$_POST['data'];
	$nume_trimitere=$nume_asigurat.'_'.$prenume_asigurat.'_'.$serie.'_'.$nr.'_trimitere'.'.pdf';
	//adaugare baza de date
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
	$query_select_pacient="SELECT * FROM pacienti WHERE nume='$nume_asigurat' AND prenume='$prenume_asigurat' ";
	$result_select_pacient=mysqli_query($db, $query_select_pacient);
	$row_select_pacient=mysqli_fetch_array($result_select_pacient);
	$id_pacient=$row_select_pacient['id'];
	$query_insert="INSERT INTO bilete_trimitere(id_pacient,data_trimiterii,serie_trimitere,nr_trimitere,nume_trimitere) VALUES($id_pacient,'$data_trimitere','$serie','$nr','$nume_trimitere')";
	$result_insert=mysqli_query($db, $query_insert);
	
	}
//randul1
$pdf->Cell(195,5,"",'B',1);
$pdf->Cell(170,5,"",'L',0);
$pdf->Cell(25,5,"",'R',1);
//randul2
$pdf->Cell(193,5,'Bilet de trimitere pentru investigatii paraclinice decontate de CAS','L',0,'C');
$pdf->Cell(2,5,"",'R',1);
//set firnt arail regukar 12
//$pdf->SetFont('Arial','',12);

//randul3-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);
//randul 4
$pdf->Cell(40,5,"",'L',0);
$pdf->Cell(15,5,"Serie:",0,0);
$pdf->Cell(20,5,$serie,'B',0);
$pdf->Cell(10,5,"Nr:",0,0);
$pdf->Cell(10,5,$nr,'B',0);
$pdf->EAN13(110,30,'6789999999', 5, 0.35, 9);
$pdf->Cell(95,5,'',0,0);
$pdf->Cell(5,5,'','R',1);

//radul15-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul 6-gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul 7
$pdf->SetFont('Arial','',12);
$pdf->Cell(145,5,'1.Unitatea medicala','L',0);
$pdf->Cell(5, 5,'', 'R', 0);
$pdf->Cell(45, 5, '', 'R', 1);

//randul 8
$pdf->Cell(10,5,'CUI:','L',0);
$pdf->Cell(110,5,$cui,'B',0);
//$pdf->Cell(35,5,'',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(140);
$pdf->Cell(5, 5, $check11, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'MF','R',0);
$pdf->Cell(45,5,'Nivel de prioritate:','R',1);

//randul 9
$pdf->Cell(60,5,'Sediu(localiate,strada,numar):','L',0);
$pdf->Cell(60,5,$sediu,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(140);
$pdf->Cell(5, 5, $check12, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'Amb.','R',0);
$pdf->Cell(15,5,'Urgenta',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(180);
$pdf->Cell(5, 5, $check21, 1, 0);
$pdf->Cell(20,5,'','R',1);

//randul 10
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'Judetul:','L',0);
$pdf->Cell(105,5,$judet,'B',0);
$pdf->Cell(15,5,'',0,0);
$pdf->Cell(15,5,'Spec.','R',0);
$pdf->Cell(15,5,'Curente',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(180);
$pdf->Cell(5, 5, $check22, 1, 0);
$pdf->Cell(20,5,'','R',1);

//randul 11
$pdf->SetFont('Arial','',12);
$pdf->Cell(35,5,'Casa de asigurari:','L',0);
$pdf->Cell(85,5,$cas,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(140);
$pdf->Cell(5, 5, $check11, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'Altele','R',0);
$pdf->Cell(45,5,'','R',1);

//randul 12-gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//radul113-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul 13-gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul 14
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,5,'2.Date de identificare asigurat','L',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check31, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'salariat',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check39, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'veteran','R',1);


//randul 15
$pdf->SetFont('Arial','',12);
$pdf->Cell(25,5,'Asigurat la:','L',0);
$pdf->Cell(50,5,$cas_asigurat,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check32, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'coasigurat',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check310, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'revolutionar','R',1);

//randul 16
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'Nume:','L',0);
$pdf->Cell(50,5,$nume_asigurat,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check33, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'liber-profesionist',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check311, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'handicap','R',1);

//randul 17
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,5,'Prenume:','L',0);
$pdf->Cell(50,5,$prenume_asigurat,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check34, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'copil(<18 ani)',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check312, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'PNS...','R',1);

//randul 18
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'Adresa:','L',0);
$pdf->Cell(90,5,$adresa_asigurat,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check35, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'elev/ucenic',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check313, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'ajutor social','R',1);

//randul 19
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'Cnp:','L',0);
$pdf->Cell(90,5,$cnp,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check36, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'gravida/lehuza',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check315, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'somaj','R',1);


//randul 21
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,5,'Cetatenie:','L',0);
$pdf->Cell(85,5,$cetatenie,'B',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check37, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'pensionar',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check315, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'card european(CE)','R',1);

//randul 20
$pdf->Cell(15,5,'','L',0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(120);
$pdf->Cell(5, 5, $check38, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,'alte categorii',0,0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(160);
$pdf->Cell(5, 5, $check316, 1, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,5,'acorduri','R',1);

//randul 22
$pdf->Cell(15,5,'','L',0);
$pdf->SetX(165);
$pdf->Cell(40,5,'internationale','R',1);


//radul1 24-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//randul25-gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul 26
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,5,'Cod diagnostic:','L',0);
$pdf->Cell(70,5,'Diagnostic:',0,0);
$pdf->Cell(30,5,'',0,0);
$pdf->Cell(35,5,'P A/S C M','R',1);

//randul 27
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(30,5,$cod_diagnostic,1,0);
$pdf->SetX(60);
$pdf->Cell(60,5,$diagnostic,'B',0);

$pdf->SetFont('ZapfDingbats','', 10);
$pdf->SetX(170);
$pdf->Cell(5, 5, $check41, 1, 0);
$pdf->Cell(5, 5, $check42, 1, 0);
$pdf->Cell(5, 5, $check43, 1, 0);
$pdf->Cell(5, 5, $check44, 1, 0);
$pdf->SetX(190);
$pdf->Cell(15,5,'','R',1);
//randul28-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//randul 26
$pdf->SetFont('Arial','',12);
$pdf->Cell(27,5,'Data trimiterii:','L',0);
$pdf->Cell(25,5,$data_trimitere,'B',0);
$pdf->Cell(43,5,'Semnatura medicului:',0,0);
$pdf->Cell(20,5,'','B',0);
$pdf->Cell(15,5,'','',0);
$pdf->Cell(25,5,'Cod parafa:',0,0);
$pdf->Cell(35,5,$cod_parafa,'B',0);
$pdf->Cell(5,5,'','R',1);


//randul28-rand gol
$pdf->Cell(50,5,'','L',0);
$pdf->Cell(145,5,'','R',1);

//radul1 29-linie
$pdf->Cell(2,5,'','L',0);
$pdf->Cell(191,5,'','B',0);
$pdf->Cell(2,5,'','R',1);

//
$pdf->Cell(50,5,'4.','L',0);
$pdf->Cell(145,5,'','R',1);

//tabel
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(185,5,'','B',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'Pozitia','L',0);
$pdf->Cell(60,5,'Cod investigatie','L',0);
$pdf->Cell(50,5,'Investigatii recomandate','L',0);
$pdf->Cell(40,5,'Investigatii efectuate','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);



//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'1','L',0);
$pdf->Cell(60,5,$cod_inv1,'L',0);
$pdf->Cell(50,5,$inv_rec1,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'2','L',0);
$pdf->Cell(60,5,$cod_inv2,'L',0);
$pdf->Cell(50,5,$inv_rec2,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'3','L',0);
$pdf->Cell(60,5,$cod_inv2,'L',0);
$pdf->Cell(50,5,$inv_rec2,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'4','L',0);
$pdf->Cell(60,5,$cod_inv2,'L',0);
$pdf->Cell(50,5,$inv_rec2,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'5','L',0);
$pdf->Cell(60,5,$cod_inv2,'L',0);
$pdf->Cell(50,5,$inv_rec2,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'6','L',0);
$pdf->Cell(60,5,$cod_inv2,'L',0);
$pdf->Cell(50,5,$inv_rec2,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);


//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'7','L',0);
$pdf->Cell(60,5,$cod_inv2,'L',0);
$pdf->Cell(50,5,$inv_rec2,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//
$pdf->Cell(5,5,'','L',0);
$pdf->Cell(20,5,'8','L',0);
$pdf->Cell(60,5,$cod_inv2,'L',0);
$pdf->Cell(50,5,$inv_rec2,'L',0);
$pdf->Cell(40,5,'','L',0);
$pdf->Cell(15,5,'','R',0);
$pdf->Cell(5,5,'','R',1);

//underline
$pdf->Cell(4,5,'','L',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(19,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(59,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(49,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(54,5,'','B',0);
$pdf->Cell(1,5,'','R',0);
$pdf->Cell(5,5,'','R',1);



//randul3-rand gol
$pdf->Cell(1,5,'','L',0);
$pdf->Cell(193,5,'','B',0);
$pdf->Cell(1,5,'','R',1);

$pdf->Output('F',"documente/".$nume_trimitere);
$pdf->Output('D',$nume_trimitere);
?>