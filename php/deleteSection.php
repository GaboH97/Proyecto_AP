<?php

require 'dbConfig.php';

$id  = $_POST["id"];

$sql = "DELETE FROM secciones WHERE id_seccion = ?";

$result = $pdo->prepare($sql);
$result->execute(array($id));

echo json_encode([$id]);

?>