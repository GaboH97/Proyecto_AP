<?php 
include("dbConfig.php");
session_start();
if(isset($_POST['addSection'])){
	try {
		$sql_query = "INSERT INTO SECCIONES (fecha_publicacion,titulo,contenido,fuente,ilustracion,id_etiqueta) VALUES (?,?,?,?,?,?)";
		$data = $pdo->prepare($sql_query);
		$data->execute(array($_POST["fechaPublicacion"],
			$_POST["tituloSeccion"],
			$_POST["contenidoSeccion"],
			$_POST["fuenteContenido"],
			$_POST["urlImagen"],
			(!empty($_POST["etiquetaSelect"]))?$_POST["etiquetaSelect"]:NULL));
	} catch (PDOException $e) {
		print "¡Error!: " . $e->getMessage() . "<br/>";
		die();

	}
}

if(isset($_POST['addTag'])){
	try {
		$sql_query = "INSERT INTO ETIQUETAS (nombre_etiqueta) VALUES (?)";
		$data = $pdo->prepare($sql_query);
		$data->execute(array($_POST["nombreEtiqueta"]));
		
	} catch (PDOException $e) {
		print "¡Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

if(isset($_POST['tagID'])){
/*	try {
		$sql_query = "INSERT INTO ETIQUETAS (nombre_etiqueta) VALUES (?)";
		$data = $pdo->prepare($sql_query);
		$data->execute(array($_POST["nombreEtiqueta"]));
		
	} catch (PDOException $e) {
		print "¡Error!: " . $e->getMessage() . "<br/>";
		die();
	}*/
	echo "percho";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script type="text/javascript" src="../js/admin.js"></script>
	<title>Admin Dashboard</title>
</head>
<body>

	<header><p>Admin Dashboard</p></header>

	<div class="tab">
		<button id="default" class="tablinks" onclick="openTab(event, 'Usuarios')">Usuarios</button>
		<button class="tablinks" onclick="openTab(event, 'Secciones')">Secciones</button>
		<button class="tablinks" onclick="openTab(event, 'Etiquetas')">Etiquetas</button>
	</div>

	<!-- Modal Add Section-->
	<div class="modal fade" id="addSectionModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Agregar Sección</h4>
				</div>
				<form action="" method="POST">
					<div class="modal-body">
						<div class="input-group date">
							<label for="fechaPublicacion">Fecha publicación</label>
							<input type="text" class="form-control" id="fechaPublicacion" name="fechaPublicacion" placeholder="YYYY-MM-DD">
						</div>
						
						<div class="form-group">
							<label for="tituloSeccion">Título</label>
							<input type="text" class="form-control" id="tituloSeccion" name="tituloSeccion"  placeholder="Título">
						</div>
						<div class="form-group">
							<label for="contenidoSeccion">Contenido</label>
							<textarea class="form-control" id="contenidoSeccion"  name="contenidoSeccion"rows="4"></textarea>
						</div>
						<div class="form-group">
							<label for="fuenteContenido">Fuente Contenido</label>
							<input type="text" class="form-control" id="fuenteContenido" name="fuenteContenido"placeholder="Fuente contenido">
						</div>
						<div class="form-group">
							<label for="urlImagen">URL Imagen</label>
							<input class="form-control" id="urlImagen" name="urlImagen"></input>
						</div>
						<div class="form-group">
							<label for="etiquetaSelect">Etiqueta</label>
							<select id="etiquetaSelect" class="custom-select" name="etiquetaSelect" >
								<option value="" selected>Escoge una etiqueta</option>
								<?php 
								$sql_query = "SELECT id_etiqueta,nombre_etiqueta FROM etiquetas";
								$resultSet = $pdo->prepare($sql_query);
								$resultSet->execute();
								while ($row = $resultSet->fetch(PDO::FETCH_OBJ)) {
									echo "<option value='$row->id_etiqueta'>$row->nombre_etiqueta</option>";
								}
								?>
							</select>
						</div>
					</form>
					<script>
						$( "#fechaPublicacion" ).datepicker({
							format: 'yyyy-mm-dd',
						});
					</script>

					<button class="btn btn-primary" name="addSection" type="submit">Agregar</button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Edit Section-->
	<div class="modal fade" id="editSectionModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Editar Sección</h4>
				</div>
				<form action="editSection.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="id">ID</label>
							<input type="text" class="form-control" id="editIDSeccion" name="editIDSeccion" readonly="readonly">
						</div>
						<div class="input-group date">
							<label for="editFechaPublicacion">Fecha publicación</label>
							<input type="text" class="form-control" id="editFechaPublicacion" name="editFechaPublicacion">
						</div>
						
						<div class="form-group">
							<label for="editTituloSeccion">Título</label>
							<input type="text" class="form-control" id="editTituloSeccion" name="editTituloSeccion" >
						</div>
						<div class="form-group">
							<label for="editContenidoSeccion">Contenido</label>
							<textarea class="form-control" id="editContenidoSeccion"  name="editContenidoSeccion"rows="4"></textarea>
						</div>
						<div class="form-group">
							<label for="editFuenteContenido">Fuente Contenido</label>
							<input type="text" class="form-control" id="ditFuenteContenido" name="editFuenteContenido">
						</div>
						<div class="form-group">
							<label for="editUrlImagen">URL Imagen</label>
							<input type="text" class="form-control" id="editUrlImagen" name="editUrlImagen"></input>
						</div>
						<div class="form-group">
							<label for="editEtiquetaSelect">Etiqueta</label>
							<select id="editEtiquetaSelect" class="custom-select" name="editEtiquetaSelect" required>
								<option value="" selected>Escoge una etiqueta</option>
								<?php 
								$sql_query = "SELECT id_etiqueta,nombre_etiqueta FROM etiquetas";
								$resultSet = $pdo->prepare($sql_query);
								$resultSet->execute();
								while ($row = $resultSet->fetch(PDO::FETCH_OBJ)) {
									echo "<option value='$row->id_etiqueta'>$row->nombre_etiqueta</option>";
								}
								?>
							</select>
						</div>

						<script>
							$( "#editFechaPublicacion" ).datepicker({
								format: 'yyyy-mm-dd',
							});
						</script>

						<button class="btn btn-primary edit-sec" name="editSection" type="submit" id="editSection">Guardar</button>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Add Tag-->
	<div class="modal fade" id="addTagModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Agregar Etiqueta</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST">
						<div class="form-group">
							<label for="nombreEtiqueta">Nombre etiqueta</label>
							<input type="text" class="form-control" id="nombreEtiqueta" name="nombreEtiqueta"placeholder="Nombre">
						</div>
						<button class="btn btn-primary" name="addTag" type="submit">Agregar</button>
					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Modal Edit Tag-->
	<div class="modal fade" id="editTagModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Editar Etiqueta</h4>
				</div>
				<div class="modal-body">
					<form action="editTag.php" method="POST">
						<div class="form-group">
							<label for="id">ID</label>
							<input type="text" class="form-control" id="editIDEtiqueta" name="editIDEtiqueta" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="nombreEtiqueta">Nombre etiqueta</label>
							<input type="text" class="form-control" id="editNombreEtiqueta" name="editNombreEtiqueta"placeholder="Nombre">
						</div>

						<button class="btn btn-primary" name="editTag" id="editTag" type="submit">Guardar</button>
					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Modal delete Tag -->
	<div id="deleteTagModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="deleteTag" id="deleteTag">
					<div class="modal-header">						
						<h4 class="modal-title">Eliminar Etiqueta</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>¿Seguro que quieres eliminar esta etiqueta</p>
						<p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
						<input type="hidden" name="idEtiqueta" id="idEtiqueta">
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-danger" value="Eliminar">
					</div>
				</form>
			</div>
		</div>
	</div>



	<div id="Usuarios" class="tabcontent">
		<h3>Usuarios</h3>
		<!-- <button type="btn btn-info btn-lg"  data-toggle="modal" data-target="#addSectionModal">Agregar Usuario</button> -->
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Fecha Nacimiento</th>
					<th>Género</th>
					<th>Correo</th>
				</tr>
			</thead>
			<tbody id="secTable">
				<?php 

				$sql_query = "SELECT user_name,birthdate,genre,email FROM users";
				$resultSet = $pdo->prepare($sql_query);
				$resultSet->execute();

				while($result = $resultSet->fetch(PDO::FETCH_OBJ)){
					echo "<tr>
					<td>$result->user_name</td>
					<td>$result->birthdate</td>
					<td>$result->genre</td>
					<td>$result->email</td>
					</tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<div id="Secciones" class="tabcontent">
		<h3>Secciones</h3>  
		<button type="btn btn-info btn-lg"  data-toggle="modal" data-target="#addSectionModal">Agregar Seccion</button>
		<div style="overflow-y: auto">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Título</th>
						<th>Etiqueta</th>
						<th>Editar</th>
						<th>Borrar</th>
					</tr>
				</thead>
				<tbody id="secTable">
					<?php 

					$sql_query = "SELECT s.id_seccion,s.fecha_publicacion, s.titulo, s.contenido, s.fuente, s.ilustracion, e.nombre_etiqueta FROM secciones s LEFT JOIN etiquetas e ON s.id_etiqueta = e.id_etiqueta";
					$resultSet = $pdo->prepare($sql_query);
					$resultSet->execute();

					while($result = $resultSet->fetch(PDO::FETCH_OBJ)){
						$tag = ($result->nombre_etiqueta===NULL)?'Sin etiqueta':$result->nombre_etiqueta;
						echo "<tr>
						<td>$result->id_seccion</td>
						<td>$result->titulo</td>
						<td>$tag</td>  
						<td data-id ='$result->id_seccion'><button class='btn btn-info' data-toggle='modal' data-target='#editSectionModal' data-id='$result->id_seccion' data-titulo='$result->titulo' data-fechaPub='$result->fecha_publicacion' data-contenido='$result->contenido' data-fuente='$result->fuente' data-ilustracion='$result->ilustracion'>Editar</button></td>
						<td data-id ='$result->id_seccion'><button class='btn btn-danger remove-sec'>Borrar</button></td>
						</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div id="Etiquetas" class="tabcontent">
		<h3>Etiquetas</h3>
		<button type="btn btn-info btn-lg"  data-toggle="modal" data-target="#addTagModal">Agregar Etiqueta</button>
		<div class="">
			<table class="table table-fixed table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Contador</th>
						<th colspan="2">Acciones</th>
						
					</tr>
				</thead>
				<tbody id="tagTable">
					<?php 

					$sql_query = "SELECT * FROM etiquetas";
					$resultSet = $pdo->prepare($sql_query);
					$resultSet->execute();

					while($result = $resultSet->fetch(PDO::FETCH_OBJ)){
						echo "<tr>
						<td>$result->id_etiqueta</td>
						<td>$result->nombre_etiqueta</td>
						<td>$result->contador</td>
						<td data-id ='$result->id_etiqueta'><button class='btn btn-info edit-item'data-toggle='modal' data-target='#editTagModal' data-id='$result->id_etiqueta' data-nombre='$result->nombre_etiqueta'>Editar</button></td>
						<td data-id ='$result->id_etiqueta'><button class='btn btn-danger remove-tag'>Borrar</button></td>
						</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>