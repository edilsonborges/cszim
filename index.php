<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CS - Agrodefesa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <a href="/" class="navbar-left"><img src="img/favicon.ico" style="width:50px;height:50px;"></a>
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Campeonato Mundial de CS - Agrodefesa</a></li>
          <li class="active"><a href="/placar.php">Placar</a></li>
          <li class="active"><a href="/regras.php">Regras</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="https://github.com/EdilsonBorges/cszim/releases/tag/v1.0.0-alpha"><i class="fa fa-github" aria-hidden="true"></i> v1.0.0-alpha</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
        <?php
          function initMaps() {
            $_SESSION["maps"] = [
              0 => ["Mirage" => "de_cpl_strike"],
              1 => ["Desertim" => "de_desertcityfixed"],
              2 => ["Aztec" => "de_aztec"],
              3 => ["Galeria" => "de_bit_gallery"],
              4 => ["Corcel Branco" => "de_westcoast"],
              5 => ["Abbotabad" => "de_abbotabad"],
              6 => ["Villa" => "de_villa"],
              7 => ["Compound" => "cs_compound"],
              8 => ["Asia" => "de_asia"],
              9 => ["Slummi" => "de_slummi"],
              10 => ["Tides" => "de_tides"],
              11 => ["Tuscan" => "de_cpl_mill"],
              12 => ["Velho Oeste" => "de_outlaws"],
              13 => ["Vila de Inverno" => "de_winter_village"],
              14 => ["Deserto da Feira" => "de_yacer_v3"],
              15 => ["Diesel" => "de_cevo_diesel"],
              16 => ["Roma" => "de_roma_aimstyle"],
              17 => ["Mansão dos Refém" => "cs_hacienda"]
            ];
            shuffle($_SESSION["maps"]);
          }
          session_start();
          if (!isset($_SESSION["maps"])) {
            initMaps();
          }
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['escolher']) && !empty($_SESSION["maps"])) {
              $randomMapIndex = array_rand($_SESSION["maps"]);
              $randomMap = key($_SESSION["maps"][$randomMapIndex]);
              $randomMapCsName = $_SESSION["maps"][$randomMapIndex][$randomMap];
              $chosenMap = "<h3>Fase escolhida: {$randomMap}</h3><h4>({$randomMapCsName})</h4><br><img src='img/{$randomMapCsName}.jpg'><br>";
              unset($_SESSION["maps"][$randomMapIndex]);
            } else if (isset($_POST['resetar']) || empty($_SESSION["maps"])) {
              unset($_SESSION["maps"]);
              initMaps();
            }
        }
        $mapNames = "<div style='display:block;'><ul>";
        foreach ($_SESSION["maps"] as $key => $mapArray) {
          $mapNames .= "<li>".key($mapArray) . " - " . $_SESSION["maps"][$key][key($mapArray)] . "</li>\n";
        }
        $mapNames .= "</ul></div>";
        ?>
        <div class="row">
          <div class="col-lg-4">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <h2>Mapas Disponíveis:</h2>
              <?= $mapNames ?>
              <br><br>
              <input type="submit" class="btn btn-default" name="escolher" value="Escolher Fase!">  
              <input type="submit" class="btn btn-danger" name="resetar" value="Resetar Aplicativo!">  
          </form>
        </div>
      <div class="col-lg-4">
        <?php if (isset($chosenMap)) { ?>
          <?= $chosenMap ?>
          <br>
          <a class="btn btn-primary" href="steam://rungameid/240// +map <?= $randomMapCsName ?>">
            Abrir o Mapa Automaticamente
          </a>
        <?php } ?>
        </div>
        </div>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  </body>
</html>
