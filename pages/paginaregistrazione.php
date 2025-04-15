<?php
    include("../connessione.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINA REGISTRAZIONE</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- navbar -->
    <div class="divstartPages">
        <i class="bi bi-cup-hot textStartPage"> Restaurant</i>
    </div>

    <!-- div form -->
    <div class="divForm mb-5">
        <h1><b>REGISTRAZIONE</b></h1>
        <br>
        <?php 
            if (isset($_SESSION["mesErrore"])) {
                echo "<div class='errorMessage'>";
                    echo "<span><i>" .$_SESSION["mesErrore"] . "   </i></span>";
                    echo "<i onclick='location.reload()' class='bi bi-x-square' style='font-size: 20px;'></i>";
                echo "</div>";
                unset($_SESSION["mesErrore"]);
            }
        ?>
        <form action="scriptregistrazione.php" method="post">
            <label>Username:</label><br>
            <input type="text" name="username"><br><br>
            <label>Password:</label><br>
            <input type="password" name="password"><br><br>
            <label>Nome:</label><br>
            <input type="text" name="nome"><br><br>
            <label>Cognome:</label><br>
            <input type="text" name="cognome"><br><br>
            <label>Email:</label><br>
            <input type="email" name="email">
            <br>
            <br>
            <input class="sendButton" type="submit" value="Signin">
        </form>
        <hr>
        <span><b><i>Sei già registrato? </i></b></span><a class="sendButtonRegistration" href="paginalogin.php"><b><i>Accedi</i></b></a>
    </div>

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