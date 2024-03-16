<h1>Agregar nuevo evento</h1>

<?php echo form_open('event/add'); ?>

<label for="nombre">Titulo del evento:</label> <input type="text" name="title" id="title" />
<label for="nombre">Descripcion del evento:</label> <input type="text" name="description" id="description" />
<label for="nombre">Fecha de inicio del evento:</label> <input type="text" name="start_at" id="start_at" />
<label for="nombre">Fecha de fin del evento:</label> <input type="text" name="end_at" id="end_at" />


<input type="submit" value="Agregar" />

<?php echo form_close(); ?>
