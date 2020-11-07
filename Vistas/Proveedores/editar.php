<?php require_once 'Vistas/Encabezado.php' ?>

	<div class="shadow">
        <label><h3>Actualizar  Proveedor</h3></label><br>
      <form onsubmit="editarProveedor('<?= URL ?>');return false"  id="editarProveedor" class="form-display">
   
      <input type="text" class="form-control" name="id" required="required" value="<?php if(isset($this->proveedor)){        echo $this->proveedor['id'];}?>" hidden>

        <label>Nombre</label>
        <input type="text" class="form-control" name="proveedor" required="required" value="<?php if(isset($this->proveedor)){        echo $this->proveedor['proveedor'];}?>">

        <input type="submit" class="btn btn-success"  value="Actualizar">
      </form>
     </div>