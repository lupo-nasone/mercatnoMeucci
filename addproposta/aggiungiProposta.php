<?php
    require("../lib/connection.php");
    session_start();
    $annuncio_id = isset($_GET["id"]) ? (is_numeric($_GET["id"]) ? $_GET["id"] : -1) : -1;
    if(!isset($_SESSION["login"]) || $annuncio_id < 1){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><img src="../images/pngwing.com.png" width="75" height="50">Mercatino dell'Assunzione</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        <a style="color:black; text-decoration:none" href="../addannuncio/aggiungiAnnuncio.php">+ Crea Annuncio</a>
                    </button>
                </form>
                <div class="form-inline my-2 my-lg-0 ms-3">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">
                        <a style="color:black; text-decoration:none" href="../login/logout.php">Logout</a>
                    </button>
                </div>
                <br>
            </div>
        </div>
    </nav>

    <div class="px-auto text-center">
        <h1 class="p-5">AGGIUNGI UNA PROPOSTA AL SEGUENTE ANNUNCIO</h1>
        <?php

            $sql = "SELECT Annuncio.id, Annuncio.titolo, Annuncio.descrizione, Categoria.nome as categoria, Utente.nome as utente_nome, Utente.cognome as utente_cognome 
            FROM Annuncio
            JOIN Categoria ON Annuncio.Categoria_id = Categoria.id
            JOIN Utente ON Annuncio.Utente_id = Utente.id
            WHERE Annuncio.id = $annuncio_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    
                    $annuncio_id = $row['id'];
                    echo "
                        <div class='card'>
                            <div id='carouselExampleIndicators$annuncio_id' class='carousel slide' data-bs-ride='carousel'>
                                <div class='carousel-inner'>";
                                
                                $sql_images = "SELECT url FROM Foto WHERE Annuncio_id = $annuncio_id";
                                $result_images = $conn->query($sql_images);
            
                                if ($result_images->num_rows > 0) {
                                    $active = 'active';
                                    while ($row_image = $result_images->fetch_assoc()) {
                                        echo "
                                        <div class='carousel-item $active'>
                                            <img src='./addannuncio/uploads/" . htmlspecialchars(basename($row_image['url'])) . "' class='d-block w-100' alt='...'>
                                        </div>";
                                        $active = '';
                                    }
                                } else {
                                    echo "
                                    <div class='carousel-item active'>
                                        <img src='placeholder.jpg' class='d-block w-100' alt='...'>
                                    </div>";
                                }
            
                    echo "      </div>
                                <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators$annuncio_id' data-bs-slide='prev'>
                                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                    <span class='visually-hidden'>Previous</span>
                                </button>
                                <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators$annuncio_id' data-bs-slide='next'>
                                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                    <span class='visually-hidden'>Next</span>
                                </button>
                            </div>
                            <div class='card-body'>
                                <h5 class='card-title'>" . htmlspecialchars($row['titolo']) . "</h5>
                                <h6 class='card-subtitle mb-2 text-muted'>Categoria: " . htmlspecialchars($row['categoria']) . "</h6>
                                <p class='card-text'>" . htmlspecialchars($row['descrizione']) . "</p>
                                <p class='card-text'><small class='text-muted'>Inserito da: " . htmlspecialchars($row['utente_nome']) . " " . htmlspecialchars($row['utente_cognome']) . "</small></p>
                            </div>
            
                            <div class='d-flex justify-content-center pb-2'>
                                <form method='POST' action='./proponi.php'>
                                    <input type='number' step='.01' name='proposta' placeholder='inserisci prezzo proposta'>
                                    <input type='hidden' name='annuncio_id' value='$annuncio_id'>
                                    <input type='submit' class='btn btn-outline-success my-2 my-sm-0'>
                                </form>
                            </div>

                                <p";

                                if(isset($_SESSION["MSG"]) && isset($_SESSION["MSG_good"])){
                                    echo " class='alert alert-" . ($_SESSION["MSG_good"] ? "success" : "danger") . "'> " . $_SESSION["MSG"] . "</p>";
                                }else{
                                    echo "></p>";
                                }
                           
                }

            } else {
                echo "<p>Nessun annuncio trovato.</p>";
            }
        ?>
        <hr>
        <h3>Lista delle proposte correnti</h3>
        <!-- lista delle proposte -->
    </div>
</body>
</html>