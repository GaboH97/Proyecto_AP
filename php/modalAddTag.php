<!-- Modal -->
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