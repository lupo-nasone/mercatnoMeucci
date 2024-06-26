<?php
  session_start();
  unset($_SESSION["loginMSG"]);
  unset($_SESSION["loginMSG_good"]);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    
    <div class="card position-relative position-absolute top-50 start-50 translate-middle p-3" style="width: 18rem;">
        <img src="./images/beaver-carrot.gif" class="card-img-top" style="border-radius: 1rem;">
        <p class="fs-1 text-center">REGISTRATI</p>
        <p class="fw-semibold text-center">Welcome to the dark side</p>
        <div class="card-body">
          <p class="<?php echo isset($_SESSION["regMSG_good"]) ? ($_SESSION["regMSG_good"] ? "alert alert-success" : "alert alert-danger") : "" ?>">
            <?php echo isset($_SESSION["regMSG"]) ? $_SESSION["regMSG"] : "" ?>
          </p>
            <form method="post" action="register.php">
                
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" name="email" class="form-control" placeholder="email" required/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password" class="form-control" placeholder="password" required/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="nome" class="form-control" placeholder="nome" required/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="cognome" class="form-control" placeholder="cognome" required/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="number" name="eta" class="form-control" placeholder="eta" required min="1" max="99"/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="classe" class="form-control" placeholder="classe" required/>
                  </div>
                  
                  <div class="text-center pt-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block text-white bg-danger" type="submit" value="Accedi">Registrati</button>
                    <br>
                    <a href="loginPage.php">torna a loggamento</a>
                </div>

            </form>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!--
            <h2>Registrazione Utente</h2>
    <form method="post" action="register.php">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        <label for="cognome">Cognome:</label><br>
        <input type="text" id="cognome" name="cognome" required><br>
        <label for="eta">Età:</label><br>
        <input type="number" id="eta" name="eta" required><br>
        <label for="classe">Classe:</label><br>
        <input type="text" id="classe" name="classe" required><br><br>
        <input type="submit" value="Registrati">
    </form>
    <a href="login.html">Login</a>
    -->

</body>
</html>
