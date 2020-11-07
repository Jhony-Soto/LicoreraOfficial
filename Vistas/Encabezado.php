<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?= APP_NAME ?>-	<?=$this->titulo; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="icon" type="image/png" href="<?= URL ?>Recursos/img/icono.png" />

	<!-- Estilos de boostrap -->
	<link rel="stylesheet" type="text/css" href="<?= URL ?>Recursos/bootstrap4/bootstrap.min.css">
	<!-- Font icon -->
	<link rel="stylesheet" href="<?= URL ?>Recursos/fonts/style.css">
	<!-- Estilos css -->
    <link href="<?= URL ?>Recursos/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>Recursos/css/estilo.css">
    <link rel="stylesheet" href="<?= URL ?>Recursos/css/dashboard.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!-- SELECT -->
	<link rel="stylesheet" type="text/css" href="<?= URL ?>Recursos/select2/css/select2.css">
		

	<!-- script de boostrap -->
<script type="text/javascript" src="<?= URL ?>Recursos/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/bootstrap4/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/select2/js/select2.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/bootstrap4/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/javascript/sweetalert.min.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/javascript/funciones.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/javascript/compras_ventas.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/javascript/Proveedor.js"></script>
<script type="text/javascript" src="<?= URL ?>Recursos/jquery/dashboard.js"></script>




</head>
<body>
	<?php 
      if (isset($_SESSION['user'])) {
	?>
    <div class="wrapper">
          <div class="contenedor-menu">
              <a href="#" class="btn-menu">Menu <span class="iconos right icon-menu"></span></a>

              <ul class="menu">
                  <div class="logo-user">
                      <img src="<?= URL ?>Recursos/img/logo2.png">
                      <hr>
                  </div>
                  <li><span class="iconos icon-lock"></span><a href="<?= URL ?>Login/closeSesion">Cerrar session</a></li>
                  <hr>
                  <li><span class="iconos icon-home"></span><a href="<?= URL ?>Home">Inicio</a></li>
                  <hr>
                  <li><span class="iconos icon-open-book"></span>Inventario<span class="iconos right icon-chevron-down"></span>
                      <ul class="submenu">
                          <li><a href="<?= URL ?>Producto">Productos</a></li>
                          <li><a href="<?= URL ?>Categoria">Categoria</a></li>
                      </ul>
                  </li>
                  <li><span class="iconos icon-arrow-left"></span>Compras<span class="iconos right icon-chevron-down"></span>
                      <ul class="submenu">
                          <li><a href="<?= URL ?>Compras">Realizar Compra</a></li>
                          <li><a href="<?= URL ?>Compras/comprasHechas">Compras hechas</a></li>
                      </ul>
                  </li>
                  <li><span class="iconos icon-arrow-bold-right"></span>Ventas<span class="iconos right icon-chevron-down"></span>
                      <ul class="submenu">
                          <li><a href="<?= URL ?>Ventas">Realizar Venta</a></li>
                          <li><a href="<?= URL ?>Ventas/ventasHechas">Ventas Hechas</a></li>
                      </ul>
                  </li>
                  <li><span class="iconos icon-user"></span><a href="<?= URL ?>Proveedores">Proveedores</a></li>
                  <li><span class="iconos icon-eye"></span><a href="<?= URL ?>Visitas">Visitas</a></li>
              </ul>
          </div>

          <div id="paginas">
	    
  
          </div>
    </div>
    <?php
      }else{
    ?>

  <!-- ********  MENU DEL CATALOGO******-->
    <header id="nav" class="bg-dark">
            <section class="nav" id="nav">
                <div class="logo">
                    <img src="<?= URL ?>Recursos/img/logo2.png" alt="">
                </div>

                <div class="form-buscador">
                    <form onsubmit="buscarProductoCliente('<?= URL ?>');return false">
                        <input type="text" placeholder="Buscar Productos"id="buscador" autocomplete="off" required>
                        <button title="Buscar" type="submit"><i class="fa fa-search"></i></button>
                     </form>
                </div>
                
                <div class="enlaces">
                    <a href="https://www.facebook.com/Licorera-4-esquinas-103924317986011"><span class="icon-facebook-with-circle face"></span></a>
                    <a href="https://www.instagram.com/licorera_4_esquinas/?hl=es-la"><span class="icon-instagram-with-circle insta"></span></a>
                </div>
            </section>
    </header>
    <div id="relleno"></div> 
      <?php } ?>



<script type="text/javascript">
	$('#menu-toggle').click(function(e){
		e.preventDefault();
		    $('#content-wrapper').toggleClass('toggled');

	});
</script>