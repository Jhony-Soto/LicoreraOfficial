<?php require_once 'Vistas/Encabezado.php' ?>


 <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
    <a class="btn btn-info ml-4" href="<?= URL ?>Producto">Productos</a>
    <a class="btn btn-info ml-4" href="<?= URL ?>Categoria">Categoria y Aumento</a>
  </nav>
</div>

<section>
	<div class="container">
  		<div class="row">
    		<div class="col-sm-4">
      			<form id="frmcategoria" onsubmit="aggCategoria('<?= URL ?>');return false">
        			<label><h3>Agregar una Categoria</h3></label><br>
        			<input type="text"  class="frm-control input-sm" name="categoria" required autocomplete="off"><br><br>
        			<input type="submit" class="btn btn-primary" value="Agregar">
      			</form>
    		</div>
    		<div class="table-responsive  col-sm-8">
       			<h3>Lista de categorias</h3>
      			<div id="contenido"></div>
   			 </div>
 		 </div>


     <div class="row">
        <div class="col-sm-4">
            <form id="frmaunmento" onsubmit="aggAumento('<?= URL ?>');return false">
              <label><h3>Agregar Aumento</h3></label><br>
              <input type="number"  class="frm-control input-sm" name="aumento" required autocomplete="off"><br><br>
              <input type="submit" class="btn btn-primary" value="Agregar">
            </form>
        </div>
        <div class="table-responsive  col-sm-8">
            <h3>Lista de aumentos</h3>
            <div id="tablaAumento"></div>
         </div>
     </div>
	</div>
</section>


<script type="text/javascript">
	$(document).ready(function(){
		cargarCategoria('<?php echo URL ?>');
        cargarAumento('<?php echo URL ?>');
	});
</script>