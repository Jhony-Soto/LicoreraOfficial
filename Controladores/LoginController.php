<?php 

	session_start();

	class LoginController  extends Controlador
	{

			function __construct(){
				parent::__construct();
			}
		
			function index(){
				if (empty($_SESSION['user'])) {
					$this->view->titulo="Login";
					$this->view->cargarvista('Login/index');
				}else{
					header('location:'.URL.'Home');
				}
			}


			function validarLogin(){
				$arreglo=[];
				parse_str($_POST['datos'],$arreglo);

				parent::cargarModelo('Admin');
				$result=$this->model->consultar($arreglo);

				echo $result;
			}

			function closeSesion(){
				session_destroy();
				header('location:'.URL);
			}
	}