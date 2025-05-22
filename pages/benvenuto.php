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
        $ut = $_SESSION["utente"];
        $sql = "SELECT username, nome, cognome, email, dataRegistrazione FROM utente WHERE username = '$ut'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();

            $sql2 = "SELECT COUNT(r.idrecensione) numRecensioni FROM recensione r JOIN utente u ON r.idutente = u.id WHERE u.username = '" . $_SESSION["utente"] . "'";
            $res2 = $conn->query($sql2);
            $row2 = $res2->fetch_assoc();
            $sql3 = "SELECT rt.nome, rt.indirizzo, r.voto, r.data FROM `recensione` as r JOIN `ristorante` as rt ON r.codiceristorante = rt.codice JOIN `utente` as u ON u.id = r.idutente WHERE u.username = '" . $ut . "'";
            $res3 = $conn->query($sql3);

            $listRest = [];
            $sql4 = "SELECT r.codice, r.nome FROM `ristorante` as r";
            $res4 = $conn->query($sql4);
                while ($row4 = $res4->fetch_assoc()) {
                    $listRest[] = $row4;
                }
            showData($row, $row2['numRecensioni'], $res3, $listRest);
            createNewRec($listRest);
        }
        
        //Funzione per mostrare il benvenuto (con parte grafica)
        function showData($list, $nr, $r, $lr) {
            echo "<div class='divShowData divBenvenuto title'>";
                    echo "<h1 class='correct'>BENVENUTO " . $_SESSION["utente"] . "!</h1>";
                    echo "<p><b><i>Dati Utente:</i></b></p>";
                        echo "<ul>";
                        foreach ($list as $key=>$value) {
                            echo "<li><b>$key: </b><i>$value</i></li>";
                        }
                        echo "</ul>";
                    if ($nr == 0) {
                        echo "<br>";
                        echo "<p><b><i>Nessuna recensione effettuata!</i></b></p>";
                    } else {
                        echo "<p><b>Numero recensioni effettuate: </b> $nr</p>";
                        echo "<table>";
                            echo "<tr>";
                                echo "<th>NomeRistorante</th>";
                                echo "<th>Indirizzo</th>";
                                echo "<th>Voto</th>";
                                echo "<th>Data</th>";
                            echo "</tr>";
                            while ($row = $r->fetch_assoc()) { 
                                echo "<tr>";
                                    echo "<td>" . $row["nome"] . "</td>";
                                    echo "<td>" . $row["indirizzo"] . "</td>";
                                    echo "<td>" . $row["voto"] . "</td>";
                                    echo "<td>" . $row["data"] . "</td>";
                                echo "</tr>";
                            }
                        echo "</table>"; 
                    }
                    echo "<br>";
                    if (isset($_SESSION["resultInsertRec"])) {
                        if ($_SESSION["statusResult"]) {
                            echo "<p><b><i class='correct'>" . $_SESSION["resultInsertRec"] . "</i></b></p>";
                        } else {
                            echo "<p><b><i class='error'>" . $_SESSION["resultInsertRec"] . "</i></b></p>";
                        }
                        unset($_SESSION["resultInsertRec"]);
                        unset($_SESSION["statusResult"]);
                    }
                    echo "<div>";
                        echo "<form action='info_ristorante.php' method='post'>";
                            selectRest($lr);
                            echo "<input class='sendButton' type='submit' value='Show info'>";
                        echo "</form>";
                    echo "</div>";
                    echo "<a class='sendButton' href='scriptlogout.php'>Logout</a>";
            echo "</div>";
        }

        //Funzione per mostrare la form per la creazione di una nuova recensione (con parte grafica)
        function createNewRec($lr){
            echo "<div class='divShowData divRecensione title'>";
                echo "<h1>NUOVA RECENSIONE</h1>";
                echo "<form action='inseriscirecensione.php' method='post'>";
                    selectRest($lr);
                    echo "<label>Dai un voto:</label><br>";
                    echo "<div>";
                        for ($i=1; $i < 6; $i++) { 
                            echo "<input class='normalInput' id='voto = $i' type='radio' name='voto' value='$i'>"; 
                            echo "<label class='labelStar' for='voto = $i'>$i <i class='bi bi-star'></i></label>";
                        }
                    echo "</div>";
                    echo "<br>";
                    echo "<input class='sendButton' type='submit' value='Send review'>";
                echo "</form>";
            echo "</div>";
        }

        function selectRest($lr){
            echo "<label>Scegli un ristorante:</label><br>";
            echo "<select name='ristorante' class='styled-select'>";
                foreach ($lr as $value) {
                    echo "<option value='{$value['codice']}'>{$value['nome']}</option>";
                }
            echo "</select>";
            echo "<br>";
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