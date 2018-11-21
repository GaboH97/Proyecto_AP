<!-- Modal -->
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
							<select id="etiquetaSelect" class="custom-select" name="etiquetaSelect" required>
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