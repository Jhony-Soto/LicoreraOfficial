<?php require_once 'Vistas/Encabezado.php' ?>


<div class="row shadow" id="factura">
    <div class="col-sm-12">
        <label><h3>Agregar un Proveedor</h3></label><br>
      <form onsubmit="insertProveedor('<?= URL ?>');return false"  id="formProveedor" class="form-display">
   
        <label>Proveedor</label>
        <input type="text" class="form-control " name="proveedor" required="required">

        <input type="submit" class="btn btn-primary"  value="Agregar">
      </form>
      
    <hr>
    </div>
    <div class="table-responsive">
       <h3>Lista de Proveedores</h3>
        <div id="contenido" class="mt-5"></div>
      
    </div>
  </div>


<script type="text/javascript">
  $(document).ready(function(){
    setProveedores('<?= URL ?>');
  });
</script>