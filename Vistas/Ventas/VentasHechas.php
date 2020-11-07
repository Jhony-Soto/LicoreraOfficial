<?php require_once 'Vistas/Encabezado.php' ?>

      <div class="ventana">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalle de venta</h5>
            </div>
            <div class="modal-body" id="detalleventa">
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="cerrarVentana()">Cerrar</button>
          </div>
        </div>
    </div>


  <div  class="shadow my-5">
    <h3>Ventas Hechas.</h3>
		<div>
      <input type="text" id="URL" value="<?= URL ?>" hidden>
			<form id="form_filtrarventa" class="form-display" onsubmit="filtrarVenta('<?= URL ?>');return false">
				<label>Fecha Inicial</label>
				<input type="date" class="form-control" name="fechainicial" required>
				<label>Fecha Final</label>
				<input type="date" class="form-control" name="fechafinal" required>
				<button  type="submit" class="btn btn-primary"><span class="icon-cycle"></span></button>
			</form>
		</div>
	
	<hr>

	<div id="contenido">
    <p class="mt-5"><strong>En la tabla vemos el total de Ventas que se 
                  han hecho  el dia de hoy.</strong></p>
		<table class="table table-hover table-condensed table-bordered table-responsive" style="text-align:center;">
         	<tr style="font-weight:bold;" class="bg-light">
            <td>ID</td>
           		<td>TOTAL EN VENTAS</td>
           		<td>NUMERO DE PRODUCTOS VENDIDOS</td>	
              <td>TOTAL EN GANANCIAS</td>	
              <td>VER DETALLE</td>	
         	</tr>

         	<?php 
          $total=0;
          foreach ($this->reporteVentas as$value) {
         	 ?>
         	  <tr class="bg-light">
                <td><?= '',$value['fecha']?></td>
        		    <td><?= '$ '.number_format($value['Total_de_ventas'],0)?></td>
        		    <td><?=$value['Numero_de_ventas']?></td>
                <td>$<?=number_format($value['Total_de_ganancias'],0)?></td>
                <td><button class="btn btn-warning" onclick="detalleVenta('<?= $value['id'] ?>','<?= URL ?>')"><span class="icon-eye"></span></button></td>
        	</tr>
        <?php
          $total=$total+$value['Total_de_ganancias'];
         }
          ?>
          <tr style="font-weight:bold;">
            <td colspan="3" >total</td>
            <td>$ <?= number_format($total,0) ?></td>
          </tr>
        </table>
	</div>	
  </div>
  

	