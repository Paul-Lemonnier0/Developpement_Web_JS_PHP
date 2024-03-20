<?php

session_start();

if(!isset($_SESSION['BACKGROUND_COLOR'])){
    $bgColor = "white";
}

else $bgColor = $_SESSION['BACKGROUND_COLOR'];

if(!isset($_SESSION['TEXT_COLOR'])){
    $textColor = "black";
}

else $textColor = $_SESSION['TEXT_COLOR'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>TP PHP - Personnalisation avec sessions</title>
    <style type="text/css">
        body{
            background-color: 
            <?php echo $bgColor?>;

            color: 
            <?php echo $textColor?>;
        }

        legend {
            font-weight: bold;
            font-family: cursive;
        }

        label {
            font-weight: bold;
            font-style: italic;
        }
    </style>
</head>
<body>
   <p>Contenu de la page B avec les couleurs choisies <br />
   <a href="sessions.php">Retour vers la page principale</a>
</p>
</body>
</html>