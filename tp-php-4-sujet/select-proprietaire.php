<?php

require ("connexpdo.inc.php");
require_once ("js.php");

try {

    $objdb = connexpdo("voitures");
    $qry = $objdb->query('SELECT * FROM proprietaire');

    echo "<tr><td>";
	echo "<select name='proprietaire'>";

	while ($record=$qry->fetch(PDO::FETCH_NUM)){
        $id = $record[0];
        $prenom = $record[1];

        echo "<option value=$id>$prenom</option>";
    }

    echo "</select>";
    echo "</td></tr>";

} 

catch (PDOException $e) {
    displayException($e);
}

?>