<?php 
	
	session_start();
	class CategoriaController  extends Controlador
	{

			function __construct(){
				parent::__construct();
			}
		
			function index(){
				if (isset($_SESSION['user'])){

					$this->view->titulo="Categorias";
					$this->view->cargarvista('Home/Categoria');
				}else{
					$this->view->titulo="ERROR";
					$this->view->cargarvista('Error/index');
				}
			}
			function todosCategoria(){
				parent::cargarModelo('Categoria');
				$categorias=$this->model->categorias();

				$tabla='<table id="tablacategoria" class="table table-hover table-condensed table-bordered" 		style="text-align:center;">
         					<tr style="font-weight:bold;">
           						<td>Categoria</td>
           						<td>Eliminar</td>
         					</tr>';

         		$tbody='';

         		foreach ($categorias as $value) {
         			$tbody.='<tr>
          						<td>'.$value['nombre'].'</td>
        
            					<td>
            						<a class="btn btn-danger" href="'.URL.'Categoria/delete/'.$value['codigo'].'">
             					 		<span class="icon-trash"></span>
            						</a>
           						</td>
       						</tr>';
         		}

         		echo $tabla.$tbody.'</table>';

			}


			function insert(){
				$dato=[];
				parse_str($_POST['datos'],$dato);
				parent::cargarModelo('Categoria');
				$result=$this->model->insert($dato['categoria']);

				echo $result;
			}


			function delete($id){
				parent::cargarModelo('Categoria');

				$result=$this->model->delete($id[0]);
				header('location:'.URL.'Categoria');
				
			}


			function aumento(){
				$dato=[];
				parse_str($_POST['datos'],$dato);
				parent::cargarModelo('Categoria');
				$result=$this->model->aumento($dato['aumento']);

				echo $result;
			}

			function todosAumento(){
				parent::cargarModelo('Categoria');
				$aumento=$this->model->aumentos();

				$tabla='<table id="tablacategoria" class="table table-hover table-condensed table-bordered" 		style="text-align:center;">
         					<tr style="font-weight:bold;">
           						<td>Aumento</td>
           						<td>Eliminar</td>
         					</tr>';

         		$tbody='';

         		foreach ($aumento as $value) {
         			$tbody.='<tr>
          						<td> $ '.number_format($value['cantidad'],0).'</td>
        
            					<td>
            						<a class="btn btn-danger" href="'.URL.'Categoria/deleteAumento/'.$value['id'].'">
             					 		<span class="icon-trash"></span>
            						</a>
           						</td>
       						</tr>';
         		}

         		echo $tabla.$tbody.'</table>';
			}

			function deleteAumento($id){
				parent::cargarModelo('Categoria');

				$result=$this->model->deleteAumento($id[0]);
				header('location:'.URL.'Categoria');
			}
	}