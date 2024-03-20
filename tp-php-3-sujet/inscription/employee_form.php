<?php

$fileName = "employees.csv";
$id = 1;


$UTILISATEURS = [];

if(isset($_POST['inscrire'])){

    $employeeHandle = fopen($fileName, "a+");

    $id += 1;
    $nom = $_POST['nom'];
    $salaire = $_POST['salaire'];
    $age = $_POST['age'];
    $newEmployees = $id . ";" . $nom . ";" . $salaire . ";" . $age . "\n";

    fwrite($employeeHandle, $newEmployees);
    fclose($employeeHandle);
}

$employeeHandle = fopen($fileName, "a+");
$UTLISATEURS = [];

while(($UTILISATEUR = fgetcsv($employeeHandle, 100000, ';')) !== FALSE){
    array_push($UTILISATEURS, $UTILISATEUR);
}

fclose($employeeHandle);

$borderStyle = "'5px solid black'";

function createHeader($headers){
    echo "<tr>";
    function createHeaderCell($header){
        global $borderStyle;
        echo "<th> $header </th>";
    }
    
    array_walk($headers, 'createHeaderCell');
    echo "</tr>";
}

function createRowCell($element){
    global $borderStyle;
    echo "<td> $element </td>";
}

function createRow($elements){

    echo "<tr>";
    
    array_walk($elements, 'createRowCell');
    echo "</tr>";
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<title>TP PHP - Inscription d'employés</title>


</head>
<body style="background-color: #ffcc00;">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
            <legend><b>Inscrire un employé</b></legend>
            <label>Nom :&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="nom" value="" size="30" maxlength="60" required="required"/><br/><br/>
            <label>Salaire :&nbsp;</label>
            <input type="number" name="salaire" min="0" max="100000" step="5000" size="6" required="required"/><br/><br/>
            <label>Age :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" name="age" min="18" max="100" size="6" required="required"/><br/><br/>
            <input type="submit" value="Inscrire" name="inscrire" />
        </fieldset>
    </form>



    <?php
        echo "<table border =$borderStyle>";
        createHeader(["ID","NOM","SALAIRE", "AGE"]);
        array_walk($UTILISATEURS, 'createRow');
        echo "</table>";
    ?>

</body>
</html>
