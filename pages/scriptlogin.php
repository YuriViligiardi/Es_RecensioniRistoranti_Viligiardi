<?php
    include("connessione.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCRIPT CONTROLLO</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT u.username, u.passwd FROM `utente` as u";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($utente = $res->fetch_assoc()) {
                if (($utente["username"] === $username) && ($utente["password"] === $password)) {
                    header("Location: benvenuto.php");
                }
            }
            header("Location: errore_loginreg.php");
        }
    ?>
</body>
</html>