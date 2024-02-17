<?php if($_POST['update_patient']){
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		$id_medic=$_POST['id_pacient'];
		$nume=$_POST['nume'];
		$prenume=$_POST['prenume'];
		$cnp=$_POST['cnp'];
		$telefon=$_POST['telefon'];
		$grupa_sange=$_POST['grupa_sange'];
		$rh=$_POST['rh'];
		$adresa=$_POST['adresa'];
		$asigurat=$_POST['asigurat'];
		$cas=$_POST['denumire_cas'];
		echo $cas;
		$id_medic=$_POST['id_medic'];
		$query_update = "UPDATE pacienti SET nume='$nume', prenume='$prenume',cnp='$cnp',telefon='$telefon',adresa='$adresa',grupa_sange='$grupa_sange',rh='$rh',asigurat='$asigurat', denumire_cas='$cas' WHERE id= $id_pacient";
		$results = mysqli_query($db, $query_update);
		
		header('Location:afisare_pacienti.php?admin='.$id_medic);
}
?>