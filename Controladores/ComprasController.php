<?php 
	
	session_start();
	class ComprasController extends Controlador
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){
			

				parent::cargarModelo('Productos');
				$this->view->productos=$this->model->todosProductos();

				parent::cargarModelo('Proveedor');
				$this->view->proveedor=$this->model->todosProveedores();


				$this->view->titulo="Compra";
				$this->view->cargarvista('Compra/index');
			
			
		}

		function consultarProducto(){
			parent::cargarModelo('Productos');
			$resul=$this->model->selectProducto($_POST['opcion']);

			echo ($resul['Valor_unidad']);
		}

		function tablaTemp(){
			$arreglo=[];

			parse_str($_POST['datos'],$arreglo);

			parent::cargarModelo('Productos');
			$productos=$this->model->selectProducto($arreglo['producto']);


			$_SESSION['tablaTemp'][].='<tr><td>'.$productos['codigo'].'</td><td>'
									.$productos['producto'].'-'.$productos['Descripcion'].'</td><td>'
									.$arreglo['cantidad'].'</td><td>'
									.'$ '.number_format($arreglo['valor_unidad'],0).'</td><td>'.
									'$ '.number_format($arreglo['cantidad'] * $arreglo['valor_unidad'],0).'</td></tr>';



			$articulo=$productos['codigo'].'|'.
					  $arreglo['cantidad'].'|'.
					  $arreglo['valor_unidad'];

			$_SESSION['total']=$_SESSION['total']+($arreglo['cantidad']*$arreglo['valor_unidad']);

			$_SESSION['BDtabla'][]=$articulo;
			

			self::cargarTabla();
			
		}



		function cargarTabla(){
			$tabla='<table class="table my-5">
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
			if (isset($_SESSION['tablaTemp'])){
					for ($i=0;$i < count($_SESSION['tablaTemp']); $i++) { 

					$fila.=$_SESSION['tablaTemp'][$i];
		
					}

					$fila.=' <tr style="text-align:right;font-weight: bold;">
								 <td colspan="4">total</td>
								 <td class="bg-primary">$'.number_format($_SESSION['total'],0).'</td>
							</tr>';
				}

				 echo  $tabla.$fila.' </tbody></table>';
		}


		function limpiarTabla(){
			$_SESSION['tablaTemp']=null;
			$_SESSION['BDtabla']=null;
			$_SESSION['total']=null;
			self::cargarTabla();
		}


		function generarCompra(){
			$proveedor=[];
			parse_str($_POST['datos'],$proveedor);

			parent::cargarModelo('Compras');
			$resul=$this->model->crearCompra($proveedor['proveedor']);
			if($resul==1){

				$compra=$this->model->ultimaCompra(); 

				for ($i=0; $i < count($_SESSION['BDtabla']) ; $i++) {
					$fila=explode('|',$_SESSION['BDtabla'][$i]);
					
					parent::cargarModelo('Compras');
					$resul=$this->model->crearCompraProducto($fila,$compra);
					
					// SI LA COMPRA SE HIZO CON EXITO VAMOS A ACTALIZAR LA TABLA PRODUCTOS
					if($resul==1){

						parent::cargarModelo('Productos');
						$producto=$this->model->selectProducto($fila[0]);

						// REALIAZAMOS EL PROMEDIO PONDERADO
						$existencia=$producto['cantidad']+$fila[1];
						$inventario=($producto['cantidad'] * $producto['Valor_unidad']) + ($fila[1] * $fila[2]);
						$v_unidad=$inventario/$existencia;

						$datos=[$fila[0],$producto['producto'],
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


		function comprasHechas(){
			parent::cargarModelo('Compras');
			$this->view->reporteCompras=$this->model->reporteCompras();

			$this->view->titulo="Compras Hechas";
			$this->view->cargarvista('Compra/comprasHechas');
		}


		function comprasFiltrada(){
			$datos=[];
			parse_str($_POST['datos'],$datos);

			if ($datos['fechafinal']<$datos['fechainicial']){

				echo '<div class="alert alert-danger" role="alert"><p>La fecha inicial no debe ser mayor a la fecha final !!</p></div>';
			}else{

				parent::cargarModelo('Compras');
				$resul=$this->model->reporteCompras($datos);

					$tabla='<p class="mt-5"><strong>En la tabla vemos el total de compras que se 
                  							hicieron entre '.$datos['fechafinal'].' y '.$datos['fechainicial'].' por cada proveedor.</strong></p>
					<table class="table table-hover table-condensed table-bordered table-responsive" style="text-align:center;">
	         		<tr style="font-weight:bold;" class="bg-light">
	           		<td>PROVEEDOR</td>
	           		<td>TOTAL EN COMPRAS</td>
	           		<td>NUMERO DE COMPRAS</td>			
	         	</tr>';


	         	$body='';

	         	foreach ($resul as $value) {
	         		$body.='<tr class="bg-light">
        						<td>'.$value['proveedor'].'</td>
        						<td>$ '.number_format($value['Total_de_compras'],0).'</td>
        						<td>'.$value['Numero_de_compras'].'</td>
        					</tr>';
	         	}


	         	echo $tabla.$body.'</table>';

			}
		}
}