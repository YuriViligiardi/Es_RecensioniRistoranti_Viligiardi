<?php
    include("../connessione.php");
    session_start();
    $_SESSION["statusResult"] = false;
?>
<?php
    $data = date("Y-m-d");
    $codRist = $_POST["ristorante"];
    $voto = $_POST["voto"];
    
    $sql = "SELECT `id` FROM `utente` WHERE `username` = '". $_SESSION["utente"] . "'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $idUtente = $row["id"];


    $sql2 = "SELECT * FROM `recensione` WHERE idutente = '" . $idUtente . "' AND codiceristorante = '" . $codRist . "'";
    $res2 = $conn->query($sql2);
    if ($res2->num_rows > 0) {  
        $_SESSION["resultInsertRec"] = "Hai già recensito questo ristorante";
        header("Location: benvenuto.php");
    } else {
        $sql3 = "INSERT INTO `recensione`(`voto`, `data`, `idutente`, `codiceristorante`) VALUES ('$voto','$data','$idUtente','$codRist')";
        $res3 = $conn->query($sql3);
        if ($res3) {
            $_SESSION["statusResult"] = true;
            $_SESSION["resultInsertRec"] = "Recensione inserita con successo";
        } else {
            $_SESSION["resultInsertRec"] = "Impossibile aggiungere la recensione";
        }
        header("Location: benvenuto.php");
    }

?>

