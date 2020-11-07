<?php 



	/**
	 * 
	 */
	class Controlador
	{
		
		function __construct()
		{
			$this->view=new vistas;
		}


		function cargarModelo($modelo){
			if (file_exists('Modelos/'.$modelo.'Model.php')){
				require_once 'Modelos/'.$modelo.'Model.php';
				$modelo=$modelo.'Model';
				$this->model=new $modelo;
			}else{
				echo $modelo;
			}
		}	
	}

 ?>