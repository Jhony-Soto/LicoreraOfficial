<?php require_once 'Vistas/Encabezado.php' ?>

	<section class="section-login">
			<div class="login">
				<form id="formulario" onsubmit="login('<?= URL ?>'); return false" autocomplete="off">
                  <label for="inputEmail" class="sr-only">Email </label>
                  <input type="text" name="usuario" class="form-control" placeholder="Perfil" required autofocus><br>

                  <label for="inputPassword" class="sr-only">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required><br>

                  <button class="btn btn-lg btn-primary" type="submit">Ingresar</button>
            	</form>
			</div>
	</section>
	
<?php require_once 'Vistas/Footer.php' ?>
