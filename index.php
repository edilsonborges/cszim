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
    <a href="/" class="navbar-left"><img src="favicon.ico" style="width:50px;height:50px;"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/">Campeonato Mundial de CS - Agrodefesa</a></li>
    </ul>
  </div>
</nav>
      <div class="container">
<?php
        $comment = '';
        $initialValue = fopen("fases.txt","r+");
       $initialValue  = 'Mirage - de_cpl_strike
Deserto - de_desertcityfixed
Aztec - de_aztec
Galeria - de_bit_gallery
Westcoast - de_westcoast
Abbotabad - de_abbotabad
Villa - de_villa
Compound - cs_compound';
		if(!empty($_POST["comment"])){
			$initialValue = $_POST["comment"];
        } else {
			$i = 0;
        }
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['salvar'])){
              echo 'salvar';
            } else if (isset($_POST['escolher'])) {
                $arValores = explode(PHP_EOL,$_POST["comment"]);
                $randomIndex = array_rand($arValores, '1');
				$i++;
                $comment = '<h2>Fase escolhida:</h2>'.$arValores[$randomIndex];
                // <br><br><p><font size="1" color="red">Quantidade de fases escolhidas: '.$i.'</font></p>';
            }
         }
?>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
         <h2>Escolha aleatória de fases:</h2>
         <textarea style="resize: none;" name="comment" value="comment" rows="15" cols="135"><?php echo $initialValue;?></textarea>
            <br><br>
            <input type="submit" class="btn btn-default" name="escolher" value="Escolher Fase!">  
<!--             <input type="submit" class="btn btn-default" name="salvar" value="Salvar Fases">   -->
         </form>
         <?php
            echo $comment;
            ?>
      </div>
   </body>
</html>