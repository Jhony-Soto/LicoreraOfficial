<?php 
	
	session_start();
	class ProductoController  extends Controlador
	{

			function __construct(){
				parent::__construct();
			}
		
			function index(){
				// if (isset($_SESSION['user'])){

					parent::cargarModelo('Categoria');

					$this->view->categorias=$this->model->categorias();
					$this->view->titulo="Productos";
					$this->view->cargarvista('Productos/index');
				// }else{
				// 	$this->view->titulo="ERROR";
				// 	$this->view->cargarvista('Error/index');
				// }
			}

			function todosProductos(){
				parent::cargarModelo('Productos');
				$productos=$this->model->todosProductos();

				$tabla='<table id="tablaProductos" class="table table-hover table-condensed table-bordered table-responsive" style="text-align:center;">
						<thead>
         					<tr style="font-weight:bold;" class="bg-light">
           						 <td>Nombre</td>
           						<td>Cantidad</td>
          						 <td>Valor unidad</td>
          						 <td>Valor venta</td>
          						 <td>Categoria</td>
           						<td>Descripcion</td>
           						<td>Imagen</td>
           						<td>Inventario</td>
           						<td>Ganancia X unidad</td>
           						<td>Margen de ganancias</td>
       							<td>Editar</td>
           						<td>Eliminar</td>
         					</tr>
         				</thead>
         				<tbody>';

         		$tbody='';


         		foreach ($productos as $value) {
         			$tbody.='<tr>
        						<td>'. $value['producto'].'</td>
        						<td>'. $value['cantidad'].'</td>
        						<td>'. number_format($value['Valor_unidad'],0).'</td>
        						<td>'. number_format($value['Valor_venta'],0).'</td>
        						<td>'. $value['nombre'].'</td>
        						<td>'. $value['Descripcion'].'</td>
        						<td><img src="'.URL. $value['imagen'].'" style="with:100px;height:100px;">
        						</td>
								<td class="bg-success">'.number_format($value['cantidad'] * $value['Valor_unidad'],0).'</td>

								<td class="bg-light">'.number_format($value['Valor_venta'] - $value['Valor_unidad'],0).'</td>
								<td class="bg-warning">'.number_format(($value['Valor_venta'] - $value['Valor_unidad'])*$value['cantidad'],0).'</td>
								<td>
            						<a href="'.URL.'Producto/editar/'.$value['codigo'].'"><span class="btn btn-warning btn-sm">
            						<span class="icon-pencil"></span>
          							</span></a>
        						 </td>

         						<td>
            						<a href="'.URL.'Producto/deleteImg/'.$value['imagen'].'/'.$value['codigo'].'"><span class="btn btn-danger btn-sm">
            						<span class="icon-trash"></span>
          							</span></a>
        						 </td>
      						</tr>';
         		}

         		echo $tabla.$tbody.'</tbody></table>';

			}


			function insert(){
				$foto=$_FILES['imagen']['name'];
				$ruta=$_FILES['imagen']['tmp_name'];
				$destino='Recursos/img/'.$foto;
				copy($ruta, $destino);	

				$datos=array(
							"nombre"=>$_POST['producto'],
						    "V_venta"=>$_POST['V_venta'],
						    "categoria"=>$_POST['categoria'],
						    "descripcion"=>$_POST['descripcion'],
						    "imagen"=>$destino
						);
						
		
				parent::cargarModelo('Productos');
				$result=$this->model->insert($datos);

				header('location:'.URL.'Producto');
			}


			function deleteImg($id){

				$ruta=$id[0]."/".$id[1]."/".$id[2];

				if (file_exists($ruta)){
					unlink($ruta);
				}
				
				parent::cargarModelo('Productos');

				$result=$this->model->delete($id[3]);

				header('location:'.URL.'Producto');
				
			}


			function editar($id){

				parent::cargarModelo('Categoria');
				$this->view->categorias=$this->model->categorias();

				parent::cargarModelo('Productos');
				$this->view->producto=$this->model->selectProducto($id[0]);

				$this->view->titulo="Productos";
				$this->view->cargarvista('Productos/editar');
			}

			function actualizar(){
				// echo "hola";
				$foto=$_FILES['imagen']['name'];
				$ruta=$_FILES['imagen']['tmp_name'];
				$destino='Recursos/img/'.$foto;
				copy($ruta, $destino);	

				$datos=[$_POST['codigo'],
					    $_POST['producto'],
						$_POST['cantidad'],
						$_POST['v_unidad'],
						$_POST['V_venta'],
						$_POST['categoria'],
						$_POST['descripcion'],
						$destino
						];
						
		
				parent::cargarModelo('Productos');
				$result=$this->model->updateProducto($datos);

				header('location:'.URL.'Producto');
			}


			function consultar(){
				parent::cargarModelo('Productos');
				$producto=$this->model->selectProductoLike($_POST['input']);

				$tabla='<table id="tablaProductos" class="table table-hover table-condensed table-bordered table-responsive" style="text-align:center;">
						<thead>
         					<tr style="font-weight:bold;" class="bg-light">
           						 <td>Nombre</td>
           						<td>Cantidad</td>
          						 <td>Valor unidad</td>
          						 <td>Valor venta</td>
          						 <td>Categoria</td>
           						<td>Descripcion</td>
           						<td>Imagen</td>
           						<td>Inventario</td>
           						<td>Ganancia X unidad</td>
           						<td>Margen de ganancias</td>
       							<td>Editar</td>
           						<td>Eliminar</td>
         					</tr>
         				</thead>
         				<tbody>';

         		$tbody='';


         		foreach ($producto as $value) {
         			$tbody.='<tr>
        						<td>'. $value['producto'].'</td>
        						<td>'. $value['cantidad'].'</td>
        						<td>'. number_format($value['Valor_unidad'],0).'</td>
        						<td>'. number_format($value['Valor_venta'],0).'</td>
        						<td>'. $value['nombre'].'</td>
        						<td>'. $value['Descripcion'].'</td>
        						<td><img src="'.URL. $value['imagen'].'" style="with:100px;height:100px;">
        						</td>
								<td class="bg-success">'.number_format($value['cantidad'] * $value['Valor_unidad'],0).'</td>

								<td class="bg-light">'.number_format($value['Valor_venta'] - $value['Valor_unidad'],0).'</td>
								<td class="bg-warning">'.number_format(($value['Valor_venta'] - $value['Valor_unidad'])*$value['cantidad'],0).'</td>
								<td>
            						<a href="'.URL.'Producto/editar/'.$value['codigo'].'"><span class="btn btn-warning btn-sm">
            						<span class="icon-pencil"></span>
          							</span></a>
        						 </td>

         						<td>
            						<a href="'.URL.'Producto/deleteImg/'.$value['imagen'].'/'.$value['codigo'].'"><span class="btn btn-danger btn-sm">
            						<span class="icon-trash"></span>
          							</span></a>
        						 </td>
      						</tr>';
         		}

         		echo $tabla.$tbody.'</tbody></table>';
			}

			function consultaPorcliente(){
				parent::cargarModelo('Categoria');
				$aumento=$this->model->aumentos();
				

				$hora=date("H:i:s");
				$hora=explode(":", $hora);

				if ($hora[0]>=22 or $hora[0]=00){
					$aumento=$aumento[0]['cantidad'];
				}else{
					$aumento=0;
				}


				parent::cargarModelo('Productos');
				$producto=$this->model->selectProductoLike($_POST['input']);
				$cards='';
				if(empty($producto)){
					echo '<div class="alert alert-danger" role="alert">
  								¡ No  encontramos resultados para tu busqueda !
						  </div>';
				}else{
					
					

					foreach ($producto as $value) {
						$cards.='<div class="col-sm-4">
									<div class="card">
	  									<img class="card-img-top" src="'.URL.$value['imagen'].'">
	  									<div class="card-body">
	    									<h5 class="card-title">'.$value['nombre'].'</h5>
	    									<p class="card-text">'.$value['Descripcion'].'</p>
	    									<span class="btn btn-primary  form-control"><center>$ '.number_format($value['Valor_venta']+ $aumento,0).'</center></span>
	  									</div>
									</div>
								</div>';
					}
				};

				echo ($cards);
			}
	}