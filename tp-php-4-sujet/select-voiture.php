<?php


try {

    $objdb = connexpdo("voitures");
    $qry = $objdb->query('SELECT * FROM voiture');

    echo "<tr><td>";

    echo "<form action='/select-voiture.php' method='get'>";
    echo "<input list='voitures_id' name='voiture_text' id='voiture_text'>";

    echo "<datalist id='voitures_id'>";

	while ($record=$qry->fetch(PDO::FETCH_NUM)){
        $immat = $record[0];

        echo "<option value='$immat'/>";
    }

    echo "</datalist>";
    echo "<input type='submit' value='Chercher les voitures'>";
    echo "</form>";
    echo "</td></tr>";

} 

catch (PDOException $e) {
    displayException($e);
}

?>