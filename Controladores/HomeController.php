<?php 
	
	session_start();

	/**
	 * 
	 */
	class HomeController extends Controlador
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){
			if (isset($_SESSION['user'])){
				parent::__construct();
				$this->view->titulo="Home";
				$this->view->cargarvista('Home/index');
			}else{
				$this->view->titulo="ERROR";
				$this->view->cargarvista('Error/index');
			}
		}

		function totalInventario(){
			parent::cargarModelo('Productos');
			$resul=$this->model->totalInventario();
			echo "$ ".number_format($resul['Total_inventario'],0);
		}

		function gananciaMenual(){
			parent::cargarModelo('Ventas');
			$resul=$this->model->gananciaMenual();
			echo "$ ".number_format($resul['ganancias'],0);
		}

	}