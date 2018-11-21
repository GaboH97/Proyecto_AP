<?php

require 'dbConfig.php';

	$id  = $_POST["id"];

	$sql = "DELETE FROM etiquetas WHERE id_etiqueta = ?";

	$result = $pdo->prepare($sql);
	$result->execute(array($id));


	header("Location:admin.php");
?>