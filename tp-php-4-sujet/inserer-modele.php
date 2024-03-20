<?php

session_start();

if(!isset($_SESSION["IDs_added"])){
	$_SESSION["IDs_added"] = [];
}

?>

<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8" />
<title>Saisissez les caractéristiques du modèle</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"
		enctype="application/x-www-form-urlencoded">
		<fieldset>
			<legend>
				<b>Modèle de voiture</b>
			</legend>
			<table>
				<tr>
					<td>Code :</td>
					<td><input type="text" name="id_modele" size="40" maxlength="30"/></td>
				</tr>
				<tr>
					<td>Nom du modèle :</td>
					<td><input type="text" name="modele" size="40" maxlength="30"/></td>
				</tr>
				<tr>
					<td>Carburant : <select name="carburant">
							<option value="essence">Essence</option>
							<option value="diesel">Diesel</option>
							<option value="gpl">G.P.L.</option>
							<option value="électrique">Electrique</option>
					</select></td>
				</tr>
				<tr>
					<td><input type="reset" value=" Effacer "></td>
					<td><input type="submit" value=" Envoyer "></td>
				</tr>
			</table>
		</fieldset>
	</form>
<?php
require ("connexpdo.inc.php");
require_once ("js.php");

if(isset($_POST["id_modele"]) && isset($_POST["modele"]) && isset($_POST["carburant"])){
	$id_modele = $_POST["id_modele"];

	if(in_array($id_modele, $_SESSION["IDs_added"]) == FALSE){

		if(strlen($id_modele) > 0 && strlen($id_modele) <= 10){
			$modele = $_POST["modele"];
			$carburant = $_POST["carburant"];

			try {
				$objdb = connexpdo("voitures");
				$qry = "INSERT INTO modele (id_modele, modele, carburant) VALUES(:id, :modele, :carburant)";
				$qryResult = $objdb->prepare($qry);
				$data=array(
					array(":id" => $id_modele, ":modele" => $modele, ":carburant" => $carburant)
				);

				$qryResult->execute($data[0]);
				array_push($_SESSION["IDs_added"], $id_modele);
			} 
			
			catch (PDOException $e) {
				displayException($e);
			}
		}

		else alert("Saisissez des valeurs");

	}
}


?>
</body>
</html>