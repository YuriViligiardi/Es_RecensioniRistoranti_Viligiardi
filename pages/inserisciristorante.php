<?php
    include("../connessione.php");
    session_start();
    $_SESSION["statusResultRest"] = false;
    $_SESSION["resultInsertRest"] = "";
?>
<?php
    $nome = $_POST["name"];
    $indirizzo = $_POST["address"];
    $citta = $_POST["city"];

    if (empty($nome) || empty($indirizzo) || empty($citta)) {
        $_SESSION["resultInsertRest"] = "Inserire tutti i campi";
        header("Location: pannelloadmin.php");
        exit;
    }

    $cod = 1;
    $codEsistenti = [];

    $sql = "SELECT `codice`, `nome`, `indirizzo`, `citta` FROM `ristorante` WHERE 1;";
    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()) {
        $codEsistenti[] = $row["codice"];

        if ($row["nome"] == $nome && $row["indirizzo"] == $indirizzo && $row["citta"] == $citta) {
        $_SESSION["resultInsertRest"] = "Il ristorante $nome esiste di già";
        header("Location: pannelloadmin.php");
        exit;
        }
    }

    while(true) {
        $uscita = false;
        foreach ($codEsistenti as $c) {
            if (strpos($c, (string) $cod) !== false) { 
                $uscita = true;
                break;
            }
        }
        if (!$uscita) {
            break;
        }
        $cod++;
    }
    $cod = $cod . "r";
    
    $sql2 = "INSERT INTO `ristorante`(`codice`, `nome`, `indirizzo`, `citta`) VALUES ('$cod','$nome','$indirizzo','$citta')";
    $res2 = $conn->query($sql2);
        if ($res2) {
            $_SESSION["statusResultRest"] = true;
            $_SESSION["resultInsertRest"] = "Ristorante $nome inserito con successo";
        } else {
            $_SESSION["resultInsertRest"] = "Impossibile aggiungere il ristorante $nome";
        }
        header("Location: pannelloadmin.php");

?>