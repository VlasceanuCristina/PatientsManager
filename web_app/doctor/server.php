<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'patients_manager');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Completeaza numele de utilizator!"); }
		if (empty($email)) { array_push($errors, "Completeaza email-ul!"); }
		if (empty($password_1)) { array_push($errors, "Completeaza parola!"); }

		if ($password_1 != $password_2) {
			array_push($errors, "Cele doua parole introduse sunt diferite!");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO login (username,password, email) 
					  VALUES('$username','$password','$email')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "Te-ai inregistrat cu succes!!!";
			header('location: login.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Completeaza email-ul!");
		}
		if (empty($password)) {
			array_push($errors, "Completeaza parola!");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM medici WHERE email='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			$row= mysqli_fetch_array($results);
			$id_medic = $row['id'];
			if($id_medic){
			header('location: acasa.php?medic='.$id_medic);}
			else{
			array_push($errors, "Combinatia nume de utilizator/parola este gresita");
			}
			}else {
				array_push($errors, "Combinatia nume de utilizator/parola este gresita");
			}
		
	}

?>