<?php 


	session_start();
	/**
	 * 
	 */
	class VisitasController extends Controlador
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){

			if (isset($_SESSION['user'])){

				parent::cargarModelo('Visitas');
				$this->view->total=$this->model->totalVisitas();
		
				$this->view->titulo='Visitas';
				$this->view->cargarVista('Visitas/index');
			}else{

					$this->view->titulo="ERROR";
					$this->view->cargarvista('Error/index');
				}
			
			
		}

		function consultar(){
			$arreglo=[];
			parse_str($_POST['datos'], $arreglo);

			parent::cargarModelo('Visitas');
			$resul=$this->model->consultarVisitas($arreglo);

			$mostra='<button class="btn btn-warning">'.$resul[0].'</button>';

			echo $mostra;
		}
	}

 ?>