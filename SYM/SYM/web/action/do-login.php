<?php 
session_start(); 
include "../../db/db_conn.php";

// verifica che i campi user_name e password siano stati inviati tramite il metodo POST
if (isset($_POST['uname']) && isset($_POST['password'])) {

	// definisce una funzione per validare l'input
	function valid_input($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	// valida i campi user_name e password
	$uname = valid_input($_POST['uname']);
	$pass = valid_input($_POST['password']);

	// se user_name o password sono vuoti, reindirizza alla pagina di login con un messaggio di errore
	if (empty($uname)) {
		header("Location: /web/pages/signin.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
		header("Location: /web/pages/signin.php?error=Password is required");
	    exit();
	}else{
		// crittografa la password
        $pass = md5($pass);

		// esegue una query per selezionare l'utente corrispondente 
		//a user_name e password crittografata
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
		$result = pg_query($conn, $sql);

		// se viene trovato un solo record, l'utente esiste
		if (pg_num_rows($result) === 1) {
			$row = pg_fetch_assoc($result);

			// se il nome utente e la password corrispondono, 
			//crea le variabili di sessione e reindirizza alla home page
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: /");
		        exit();
            }else{
				// se il nome utente o la password sono errati, reindirizza alla pagina di login con un messaggio di errore
				header("Location: /web/pages/signin.php?error=Incorrect User name or password");
		        exit();
			}
		}else{
			// se non viene trovato alcun record, l'utente non esiste, reindirizza alla pagina di login con un messaggio di errore
			header("Location: /web/pages/signin.php?error=Incorrect User name or password");
	        exit();
		}
	}
	
}else{
	// se i campi user_name e password non sono stati inviati tramite il metodo POST, reindirizza alla home page
	header("Location: index.php");
	exit();
}
?>