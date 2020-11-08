<?php 
	
	date_default_timezone_set('America/Bogota');

	class MainController  extends Controlador
	{

			function __construct(){
				parent::__construct();
			}
		
			function index(){
				parent::cargarModelo('Categoria');
				$this->view->categorias=$this->model->categorias();;
				$this->view->titulo="Catalogo";
				$this->view->cargarvista('Main/index');
			}


			function todosProductos(){
				parent::cargarModelo('Categoria');
				$categorias=$this->model->categorias();
				

				parent::cargarModelo('Productos');

				$resul=$this->model->todosProductos();

				echo json_encode(['categorias'=>$categorias,'articulos'=>$resul]);
			}




			function consultarProductos(){

				parent::cargarModelo('Categoria');
				$aumento=$this->model->aumentos();
				

				$hora=date("H:i:s");
				$hora=explode(":", $hora);

				if ($hora[0]>=22 or $hora[0]=00){
					$aumento=$aumento[0]['cantidad'];
				}else{
					$aumento=0;
				}




				$categoria=$_POST['opcion'];

				parent::cargarModelo('Productos');

				$resul=$this->model->productoXcategoria($categoria);

				$cards='';

				foreach ($resul as $value) {
					$cards.='<div class="col-sm-4">
								<div class="card">
  									<img class="card-img-top" src="'.URL.$value['imagen'].'">
  									<div class="card-body">
    									<h5 class="card-title">'.$value['nombre'].'</h5>
    									<p class="card-text">'.$value['Descripcion'].'</p>
    									<span class="btn btn-primary form-control"><center> $'.number_format($value['Valor_venta']+ $aumento,0).'</center></span>
  									</div>
								</div>
							</div>';
				}

				echo ($cards);
			}



            
			function nuevaVisita(){
				parent::cargarModelo('Visitas');
				$this->model->nuevaVisita();
			}

	}

?>