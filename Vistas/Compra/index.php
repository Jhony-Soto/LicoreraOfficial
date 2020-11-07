<?php require_once 'Vistas/Encabezado.php' ?>


<div class="row">

	<div class="col-sm-12" >
		<div class="shadow">
			<h2>ESTAS REALIZANDO UNA COMPRA.</h2>
			<form class="form-display my-5" id="comprar" onsubmit="generarCompra('<?= URL ?>');return false">
				<label class="ml-3">PROVEEDOR</label>
				<select class="form-control" name="proveedor"  required>
					<option value="" selected disabled>Seleccione</option>

				</select><br>
				<button class="btn btn-success">Generar Compra</button>
			</form>
		</div>
		<hr>
		<div class="shadow"	>
		<form id="compra" class="form-display" onsubmit="tablaTemporal('<?= URL ?>'); return false">
			<label class="ml-3">PRODUCTO</label>
			<select class="select2" name="producto" id="select_producto" onchange="consultarProducto(this.value,'<?= URL ?>','compra')" required>
				<option value="" disabled selected> Seleccione</option>
			</select>

			<label class="ml-3">CANTIDAD</label>
			<input type="number" name="cantidad"class="form-control" required>

			<label class="ml-3">Valor Unidad</label>
			<input type="number" name="valor_unidad"class="form-control" id="valor_venta" required>
			
			<button type="submit" class="btn btn-success"><span class="icon-circle-with-plus"></span></button>
		</form>
		<button class="btn btn-danger" onclick="limpiarTabla('<?= URL ?>')">Limpiar tabla</button>
		<div id="tabla"></div>
		</div>	   	
	
		 

	</div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#select_producto').select2();
		cargarTablaTemp('<?= URL ?>');
	})
</script>