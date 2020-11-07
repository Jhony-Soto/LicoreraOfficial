<?php 
	
	session_start();
	class VentasController extends Controlador
	{

		function __construct()
		{
			parent::__construct();
		}

		function index(){
			if (isset($_SESSION['user'])){

				parent::cargarModelo('Productos');
				$this->view->productos=$this->model->todosProductos();


				$this->view->titulo="Ventas";
				$this->view->cargarvista('Ventas/index');
			}else{
				$this->view->titulo="ERROR";
				$this->view->cargarvista('Error/index');
			}
			
		}


		function consultarProducto(){
			parent::cargarModelo('Productos');
			$resul=$this->model->selectProducto($_POST['opcion']);

			if ($resul['cantidad']<>1 && $resul['cantidad']<>0 ) {
				echo ($resul['Valor_venta']);
			}else{
				echo $resul['cantidad'];
			}

		}


		function tablaTemp(){
			$arreglo=[];

			parse_str($_POST['datos'],$arreglo);

			parent::cargarModelo('Productos');
			$productos=$this->model->selectProducto($arreglo['producto']);


			$_SESSION['tablaTempventa'][].='<tr>
												<td>'.$productos['codigo'].'</td>
												<td>'.$productos['producto'].'-'.$productos['Descripcion'].'</td>
												<td>'.$arreglo['cantidad'].'</td>
												<td>'.'$ '.number_format($arreglo['valor_unidad'],0).'</td>
												<td>$ '.number_format($arreglo['cantidad'] * $arreglo['valor_unidad'],0).'</td>
									      </tr>';

						

			$articulo=$productos['codigo'].'|'.
					  $arreglo['cantidad'].'|'.
					  $arreglo['valor_unidad'].'|'.
					  $productos['Valor_unidad'];


			$_SESSION['totalventa']=$_SESSION['totalventa']+($arreglo['cantidad']*$arreglo['valor_unidad']);

			$_SESSION['BDtablaventa'][]=$articulo;
			

			self::cargarTabla();
			
		}



		function cargarTabla(){
			$tabla='<table class="table my-5" id="tablaventa">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Producto</th>
					      <th scope="col">Cantidad</th>
					      <th scope="col">Valor Unidad</th>
					      <th scope="col">Subtotal</th>
					    </tr>
					  </thead>
					 <tbody>';


			$fila='';
			if (isset($_SESSION['tablaTempventa'])){
					for ($i=0;$i < count($_SESSION['tablaTempventa']); $i++) { 

						$fila.=$_SESSION['tablaTempventa'][$i];
		
					}

					$fila.=' <tr style="text-align:right;font-weight: bold;">
								 <td colspan="4">total</td>
								 <td class="bg-primary">$'.number_format($_SESSION['totalventa'],0).'</td>
							</tr>';
				}

				 echo  $tabla.$fila.' </tbody></table>';
		}


		function limpiarTabla(){
			$_SESSION['tablaTempventa']=null;
			$_SESSION['BDtablaventa']=null;
			$_SESSION['totalventa']=null;
			self::cargarTabla();
		}


		function generarVenta(){


			parent::cargarModelo('Ventas');
			$resul=$this->model->crearVenta();
			if($resul==1){

				$venta=$this->model->ultimaVenta(); 

				for ($i=0; $i < count($_SESSION['BDtablaventa']) ; $i++) {
					$fila=explode('|',$_SESSION['BDtablaventa'][$i]);
					
					parent::cargarModelo('Ventas');
					$resul=$this->model->crearVentaProducto($fila,$venta);
					
					// SI LA COMPRA SE HIZO CON EXITO VAMOS A ACTALIZAR LA TABLA PRODUCTOS
					if($resul==1){

						parent::cargarModelo('Productos');
						$producto=$this->model->selectProducto($fila[0]);

						// REALIAZAMOS EL PROMEDIO PONDERADO
						$existencia=$producto['cantidad']-$fila[1];
						$inventario=($producto['cantidad'] * $producto['Valor_unidad']) - ($fila[1] * $producto['Valor_unidad']);
						$v_unidad=$inventario/$existencia;

						$datos=[$fila[0],
								$producto['producto'],
								$existencia,
								$v_unidad,
								$producto['Valor_venta'],
								$producto['cod_categoria'],
								$producto['Descripcion'],
								$producto['imagen']
							];

						$resul=$this->model->updateProducto($datos);
						echo $resul;
					}
				}

			}
		}


		function ventasHechas(){
			parent::cargarModelo('Ventas');
			$this->view->reporteVentas=$this->model->reporteVentas();

			$this->view->titulo="Ventas Hechas";
			$this->view->cargarvista('Ventas/VentasHechas');
		}


		function ventasFiltrada(){
			$datos=[];
			parse_str($_POST['datos'],$datos);

			if ($datos['fechafinal']<$datos['fechainicial']){

				echo '<div class="alert alert-danger" role="alert"><p>La fecha inicial no debe ser mayor a la fecha final !!</p></div>';
			}else{

				parent::cargarModelo('Ventas');
				$resul=$this->model->reporteVentas($datos);

					$tabla='<p class="mt-5"><strong>En la tabla vemos el total de Ventas que se 
                 					 han hecho entre '.$datos['fechainicial'].' y  el dia '.$datos['fechafinal'].'.</strong></p>
					<table class="table table-hover table-condensed table-bordered table-responsive" style="text-align:center;">
	         		<tr style="font-weight:bold;" class="bg-light">
	           		<td>FECHA</TD>
	           		<td>TOTAL EN VENTAS</td>
	           		<td>NUMERO DE PRODUCTOS VENDIDOS</td>
	           		<td>TOTAL DE GANANCIAS</td>
	           		<td>VER DETALLE</td>		
	         	</tr>';

	         	$total=0;
	         	$body='';

	         	foreach ($resul as $value) {
	         		$body.='<tr class="bg-light">
	         					<td>'.$value['fecha'].'</td>
        						<td>$ '.number_format($value['Total_de_ventas'],0).'</td>
        						<td>'.$value['Numero_de_ventas'].'</td>
        						<td>$ '.number_format($value['Total_de_ganancias'],0).'</td>
        						<td>
        							<button class="btn btn-warning" onclick="detalleVenta('.$value['id'].')"><span class="icon-eye"></span></button>
        						</td>
        					</tr>';
        					$total=$total+$value['Total_de_ganancias'];
	         	}	
	         	$body.=' <tr style="font-weight:bold;">
            				<td colspan="3" >total</td>
           					<td>$'. number_format($total,0).'</td>
          				</tr>';


	         	echo $tabla.$body.'</table>';

			}
		}


		function detalleVenta(){

			parent::cargarModelo('Ventas');
			$resp=$this->model->detalleVenta($_POST['id']);

			// var_dump( $resp);
			$tabla='<table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">PRODUCTO</th>
                      <th scope="col">CANTIDAD</th>
                      <th scope="col">VALOR COMPRADO</th>
                      <th scope="col">VALOR VENTA</th>
                      <th scope="col">SUBTOTAL</th>
                      <th scope="col">GANANCIA</th>
                    </tr>
                  </thead>
                  <tbody>';

                  $total=0;
                  $ganancias=0;
                  $body='';

                 foreach ($resp as  $value) {
                 	$body.=' <tr>
			                      <th scope="row">'.$value['producto'].'</th>
			                      <td>'.$value['cantidad'].'</td>
			                      <td>$ '.number_format($value['valor_compra'],0).'</td>
			                      <td>$ '.number_format($value['valor_venta'],0).'</td>
			                      <td>$ '.number_format($value['Total'],0).'</td>
			                      <td>$ '.number_format($value['Ganancia'],0).'</td>
			                 </tr>';
			               	$total=$total+$value['Total'];
			               	$ganancias=$ganancias+$value['Ganancia'];
                 }

                 $body.='<tr style="font-weigth:bold;background:#ccc;">
			                      <th colspan="4" > TOTALES </th>
			                      <td class="bg-primary">$ '.number_format($total,0).'</td>
			                      <td class="bg-success">$ '.number_format($ganancias,0).'</td>
			             </tr>';


			echo $tabla.$body.'</tbody></table>';
		}
}