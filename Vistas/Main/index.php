<?php require_once 'Vistas/Encabezado.php' ?>
 
<section class="section-main">
    <div class="title"> 
        <h1>Estanquillo 4 Esquinas</h1>
        <p>Disfruta del mejor licor con  toda la seguridad.<br>Porque estas tomando licor de la mejor calidad.</p>
    </div>
    <img src="<?= URL ?>Recursos/img/licor.jpg">

</section>

<section class="slider">
    <div class="slider-titulo">
        <span class="icon-star"></span>
        <span class="icon-star"></span>
        <span class="icon-star"></span>
        <h2>Algunas de nuestras marcas.</h2>
        <span class="icon-star"></span>
        <span class="icon-star"></span>
        <span class="icon-star"></span>
    </div>
    <ul>
        <li><img src="<?= URL ?>Recursos/img/caldas.png"></li>
        <li><img src="<?= URL ?>Recursos/img/guarocon.png"></li>
        <li><img src="<?= URL ?>Recursos/img/guaroSin.png"></li>
        <li><img src="<?= URL ?>Recursos/img/jose.png"></li>
        <li><img src="<?= URL ?>Recursos/img/olpark.png"></li>
        <li><img src="<?= URL ?>Recursos/img/ron.png"></li>
        <li><img src="<?= URL ?>Recursos/img/ron8.png"></li>
    </ul>
</section>

<section>
    <div class="container my-5">
        <div class="row" id="contenido-productos">
            
        </div>  
    </div>
</section>      

<?php 	require 'Vistas/Footer.php'; ?>
  

<script type="text/javascript">
	$(document).ready(function(){
		todosProductos('<?= URL ?>');
        nuevaVisita('<?= URL ?>');
	});
</script>
