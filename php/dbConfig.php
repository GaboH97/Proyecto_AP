<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'Theothershore97');
   define('DB_DATABASE', 'users');
   $pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE,DB_USERNAME,DB_PASSWORD);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>