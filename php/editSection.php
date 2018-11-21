<?php

require 'dbConfig.php';

if(isset($_POST["editIDSeccion"])){
	$id  = $_POST["editIDSeccion"];
	$fechaPublicacion  = $_POST["editFechaPublicacion"];
	$titulo  = $_POST["editTituloSeccion"];
	$contenido  = $_POST["editContenidoSeccion"];
	$fuente  = $_POST["editFuenteContenido"];
	$ilustracion = $_POST["editUrlImagen"];
	$idEtiqueta =  $_POST["editEtiquetaSelect"];

	$sql = "UPDATE secciones SET fecha_publicacion=?, titulo=?, contenido=?, fuente=?, ilustracion=?, id_etiqueta=? WHERE id_seccion=?";

	$result = $pdo->prepare($sql);
	$result->execute(array($fechaPublicacion,$titulo,$contenido,$fuente,$ilustracion,$idEtiqueta,$id));

	header("Location: admin.php");
}


?>
