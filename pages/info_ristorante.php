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
        $codRest = ["ristorante"];

        $sql = "SELECT `nome` FROM `ristorante` WHERE `codice` = '" . $codRest . "'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();

        $sql2 = "SELECT r.voto, r.data, r.idutente, u.username FROM `ristorante` as rt JOIN `recensione` as r ON rt.codice = r.codiceristorante JOIN `utente` as u ON u.id = r.idutente WHERE rt.codice = '" . $codRest . "';";
        $res2 = $conn->query($sql2);
        if ($res2->num_rows > 0) {
            showData($res2, $row["nome"]);
        } else {
            showDataNull($row["nome"]);
        }

        function showData($r, $name) {
            echo "<div class='divShowData'>";
                echo "<h1> RISTORANTE $name</h1>";
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Voto</th>";
                        echo "<th>Data</th>";
                        echo "<th>IdUtente</th>";
                        echo "<th>Username</th>";
                    echo "</tr>";
                     while ($row = $r->fetch_assoc()) { 
                        echo "<tr>";
                            echo "<td>" . $row["voto"] . "</td>";
                            echo "<td>" . $row["data"] . "</td>";
                            echo "<td>" . $row["idutente"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                        echo "</tr>";
                    }
                echo "</table>";
                echo "<br>";
                echo "<a class='sendButton' href='benvenuto.php'>Home</a>";
            echo "</div>";
        }

        function showDataNull($name) {
            echo "<div class='divShowData'>";
                echo "<h1> RISTORANTE $name</h1>";
                echo "<p><b><i>nessuna recensione presente</i></b></p>";
                echo "<br>";
                echo "<a class='sendButton' href='benvenuto.php'>Home</a>";
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