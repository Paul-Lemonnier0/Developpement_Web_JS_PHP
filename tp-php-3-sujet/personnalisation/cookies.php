<?php


if(isset($_POST['fond'])){
    if($_POST['fond'] == ""){
        if(isset($_COOKIE['BACKGROUND_COLOR'])){
            $bgColor = $_COOKIE['BACKGROUND_COLOR'];
        }

        else $bgColor = "white";
    }

    else {
        setcookie(
            'BACKGROUND_COLOR',
            $_POST['fond'],
            [
                'expires' => time() + 10,
                'secure' => true,
                'httponly' => true
            ]
        );
    
        $bgColor = $_POST['fond'];
    }
}

if(isset($_POST['texte'])){
    if($_POST['texte'] == ""){
        if(isset($_COOKIE['TEXT_COLOR'])){
            $textColor = $_COOKIE['TEXT_COLOR'];
        }

        else $textColor = "black";
    }

    else {
        setcookie(
            'TEXT_COLOR',
            $_POST['texte'],
            [
                'expires' => time() + 10,
                'secure' => true,
                'httponly' => true
            ]
        );
    
        $textColor = $_POST['texte'];
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8" />
    <title>TP PHP - Personnalisation avec cookies</title>
    <style type="text/css">
    


        legend {
            font-weight: bold;
            font-family: cursive;
        }

        label {
            font-weight: bold;
            font-style: italic;
        }

        body{
            background-color: 
            <?php echo $bgColor?>;

            color: 
            <?php echo $textColor?>;
        }
    </style>
</head>

<body>
    <form method="post" action="cookies.php">
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
</body>

</html>