<?php
$servernameDB = "localhost";
$usernameDB = "root";
$passwordDB = "";     // Di default quando si installa XAMPP la password è vuota
$dbnameDB = "ristorante_recensioni"; // Qui bisogna cambiare con il nome del database presente su phpMyAdmin

mysqli_report(MYSQLI_REPORT_OFF);   // Serve a disabilitare le eccezioni nelle nuove versioni di PHP

// Creazione della connessione
$conn = new mysqli($servernameDB, $usernameDB, $passwordDB, $dbnameDB);	

/* Due possibili casi:
- La connessione va a buon fine: l'oggetto $conn nel campo connect_error ha null
- La connessione NON va a buon fine: l'oggetto $conn nel campo connect_error ha una stringa che contiene l'errore
*/
if ($conn->connect_error) {
  header("Location: errore.html");  // Se la connessione NON va a buon fine, faccio un redirect a una pagina di errore
}
?>

