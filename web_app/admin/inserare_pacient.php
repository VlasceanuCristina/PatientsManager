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
			$cas = $_POST['cas'];
			$medic=explode(' ',$_POST['medic']);
			$parola=$_POST['parola'];
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$result = mysqli_query($db, "select * from medici where nume='$medic[0]' and prenume='$medic[1]'");
			$row=mysqli_fetch_assoc($result);
			$id_medic=$row['id'];
			echo $id_medic;
			echo $parola;
			$id_admin=$_POST['id_admin'];
			mysqli_query($db, "INSERT INTO pacienti(nume, prenume, data_nastere, telefon, adresa, cnp,email,asigurat, denumire_cas,id_medic,password) VALUES('$nume', '$prenume','$data_nastere', '$telefon','$adresa','$cnp','$email','$asigurat','$cas',$id_medic,'$parola')");
			header('Location:afisare_pacienti.php?admin='.$id_admin);
		}
	?>