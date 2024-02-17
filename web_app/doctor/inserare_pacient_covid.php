<?php
		if(isset($_POST['submit'])){
			$nume = $_POST['nume'];
			$prenume = $_POST['prenume'];
			$data_infectare = $_POST['data_infectare'];
			$stadiu = $_POST['stadiu'];
			$id_medic=$_POST['id_medic'];
			echo $id_medic;
			$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
			$query_total = "SELECT * FROM pacienti where nume='$nume' and prenume='$prenume'";	
			$results = mysqli_query($db, $query_total);
			$row = mysqli_fetch_assoc($results);
			$id_pacient=$row['id'];
			mysqli_query($db, "INSERT INTO pacienti_covid(id_pacient, data_infectare, stadiu) VALUES($id_pacient,'$data_infectare', '$stadiu')");
			header('Location:pacienti_covid.php?medic='.$id_medic);
		}
	?>