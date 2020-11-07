<?php require_once 'Vistas/Encabezado.php' ?>

<section>
	<div class="container shadow">
		<div class="row">
			<div class="col-sm-4">
				<h2>TOTAL DE VISITAS</h2>
				<button class="btn btn-danger"><?= $this->total[0] ?></button>
			</div>

			<div class="col-sm-4">
				<h2>FILTRAR POR FECHAS</h2>
				<form id="formVisitas" onsubmit="consultarVisitas('<?= URL ?>');return false;">
					<label>Fecha Inicial</label>
					<input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" required>
					<label>Fecha Final</label>
					<input type="date" class="form-control" id="fecha_final" name="fecha_final" required><br>
					<button type="submit" class="btn btn-primary">Consultar</button>

				</form><br>

				<div id="contenido"></div>
			</div>
		</div>
	</div>
</section>

