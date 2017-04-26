<!DOCTYPE html>
<html lang="en">
  <head>
     <title>CS - Agrodefesa</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
        <a href="/" class="navbar-left"><img src="img/favicon.ico" style="width:50px;height:50px;"></a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Campeonato Mundial de CS - Agrodefesa</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <?php

        function initMaps() {
          $_SESSION["maps"] = [
            0 => ["Mirage" => "de_cpl_strike"],
            1 => ["Deserto" => "de_desertcityfixed"],
            2 => ["Dust 2" => "de_dust2"],
            3 => ["Train" => "de_train"],
            4 => ["Tides" => "de_tides"],
            5 => ["Aztec" => "de_aztec"],
            6 => ["Galeria" => "de_bit_gallery"],
            7 => ["Westcoast" => "de_westcoast"],
            8 => ["Abbotabad" => "de_abbotabad"],
            9 => ["Villa" => "de_villa"],
            10 => ["Compound" => "cs_compound"]
          ];
        }

        session_start();

        if (!isset($_SESSION["maps"])) {
          initMaps();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_POST['escolher'])) {
            $randomMapIndex = array_rand($_SESSION["maps"]);
            $randomMap = key($_SESSION["maps"][$randomMapIndex]);
            $randomMapCsName = $_SESSION["maps"][$randomMapIndex][$randomMap];
            $chosenMap = "<h3>Fase escolhida: {$randomMap}</h3><img src='img/{$randomMapCsName}.jpg' style='width:236px;height:200px;'>";

            unset($_SESSION["maps"][$randomMapIndex]);
          } else if (isset($_POST['resetar'])) {
            unset($_SESSION["maps"]);
            initMaps();
          }
        }

        $mapNames = "";
        foreach ($_SESSION["maps"] as $key => $mapArray) {
          $mapNames .= key($mapArray) . " - " . $_SESSION["maps"][$key][key($mapArray)] . "\n";
        }

      ?>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
        <h2>Mapas Disponíveis:</h2>
        <textarea style="resize: none;" name="comment" value="comment" rows="15" cols="135"><?= $mapNames ?></textarea>
        <br>
        <br>
        <input type="submit" class="btn btn-default" name="escolher" value="Escolher Fase!">  
        <input type="submit" class="btn btn-danger" name="resetar" value="Resetar Aplicativo!">  
      </form>

      <br>

      <?php if (isset($chosenMap)) { ?>
        <?= $chosenMap ?>
        <br>
        <a class="btn btn-primary" href="steam://rungameid/240// +map <?= $randomMapCsName ?>">
          Abrir o Mapa Automaticamente
        </a>
      <?php } ?>

    </div>
  </body>
</html>