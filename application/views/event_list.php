<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1"
	>
	<title>Bootstrap demo</title>
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
		crossorigin="anonymous"
	>
	<link
		href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css"
		rel="stylesheet"
	>
	<script
		src="https://code.jquery.com/jquery-3.7.1.min.js"
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
		crossorigin="anonymous"
	></script>
	<script
		src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
		integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
		crossorigin="anonymous"
	></script>
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
		integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
		crossorigin="anonymous"
	></script>

</head>
<body>


<a
	href="#"
	id="btnAgregarEvento"
	class="btn btn-primary"
>Agregar nuevo evento</a>
<table
	id="tablaEventos"
	class="table table-striped table-bordered display"
>
	<thead>
	<tr>
		<th>Id</th>
		<th>Título</th>
		<th>Descripción</th>
		<th>Fecha de inicio</th>
		<th>Fecha de fin</th>
		<th>Acciones</th>
	</tr>
	</thead>
	<tbody id="bodyT">
	<?php foreach ($data as $evento): ?>
		<tr>
			<td>
				<?php echo $evento->id; ?>
			</td>
			<td>
				<?php echo $evento->title; ?>
			</td>
			<td>
				<?php echo $evento->description; ?>
			</td>
			<td>
				<?php echo $evento->start_at; ?>
			</td>
			<td>
				<?php echo $evento->end_at; ?>
			</td>
			<td>
				<a
					href="#"
					class="btn btn-secondary"
					onclick='update(<?php echo json_encode($evento); ?>)'
				>Editar</a>
				<a
					href="#"
					class="btn btn-danger"
					onclick="erase(<?php echo $evento->id; ?>)"
				>X</a>
			</td>
		</tr>

	<?php endforeach; ?>

	</tbody>
</table>

<div
	class="modal fade"
	id="modalAgregarEvento"
	tabindex="-1"
	role="dialog"
	aria-labelledby="modalAgregarEventoLabel"
	aria-hidden="true"
>
	<div
		class="modal-dialog"
		role="document"
	>
		<div class="modal-content">
			<div class="modal-header">
				<h5
					class="modal-title"
					id="modalAgregarEventoLabel"
				>Agregar evento</h5>
				<button
					type="button"
					class="close"
					data-dismiss="modal"
					aria-label="Close"
				>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formAgregarEvento">
					<input
						type="hidden"
						class="form-control"
						id="idevent"
						name="idevent"
					>
					<div class="form-group">
						<label for="titulo">Título</label>
						<input
							type="text"
							class="form-control"
							id="titulo"
							name="titulo"
							required
						>
					</div>
					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<textarea
							class="form-control"
							id="descripcion"
							name="descripcion"
							rows="3"
							required
						></textarea>
					</div>
					<div class="form-group">
						<label for="fecha_inicio">Fecha de inicio</label>
						<input
							type="datetime-local"
							class="form-control"
							id="fecha_inicio"
							name="fecha_inicio"
							required
						>
					</div>
					<div class="form-group">
						<label for="fecha_fin">Fecha de fin</label>
						<input
							type="datetime-local"
							class="form-control"
							id="fecha_fin"
							name="fecha_fin"
							required
						>
					</div>
					<button
						type="submit"
						class="btn btn-primary"
					>Guardar
					</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
	crossorigin="anonymous"
></script>


<script
	src="https://cdn.datatables.net/2.0.2/js/dataTables.js"

></script>
<script>
	function update(event) {
		$('#idevent').val(event.id);
		$('#titulo').val(event.title);
		$('#descripcion').val(event.description);
		$('#fecha_inicio').val(event.start_at);
		$('#fecha_fin').val(event.end_at);
		workUrl = updateUrl;

		$('#modalAgregarEvento').modal('show');

	}

	function erase(id = 0) {

		if (id > 0) {
			$.ajax({
				url: '<?php echo base_url('event/delete'); ?>',
				type: 'post',
				data: {
					id: id,
				},
				success: function (response) {

					tbl.ajax.reload();
				},
				error: function (error) {
					alert('Error al eliminar el evento');
				}
			});

		}
	}

	var addUrl = '<?php echo base_url('event/add'); ?>';
	var updateUrl = '<?php echo base_url('event/update'); ?>';
	var workUrl = addUrl;

	var tbl = null;
	$(document).ready(function () {
tbl = new DataTable('#tablaEventos', {
	ajax: 'event/list',
	columns: [

		{ data: 'id' },
		{ data: 'title' },
		{ data: 'description' },
		{ data: 'start_at' },
		{ data: 'end_at' },
		{ data: 'id' },
	],
	columnDefs: [
		{
			// The `data` parameter refers to the data for the cell (defined by the
			// `data` option, which defaults to the column being worked with, in
			// this case `data: 0`.
			render: (data, type, row) => {
				var t =`<a
					href="#"
					class="btn btn-secondary"
					onclick='update(${JSON.stringify(row)})'
				>Editar</a>
				<a
					href="#"
					class="btn btn-danger"
					onclick="erase(${data})"
				>X</a>`
				return t;
			},
			targets: 5
		},
	]
});
		$('#btnAgregarEvento').click(function () {
			$('#idevent').val(0);
			$('#titulo').val(null);
			$('#descripcion').val(null);
			$('#fecha_inicio').val(null);
			$('#fecha_fin').val(null);
			$('#modalAgregarEvento').modal('show');
			workUrl = addUrl;
		});

		$('#formAgregarEvento').submit(function (e) {
			e.preventDefault();
			$('#btnGuardarEvento').prop('disabled', true);
			var id = $('#idevent').val();
			var titulo = $('#titulo').val();
			var descripcion = $('#descripcion').val();
			var fecha_inicio = $('#fecha_inicio').val();
			var fecha_fin = $('#fecha_fin').val();
			$.ajax({
				url: workUrl,
				type: 'post',
				data: {
					id: id,
					title: titulo,
					description: descripcion,
					start_at: fecha_inicio,
					end_at: fecha_fin
				},
				success: function (response) {
					$('#modalAgregarEvento').modal('hide');
					$('#btnGuardarEvento').prop('disabled', false);
					tbl.ajax.reload();
				},
				error: function (error) {
					alert('Error al guardar el evento');
					$('#btnGuardarEvento').prop('disabled', false);
				}
			});
		});

	});

</script>
</body>
</html>
