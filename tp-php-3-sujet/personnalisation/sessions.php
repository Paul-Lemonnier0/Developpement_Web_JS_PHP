<?php

session_start();


if(isset($_POST['fond'])){
    if($_POST['fond'] != "") $_SESSION['BACKGROUND_COLOR'] = "white";
    $_SESSION['BACKGROUND_COLOR'] = $_POST['fond'];

}

else {
    if(!isset($_SESSION['BACKGROUND_COLOR'])){
        $_SESSION['BACKGROUND_COLOR'] = "white";
    }
    
}

$bgColor = $_SESSION['BACKGROUND_COLOR'];

if(isset($_POST['texte'])){
    if($_POST['texte'] != "") $_SESSION['TEXT_COLOR'] = "black";
    $_SESSION['TEXT_COLOR'] = $_POST['texte'];
}

else {
    if(!isset($_SESSION['TEXT_COLOR'])){
        $_SESSION['TEXT_COLOR'] = "black";
    }
}

$textColor = $_SESSION['TEXT_COLOR'];

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
    <form method="post" action="sessions.php">
        <fieldset>
            <legend>Choisissez vos couleurs (mot clé ou code)</legend>
            <label>Couleur de fond
                <input type="text" name="fond" />
            </label><br /><br />
            <label>Couleur de texte
                <input type="text" name="texte" />
            </label><br />
            <input type="submit" value="Envoyer" />&nbsp;&nbsp;
            <input type="reset" value="Effacer" />
        </fieldset>
    </form>

    <p>Contenu de la page principale <br />
        <a href="sessions-B.php">Lien vers la page B qui aura ces couleurs</a>
    </p>
</body>
</html>
