<?php require_once 'Vistas/Encabezado.php' ?>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline ml-auto" onsubmit="buscarProducto('<?= URL ?>');return false" id="formBuscar">
    <input class="form-control mr-sm-2" type="search" placeholder="Buscar"  id="buscador" required>
    <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
  </form>
  <button class="btn btn-primary my-2 my-sm-0 ml-2" onclick="SetProductos('<?= URL ?>')"><span class="icon-cycle"></span></button>
</nav>

  <div class="row" id="factura">
    <div class="col-sm-1 col-xs-1"></div>
    <div class="col-sm-10 col-xs-4">
        <label><h3>Agregar un Producto</h3></label><br>
      <form action="<?= URL ?>Producto/insert" method="POST" enctype="multipart/form-data" id="formProducto">
   
        <label>Producto</label>
        <input type="text" class="form-control " name="producto" required="required">

        <label>Valor Venta</label>
        <input type="number" class="form-control" name="V_venta" required="required" >

		    <label>Categoria</label>
        <select class="form-control" name="categoria" required="required">
          <option disabled selected>Seleccione Categoria</option>
          <!-- Hacemos la lista desplegable  -->
          <?php
          	foreach ($this->categorias as  $value) {
          ?>
          	<option  value="<?= $value['codigo']; ?>"><?= $value['nombre'];?></option>
          <?php 
            }
          ?>
        </select><br>

		<label>Descripcion</label>
        <textarea type="text" class="form-control" name="descripcion" required="required"></textarea>

        <label>Imagen</label>
        <input type="file" class="form-control"  name="imagen" required="required"><br>


        <input type="submit" class="btn btn-primary"  value="Agregar">
      </form>
      
    <hr>
    </div>
    <div class="col-sm-1 col-xs-1"></div>
    <div class="row">
      <div class="col-sm-1"> </div>
      <div class="col-sm-10">
          <div class="table-responsive">
              <h3>Lista de Productos</h3>
          <div id="contenido" class="mt-5"></div>
      </div>
      </div>
      <div class="col-sm-1"></div>
    </div>
    
  </div>

  
  <a href="#nav" class="subir"><span class="iconos icon-arrow-with-circle-up"></span></a>



<script type="text/javascript">
  $(document).ready(function(){
    SetProductos('<?= URL ?>');
  });
</script>