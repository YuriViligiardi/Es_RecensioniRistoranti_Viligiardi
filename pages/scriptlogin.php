<?php
    include("../connessione.php");
    session_start();
    $_SESSION["mesErrore"] = "503 - CONNESSIONE NON RIUSCITA";
    $_SESSION["utenteLogin"] = "";
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
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT u.username, u.passwd FROM `utente` as u";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $utenti[] = $row;
            }
            if (controlUsername($utenti, $username)) {
                if (controlPassword($utenti, $password)) { 
                    foreach ($utenti as $utente) {
                        if (($utente["username"] === $username) && ($utente["passwd"] === $password)) {
                            $_SESSION["utenteLogin"] = $username;
                            header("Location: benvenuto.php");
                            exit;
                        }
                        $_SESSION["mesErrore"] = "USERNAME E PASSWORD NON COMPATIBILI";
                        header("Location: errore_loginreg.php");
                        exit;
                    }
                } else {
                    $_SESSION["mesErrore"] = "PASSWORD INESISTENTE";
                    header("Location: errore_loginreg.php");
                    exit;
                }
            } else {
                $_SESSION["mesErrore"] = "USERNAME INESISTENTE";
                header("Location: errore_loginreg.php");
                exit;
            }
        } else {
            header("Location: errore_loginreg.php");
            exit;
        }

        //Funzione per controllare se l'username inserito esiste
        function controlUsername($u, $un){
            foreach ($u as $utente) {
                if (($utente["username"] === $un)) {
                    return true;
                }
            }
            return false;
        }

        //Funzione per controllare se la password inserita esiste
        function controlPassword($u, $pass){
            foreach ($u as $utente) {
                if (($utente["passwd"] === $pass)) {
                    return true;
                }
            }
            return false;
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