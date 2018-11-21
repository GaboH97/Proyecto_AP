<?php

session_start();

if(!isset($_SESSION['logged'])){
	header("Location: ../index.html");
}else{

}

include('dbConfig.php');


$user_name =  $_SESSION['uname'];

//CHECK IF USER HAS PREFERENCES

$check_user_pref_query = "SELECT COUNT(user_name) count_pref FROM preferencias where user_name =?";
$cupref_rs = $pdo->prepare($check_user_pref_query);
$cupref_rs->execute([$user_name]);


//IF USER HAS NO PREFERENCES, 
if($sql->fetch(PDO::FETCH_OBJ)->count_pref == 0){

}

$sql_query = "SELECT * FROM SECCIONES";
$stmt = $pdo->prepare($sql_query);
$stmt->execute();

$content = $stmt;

	if(isset($_POST['updatePref'])){//to run PHP script on submit
		if(!empty($_POST['check_list'])){
		// Loop to store and display values of individual checked checkbox.		
			foreach($_POST['check_list'] as $selected_sect){
				$sql_query2 = "INSERT INTO PREFERENCIAS (user_name,id_seccion,seleccionado) VALUES (?,?,?) ON DUPLICATE KEY UPDATE user_name='".$user_name."'";
				$stmt2 = $pdo->prepare($sql_query2);
				$stmt2->execute(array($user_name,$selected_sect,'S'));
			}
				//Update page and show user preferences
			echo "<meta http-equiv='refresh' content='0'>";		
		}
	}

	//Update tags when visiting new 

	if (!$_SESSION['loaded'])
	{
		$sql_query = "UPDATE etiquetas SET contador = contador + 1 WHERE id_etiqueta IN (SELECT distinct(s.id_etiqueta) FROM preferencias p JOIN secciones s ON p.id_seccion = s.id_seccion WHERE p.user_name = ?)";

		$result = $pdo->prepare($sql_query);
		$result->execute(array($user_name));
	}

	$_SESSION['loaded'] = true;
	
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<title>Practica_14</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="../css/main_page.css">
		<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../js/mainpage2.js"></script>
	</head>
	<body>

		<div id="pageBody">
			<header id="header">
				<h1 style="float: left;">Tópicos de Ingeniería en Computación</h1>
				<p style ="float: right;"><a href = "logout.php">Salir</a></h2>
					<p style ="float: right;">Bienvenido <span id="username"><?php
					echo $_SESSION['uname'] ?></span></p>

				</header> 	
				<nav id="navbar">
					<ul>
						<?php  
						while ($row = $content->fetchColumn(2)){
							echo "<li>$row</li>";
						} 
						?>
					</ul>
				</nav>

				<div style="display: block; margin:0;padding:20px" >
					<h1 style="padding-bottom: 20px;">¿Qué secciones deseas ver?</h1>
					<?php

					$sql_query = "SELECT s.*, p.user_name FROM secciones s LEFT JOIN preferencias p ON s.id_seccion = p.id_seccion";
					$sql = $pdo->prepare($sql_query);
					$sql->execute();

					while($result = $sql->fetch(PDO::FETCH_OBJ)){
						if(strcmp($result->user_name,$user_name) ==0){
							echo "<input type='checkbox' name='checkbox' value='$result->id_seccion' checked><label>$result->titulo</label><br/>";
						}else{
							echo "<input type='checkbox' name='checkbox' value='$result->id_seccion'><label>$result->titulo</label><br/>";
						}
					}
					?>
					
				</div>

				<!-- END OF SNIPPET CODE -->

				<aside id="rightCol">
					<?php
					echo "<p>Tópicos más visitados<p>";
					//SHOW TOP 3 TRENDING TOPICS
					$tt_query = "SELECT nombre_etiqueta, contador FROM etiquetas ORDER BY  contador DESC LIMIT 3";
					$tt_rs = $pdo->prepare($tt_query);
					$tt_rs->execute();
					while ($row = $tt_rs->fetch(PDO::FETCH_OBJ)){
						echo "<blockquote><a href='#'>".$row->nombre_etiqueta." (".$row->contador." visitas)</a></blockquote>";
					} 
					?>
				</aside>


				<!-- SECTIONS -->

				<?php
				$content->execute();
				while ($row = $content->fetch(PDO::FETCH_OBJ)){
					echo "<section id='sec".$row->id_seccion."'><article>";
					echo '<header class ="topicHeader" id="topic1"><h1 onclick="showSection(this)">'.$row->titulo.'</h1></header>';
					echo '<time datetime="'.$row->fecha_publicacion.'" pubdate="pubdate">Publicado en '.$row->fecha_publicacion.'</time>';
					echo "<p>".$row->contenido."</p>";
					echo '<picture><img src="'.$row->ilustracion.'" alt ="ilustracion de '.$row->titulo.'" style="width:100%;"></picture>';
					echo "<footer class='artfooter'>Tomado de: <strong>".$row->fuente."</strong>
					</footer>";
					echo "</article></section>";
				} 
				?>

				<footer id="mainFooter">
					Derechos Reservados &copy; 2018
				</footer> 

			</div>
		</body>
		</html>