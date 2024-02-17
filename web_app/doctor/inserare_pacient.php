<?php
		if(isset($_POST['submit'])){
			$nume = $_POST['nume'];
			$prenume = $_POST['prenume'];
			$data_nastere = $_POST['data_nastere'];
			$cnp = $_POST['cnp'];
			$telefon = $_POST['telefon'];
			$adresa = $_POST['adresa'];
			$email = $_POST['email'];
			$asigurat = $_POST['asigurat'];
			$grupa_sange = $_POST['grupa_sange'];
			$cas = $_POST['cas'];
			$id_medic=$_POST['id_medic'];
			$data_inscriere=date('Y-m-d');
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			//$nume = mysqli_real_escape_string($db, $_REQUEST['nume']);
			mysqli_query($db, "INSERT INTO pacienti(nume, prenume, data_nastere, telefon, adresa, cnp,email,asigurat, grupa_sange, denumire_cas,id_medic, data_inscriere) VALUES('$nume', '$prenume','$data_nastere', '$telefon','$adresa','$cnp','$email','$asigurat','$grupa_sange','$cas',$id_medic, $data_inscriere)");
			header('Location:afisare_pacienti.php?medic='.$id_medic);
		}
	?>