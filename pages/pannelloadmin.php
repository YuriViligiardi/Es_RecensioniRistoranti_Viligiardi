<?php
    include("../connessione.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENVENUTO</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- navbar -->
    <div class="divstartPages">
        <i class="bi bi-cup-hot textStartPage"> Restaurant</i>
    </div>

    <?php
        $sql = "SELECT `codice`, `nome`, `indirizzo`, `citta` FROM `ristorante`";
        $res = $conn->query($sql);
        showData($res, $conn);
        createRest();
        
        //Funzione per mostrare il benvenuto (con parte grafica)
        function showData($r, $conn) {
            echo "<div class='divShowData divBenvenuto'>";
                    echo "<h1 class='correct'>BENVENUTO ADMIN " . $_SESSION["utente"] . "!</h1>";
                    if ($r->num_rows > 0) {
                        echo "<table>";
                            echo "<tr>";
                                echo "<th>Codice</th>";
                                echo "<th>Nome</th>";
                                echo "<th>Indirizzo</th>";
                                echo "<th>Citta</th>";
                                echo "<th>NumRecensioni</th>";
                            echo "</tr>";
                            while ($row = $r->fetch_assoc()) { 
                                $sql2 = "SELECT COUNT(r.idutente) as numrecen FROM `ristorante` as rt JOIN `recensione` as r ON rt.codice = r.codiceristorante WHERE rt.codice = '" . $row["codice"] . "'";
                                $res2 = $conn->query($sql2);
                                if (!$res2) {
                                    $numRece = 0;
                                } else {
                                    $row2 = $res2->fetch_assoc();
                                    $numRece = $row2["numrecen"];
                                }
                                echo "<tr>";
                                    echo "<td>" . $row["codice"] . "</td>";
                                    echo "<td>" . $row["nome"] . "</td>";
                                    echo "<td>" . $row["indirizzo"] . "</td>";
                                    echo "<td>" . $row["citta"] . "</td>";
                                    echo "<td>" . $numRece . "</td>";
                                echo "</tr>";
                            }
                        echo "</table>";
                    } else {
                        echo "<p><b><i>Nessuna ristorante presente</i></b></p>";
                    }
                    echo "<br>";
                    echo "<a class='sendButton' href='scriptlogout.php'>Logout</a>";
            echo "</div>";
        }

        function createRest(){
            echo "<div class='divShowData divRistorante title'>";
                echo "<h1>NUOVO RISTORANTE</h1>";
                echo "<form action='inserisciristorante.php' method='post'>";
                    echo "<label>Inserisci il nome:</label><br>";
                        echo "<input type='text' name='name'><br><br>";
                    echo "<label>Inserisci l'indirizzo:</label><br>";
                        echo "<input type='text' name='address'><br><br>";
                    echo "<label>Inserisci la città:</label><br>";
                        echo "<input type='text' name='city'><br>";
                    echo "<br>";
                    echo "<input class='sendButton' type='submit' value='Send restaurant'>";
                echo "</form>";
                echo "<br>";
                if (isset($_SESSION["resultInsertRest"])) {
                    if ($_SESSION["statusResultRest"]) {
                        echo "<p><b><i class='correct'>" . $_SESSION["resultInsertRest"] . "</i></b></p>";
                    } else {
                        echo "<p><b><i class='error'>" . $_SESSION["resultInsertRest"] . "</i></b></p>";
                    }
                    unset($_SESSION["resultInsertRest"]);
                    unset($_SESSION["statusResultRest"]);
                }
            echo "</div>";
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