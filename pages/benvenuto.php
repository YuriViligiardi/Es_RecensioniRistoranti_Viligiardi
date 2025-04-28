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
            showData($row, $row2['numRecensioni']);
        }
        
        //Funzione per mostrare il benvenuto (con parte grafica)
        function showData($list, $nr) {
            echo "<div class='divShowData scrollBar'>";
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
                        // echo "<p><b>Numero recensioni effettuate: </b> $nr</p>";
                        // echo "<table>";
                        //     echo "<tr>";

                        //     echo "</tr>";
                        // echo "</table>";
                    }
                    // echo "<br>";
                    //     echo "<form action='inseriscirecensione.php' method='post'>";
                    //         echo "<label>Username:</label><br>";
                    //         echo "<input type='text' name='username'><br><br>";
                    //         echo "<label>Password:</label><br>";
                    //         echo "<input type='password' name='password'>";
                    //     echo "</form>";
                    echo "<br>";
                    echo "<a class='sendButton' href='scriptlogout.php'>Logout</a>";
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