<?php require_once 'Vistas/Encabezado.php' ?>

<div class="row">

	<div class="col-sm-12" >
		<div class="shadow"	>
			<center>
				<h2>Estas realizando una venta.</h2>
				<button class="btn btn-primary mb-5" onclick="generarVenta('<?= URL ?>')">Generar Venta</button>
			</center>
		<form id="venta" class="form-display" onsubmit="tablaTemporalventa('<?= URL ?>'); return false">
			<label class="ml-3">PRODUCTO</label>
			<select class="form-control" name="producto" id="select_producto"  onchange="consultarProducto(this.value,'<?= URL ?>','venta')" required>
				<option value="" selected disabled>Seleccione</option>

				<?php foreach ($this->productos as  $value) {
 				?>
					<option value="<?= $value['codigo'] ?>"><?= $value['producto'] ?>- <?= $value['Descripcion'] ?></option>
				<?php } ?>
			</select>

			<label class="ml-3">CANTIDAD</label>
			<input type="number" name="cantidad" class="form-control" required>

			<label class="ml-3">Valor Venta</label>
			<input type="number" name="valor_unidad"class="form-control" id="valor_venta" required>
			
			<button type="submit" class="btn btn-success" id="agg_venta"><span class="icon-circle-with-plus"></span></button>
		</form>
		<button class="btn btn-danger" onclick="limpiarTablaventas('<?= URL ?>')">Limpiar tabla</button>
		 
		<div id="tablaventa"></div>
		</div>	   	
	

	</div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#select_producto').select2();
		cargarTablaTempventa('<?= URL ?>');
	})
</script>