<?php

session_start();

include('dbConfig.php');

$new_pref_ids = $_POST['new_pref'];

$rem_usr_pref_sql = "DELETE FROM preferencias WHERE user_name =?";
$rem_usr_pref_rs = $pdo->prepare($rem_usr_pref_sql);
$rem_usr_pref_rs->execute(array($_SESSION['uname']));

$add_usr_pref_sql = "INSERT INTO preferencias (user_name,id_seccion,seleccionado) VALUES (?,?,?)";
$add_usr_pref_rs = $pdo->prepare($add_usr_pref_sql);

$pref_arr = explode (",", $new_pref_ids);

foreach ($pref_arr as $sec_pref_id) {
	$add_usr_pref_rs->execute(array($_SESSION['uname'],$sec_pref_id,'S'));
}

$_SESSION['logged'] = NULL;
session_destroy();

echo "OK";

?>