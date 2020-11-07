<?php require_once 'Vistas/Encabezado.php' ?>

 <div class="container mb-5">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
    <a class="btn btn-info ml-4" href="<?= URL ?>Producto">Productos</a>
    <a class="btn btn-info ml-4" href="<?= URL ?>Categoria">Categoria y Aumento</a>
  </nav>
</div>

  <div class="shadow pr-5">

      <form action="<?= URL ?>Producto/actualizar" method="POST" enctype="multipart/form-data">
        <label><h3>Actualizar  Producto</h3></label><br>
   
      <input type="text" class="form-control" name="codigo" required="required" value="<?php if(isset($this->producto)){        echo $this->producto['codigo'];}?>" hidden>

        <label>Producto</label>
        <input type="text" class="form-control" name="producto" required="required" value="<?php if(isset($this->producto)){        echo $this->producto['producto'];}?>">

        <input type="text" class="form-control" name="cantidad" required="required" value="<?php if(isset($this->producto)){        echo $this->producto['cantidad'];}?>" hidden>

        <input type="text" class="form-control" name="v_unidad" required="required" value="<?php if(isset($this->producto)){        echo $this->producto['Valor_unidad'];}?>" hidden>



        <label>Valor Venta</label>
        <input type="number" class="form-control" name="V_venta" required="required" value="<?php if(isset($this->producto)){     echo $this->producto['Valor_venta'];} ?>">

		    <label>Categoria</label>
        <select class="form-control" name="categoria" required="required" value="<?php if(isset($this->producto)){                                                                                            echo $this->producto['                                                                                                cod_categoria'];} ?>" >
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
        <input type="text" class="form-control" name="descripcion" required="required" value="<?php if(isset($this->producto)){ echo $this->producto['Descripcion'];} ?>">

        <label>Imagen</label>
        <input type="file" class="form-control"  name="imagen" required="required" value="<?php if(isset($this->producto)){ echo $this->producto['imagen'];} ?>" ><br>

        <div>
        <img src="<?= URL.$this->producto ['imagen']?>">
        <caption><?=$this->producto ['imagen']?></caption>
        </div>

        <input type="submit" class="btn btn-success"  value="Actualizar">
      </form>
  </div>