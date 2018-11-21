<?php

require 'dbConfig.php';

if(isset($_POST["editTag"])){

	$id  = $_POST["editIDEtiqueta"];
	$nombreEtiqueta = $_POST["editNombreEtiqueta"];

	$sql = "UPDATE etiquetas SET nombre_etiqueta = ? WHERE id_etiqueta = ?";

	$result = $pdo->prepare($sql);
	$result->execute(array($nombreEtiqueta,$id));

	header("Location:admin.php");

}
?>