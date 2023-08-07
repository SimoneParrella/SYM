<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<!-- Includi un file CSS con stili comuni per il login e la registrazione -->
	<link rel="stylesheet" type="text/css" href="/styles/logsign.css">
     <!-- Collegamento al file CSS di Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
     crossorigin="anonymous">
</head>
<body>
     <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
     <symbol id="check-circle-fill" viewBox="0 0 16 16">
     <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
     </symbol>
     <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
     <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
     </symbol>
     </svg>
     
     <!-- Form di registrazione, i dati inseriti saranno inviati al server tramite il metodo POST -->
     <form action="/web/action/do-signup-check.php" method="post">
     	<h2 class="text-center">SIGN UP</h2>
     	<?php 
     		// Se è presente un errore nella querystring, visualizza un messaggio di errore
     		if (isset($_GET['error'])) { 
                    ?>
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2 icon-warning" role="img" aria-label="Warning:">
                              <use xlink:href="#exclamation-triangle-fill"/>
                         </svg>
                            <div>
                                <p><?php echo $_GET['error']; ?></p>
                            </div>
                        </div>
                    <?php 
               }
     	?>

          <?php 
          	// Se è presente un messaggio di successo nella querystring, visualizza un messaggio di successo
          	if (isset($_GET['success'])) { 
                    ?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2 icon-success" role="img" aria-label="Success:">
                                <use xlink:href="#check-circle-fill"/>
                            </svg>
                            <div>
                                <?php echo $_GET['success']; ?>
                            </div>
                        </div>
                    <?php 
               } 
          ?>

          <label for="name" class="form-label">Name</label>
          <?php 
          	// Se è presente il nome nella querystring, inseriscilo nel campo del form
          	if (isset($_GET['name'])) { 
          ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php 
          	} else { 
          		// Altrimenti, lascia il campo vuoto
          ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"><br>
          <?php 
          	} 
          ?>

          <label>User Name</label>
          <?php 
          	// Se è presente lo username nella querystring, inseriscilo nel campo del form
          	if (isset($_GET['uname'])) { 
          ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php 
          	} else { 
          		// Altrimenti, lascia il campo vuoto
          ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"><br>
          <?php 
          	} 
          ?>

          
     	<label>Password</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"><br>

          <label>Confirm Password</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Confirm Password"><br>

     	<button type="submit">Sign Up</button>
          <!-- Link per effettuare il login se l'utente è già registrato -->
          <a href="/web/pages/signin.php" class="ca">Already have an account?</a>
          <a href="/" class="ca">SYM</a>

     </form>

</body>
</html>