<?php
$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
if(isset($_POST['schimbare_parola'])){
	$id_pacient=$_POST['id'];
	$parola_noua= mysqli_real_escape_string($db,$_POST['parola_noua']);
	$parola_confirmata= mysqli_real_escape_string($db,$_POST['parola_confirmata']);
	echo $parola_noua;
	echo $parola_confirmata;
	echo $id_medic;
	//echo "ana";
	// form validation: ensure that the form is correctly filled
	if (empty($parola_noua)) { array_push($errors, "Completeaza parola!"); }
	if (empty($parola_confirmata)) { array_push($errors, "Confirma parola!"); }
	if ($parola_noua != $parola_confirmata) {
		array_push($errors, "Cele doua parole introduse sunt diferite!");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($parola_noua);//encrypt the password before saving in the database
		$query = "UPDATE pacienti SET password='$password' WHERE id=$id_medic)";
		mysqli_query($db, $query);
		
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "Parola schimbata cu succes!!!";
		header('location: login.php');
	}
}
?>