<?php if($_POST['update_medic']){
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		$id_medic=$_POST['id_medic'];
		$id_admin=$_POST['id_admin'];
		$nume=$_POST['nume'];
		$prenume=$_POST['prenume'];
		$cod_parafa=$_POST['cod_parafa'];
		$telefon=$_POST['telefon'];
		$nr_contract=$_POST['nr_contract'];
		$cas=$_POST['denumire_cas'];
		$query_update = "UPDATE medici SET nume='$nume', prenume='$prenume',telefon='$telefon',nr_contract_cas='$nr_contract', denumire_cas='$cas', cod_parafa='$cod_parafa' WHERE id= $id_medic";
		$results = mysqli_query($db, $query_update);
		
		header('Location:afisare_medici.php?admin='.$id_admin);
}
?>