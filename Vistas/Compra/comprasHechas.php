<?php require_once 'Vistas/Encabezado.php' ?>

  <div  class="shadow my-5">
		<div>
      <h2>Compras hechas.</h2>
			<form id="form_filtrar" class="form-display" onsubmit="filtrarCompras('<?= URL ?>');return false">
				<label>Fecha Inicial</label>
				<input type="date" class="form-control" name="fechainicial" required>
				<label>Fecha Final</label>
				<input type="date" class="form-control" name="fechafinal" required>
				<button  type="submit" class="btn btn-primary"><span class="icon-cycle"></span></button>
			</form>
		</div>
	

	<div id="contenido">
  <p class="mt-5"><strong>En la tabla vemos el total de compras que se 
                  han hecho hasta el dia de hoy a cada proveedor.</strong></p>
		<table class="table table-hover table-condensed table-bordered table-responsive" style="text-align:center;">
         	<tr style="font-weight:bold;" class="bg-light">
           		<td>PROVEEDOR</td>
           		<td>TOTAL EN COMPRAS</td>
           		<td>NUMERO DE COMPRAS</td>			
         	</tr>
         	<?php foreach ($this->reporteCompras as$value) {
         	 ?>
         	 <tr class="bg-light">
        		<td><?=$value['proveedor']?></td>
        		<td><?= '$ '.number_format($value['Total_de_compras'],0)?></td>
        		<td><?=$value['Numero_de_compras']?></td>
        	</tr>
        <?php } ?>
        </table>
	</div>	
  </div>
	