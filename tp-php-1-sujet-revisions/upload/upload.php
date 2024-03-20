<!DOCTYPE html>
<html>
<head>
<title>Téléversement de fichier</title>
</head>
<body>
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post"
		enctype="multipart/form-data">
		<fieldset>
			<legend>
				<b>Transférez un fichier ZIP</b>
			</legend>
			<table border="1">
				<tr>
					<td>Choisissez un fichier</td>
					<td><input type="file" name="fich" accept="application/zip" /></td>
					<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="ENVOI" /></td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>
<?php

if(isset($_FILES["fich"])){
	$tailleMax = $_POST["MAX_FILE_SIZE"];
	$file_name = $_FILES["fich"]["name"];
	$file_size = $_FILES["fich"]["size"];

	if($tailleMax > $file_size){
		echo "Fichier bien déposé => nom : $file_name, taille : $file_size";
	}

	else echo "Ah non c'est trop lourd gros malin";
}

?>