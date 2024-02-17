<?php
		if(isset($_POST['submit'])){
			$nume = $_POST['nume'];
			$prenume = $_POST['prenume'];
			$cnp = $_POST['cnp'];
			$telefon = $_POST['telefon'];
			$email = $_POST['email'];
			$cas = $_POST['cas'];
			$parola=$_POST['parola'];
			$nr_contract=$_POST['nr_contract'];
			$cod_parafa=$_POST['cod_parafa'];
			$id_admin=$_POST['id_admin'];
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			mysqli_query($db, "INSERT INTO medici(nume, prenume, telefon, cnp_medic,email, denumire_cas,password,nr_contract_cas, cod_parafa) VALUES('$nume', '$prenume', '$telefon','$cnp','$email','$cas','$parola','$nr_contract','$cod_parafa')");
			header('Location:afisare_medici.php?admin='.$id_admin);
		}
	?>