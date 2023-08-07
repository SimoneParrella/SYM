<?php 
session_start(); 

// Includiamo il file di connessione al database
include "../../db/db_conn.php";

// Includiamo il file di gestione del login
include "../pages/signin.php";

// Funzione per validare l'input
function valid_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Controlliamo se tutti i campi sono stati inseriti
if (isset($_POST['uname']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['re_password'])) {

	// Validiamo l'input
	$uname = valid_input($_POST['uname']);
	$pass = valid_input($_POST['password']);
	$re_pass = valid_input($_POST['re_password']);
	$name = valid_input($_POST['name']);

	// Creiamo una stringa contenente i dati dell'utente
	$user_data = 'uname='. $uname. '&name='. $name;

	// Controlliamo se l'username è vuoto
	if (empty($uname)) {
		$error_msg = "Name is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	} else if(empty($pass)){
		$error_msg = "Password is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	} else if(empty($re_pass)){
		$error_msg = "Confirm assword is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	} else if(empty($name)){
		$error_msg = "User Name is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	} else if($pass != $re_pass){
		$error_msg = "The confirmation password  does not match";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	} else {
		// Se tutti i campi sono stati inseriti, hashiamo la password
		$pass = md5($pass);

		// Controlliamo se l'username è già presente nel database
		$sql = "SELECT * FROM users WHERE user_name='$uname' ";
		$result = pg_query($conn, $sql);

		if (pg_num_rows($result) > 0) {
			// Se l'username è già presente, mostrare un errore
			header("Location: /web/pages/signup.php?error=The username is taken try another&$user_data");
	        exit();
		} else {
			// Se l'username non è presente, inseriamo i dati dell'utente nel database
	        $sql2 = "INSERT INTO users(user_name, password, name) VALUES('$uname', '$pass', '$name')";
			$result2 = pg_query($conn, $sql2);
			if ($result2) {
				// Se l'operazione è andata a buon fine, mostrare un messaggio di success
			   header("Location: /web/pages/signup.php?success=Your account has been created successfully");
	         exit();
           }else {
			//altrimenti mostrami un messaggio d'errore
			   header("Location: /web/pages/signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
//se tutti i campi non sono stati inseriti,ritorna alla pagina di signup
}else{
	header("Location: /web/pages/signup.php");
	exit();
}
?>