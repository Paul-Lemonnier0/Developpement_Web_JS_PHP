<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8" />
<title>Lecture de la table modele</title>
<style type="text/css">
table, tr, td, th {
	border-style: solid;
	border-color: red;
	background-color: yellow;
}
table {
	border-width: 3px;
	border-collapse: collapse;
}
tr, td, th {
	border-width: 1px;
}
</style>
</head>
<body>
<?php

require ("connexpdo.inc.php");
require_once ("js.php");

function createCell($cell){
	echo "<td>";
	echo "$cell";
	echo "</td>";
}

function createHeader($header){
	echo "<th>";
	echo "$header";
	echo "</th>";
}

function createHeaders($headers){
	echo "<tr>";
	array_walk($headers, 'createHeader');
	echo "</tr>";
}

try {
    $objdb = connexpdo("voitures");
	$qry = $objdb->query('SELECT * FROM modele ORDER BY modele');

	echo "<table>";

	$headers = ["Code Modèle", "Modèle", "Carburant"];
	createHeaders($headers);

	while ($record=$qry->fetch(PDO::FETCH_NUM)) {

		echo "<tr>";
			array_walk($record, 'createCell');
		echo "</tr>";
	}

	echo "</table>";

} 

catch (PDOException $e) {
    displayException($e);
}

?>
</body>
</html>