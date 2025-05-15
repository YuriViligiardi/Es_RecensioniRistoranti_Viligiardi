<?php
    include("../connessione.php");
    session_start();
    $_SESSION["resultInsertRec"] = "";
    $_SESSION["statusResult"] = false;
?>
<?php
    $data = date("Y-m-d");
    $ristorante = $_POST["ristorante"];
    $voto = $_POST["voto"];
    
    $sql = "SELECT `id` FROM `utente` WHERE `username` = '". $_SESSION["utente"] . "'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $idUtente = $row["id"];

    $sql2 = "SELECT `codice` FROM `ristorante` WHERE nome = '" . $ristorante . "'";
    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_assoc();
    $idRist = $row2["codice"];

    $sql3 = "SELECT * FROM `recensione` WHERE idutente = '" . $idUtente . "' AND codiceristorante = '" . $idRist . "'";
    $res3 = $conn->query($sql3);
    if ($res3->num_rows > 0) {  
        $_SESSION["resultInsertRec"] = "Hai già recensito questo ristorante";
        header("Location: benvenuto.php");
    } else {
        $sql4 = "INSERT INTO `recensione`(`voto`, `data`, `idutente`, `codiceristorante`) VALUES ('$voto','$data','$idUtente','$idRist')";
        $res4 = $conn->query($sql4);
        if ($res4) {
            $_SESSION["statusResult"] = true;
            $_SESSION["resultInsertRec"] = "Recensione inserita con successo";
            header("Location: benvenuto.php");
        } else {
            $_SESSION["resultInsertRec"] = "Impossibile aggiungere la recensione";
            header("Location: benvenuto.php");
        }
    }

?>

