<?php 

	/**
	 * 
	 */
	class ErroresController extends Controlador
	{
		
		function __construct()
		{
			parent::__construct();
			$this->view->titulo="ERROR";
			$this->view->cargarVista('Error/index');
		}
	}



 ?>