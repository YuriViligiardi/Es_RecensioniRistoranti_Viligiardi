<?php
    include("../connessione.php");
    session_start();
    $_SESSION["mesErrore"] = "503 - CONNESSIONE NON RIUSCITA";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCRIPT CONTROLLO</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- navbar -->
    <div class="divstartPages">
        <i class="bi bi-cup-hot textStartPage"> Restaurant</i>
    </div>

    <?php
        $user = $_POST["username"];
        $passwd = $_POST["password"];
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["email"];

        if ($user === "" || $passwd === "" || $nome === "" || $cognome === "" || $email === "") {
            $_SESSION["mesErrore"] = "Dati non inseriti correttamente";
            header("Location: paginaregistrazione.php");
            exit;
        }

        $sql = "SELECT `username`,`email` FROM `utente`";
        $res = $conn->query($sql);
        
            while ($row = $res->fetch_assoc()) {
                $utenti[] = $row;
            }
            if (controlUsername($utenti, $user)) {
                if (controlEmail($utenti, $email)) {
                    $passwdHash = hash("sha256",$passwd);
                    $sql2 = "INSERT INTO utente (username, passwd, nome, cognome, email) VALUES ('$user','$passwdHash','$nome','$cognome','$email')";
                    $res2 = $conn->query($sql2);
                    if ($res2) {
                        $_SESSION["utente"] = $user;
                        header("Location: benvenuto.php");
                        exit;
                    } else {
                        $_SESSION["mesErrore"] = "Errore nell'inserimento";
                        header("Location: paginaregistrazione.php");
                        exit;
                    }
                } else {
                    $_SESSION["mesErrore"] = "Email già esistente";
                        header("Location: paginaregistrazione.php");
                        exit;
                }
            } else {
                $_SESSION["mesErrore"] = "Username già esistente";
                header("Location: paginaregistrazione.php");
                exit;
            }
        
        header("Location: paginaregistrazione.php");
        exit;
        
        //Funzione per controllare se l'username inserito esiste
        function controlUsername($u, $un){
            foreach ($u as $utente) {
                if (($utente["username"] === $un)) {
                    return false;
                }
            }
            return true;
        }

        //Funzione per controllare se la password inserita esiste
        function controlEmail($u, $e){
            foreach ($u as $utente) {
                if (($utente["email"] === $e)) {
                    return false;
                }
            }
            return true;
        }
    ?>

    <!-- div di fondo pagina -->
    <div class="divEndPage">
        <table class="endTable">
            <tr>
                <th><i class="bi bi-instagram"></i> Instagram</th>
                <th><i class="bi bi-facebook"></i> Facebook</th>
                <th><i class="bi bi-tiktok"></i> Tik Tok</th>
            </tr>
        </table>
        <br>
        <p class="textEndPage"><b><i>&copy; 2025 Restaurant. Tutti i diritti riservati.</i></b></p>
        <p class="textEndPage"><b><i>Questo sito e i suoi contenuti sono protetti dalle leggi sul copyright. È vietata la riproduzione, distribuzione o utilizzo non autorizzato senza consenso scritto.</i></b></p>
    </div>

    <!-- Script -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>
</html>