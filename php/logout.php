<?php

session_start();

include('dbConfig.php');

$new_pref_ids = $_POST['new_pref'];

$rem_usr_pref_sql = "DELETE FROM preferences WHERE user_name =?";
$rem_usr_pref_rs = $pdo->prepare($rem_usr_pref_sql);
$rem_usr_pref_rs->execute(array($_SESSION['uname']));

$add_usr_pref_sql = "INSERT INTO preferencias(user_name,id_seccion,seleccionado) VALUES (?,?,?)";
$add_usr_pref_rs = $pdo->prepare($add_usr_pref_sql);

foreach ($new_pref_ids as $sec_pref_id) {
	$add_usr_pref_rs->execute($_SESSION['uname'],$sec_pref_id,'S'));
}

$_SESSION['logged'] = NULL;
session_destroy();

?>