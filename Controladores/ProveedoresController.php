<?php 

	session_start();
	class ProveedoresController extends Controlador
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){
			if(isset($_SESSION['user'])){
				$this->view->titulo="Proveedores";
				$this->view->cargarVista('Proveedores/index');
			}else{
				$this->view->titulo="ERROR";
				$this->view->cargarvista('Error/index');
			}
			
		}


		function setProveedores(){
			parent::cargarModelo('Proveedor');
				$Proveedor=$this->model->todosProveedores();

				$tabla='<table class="table table-hover table-condensed table-bordered table-responsive" style="text-align:center;">
         					<tr style="font-weight:bold;" class="bg-light">
           						 <td>Nombre</td>
       							<td>Editar</td>
           						<td>Eliminar</td>
         					</tr>';

         		$tbody='';


         		foreach ($Proveedor as $value) {
         			$tbody.='<tr>
        						<td>'. $value['proveedor'].'</td>
        					
								<td>
            						<a href="'.URL.'Proveedores/editar/'.$value['id'].'"><span class="btn btn-warning btn-sm">
            						<span class="icon-pencil"></span>
          							</span></a>
        						 </td>

         						<td>
            						<a href="'.URL.'Proveedores/eliminar/'.$value['id'].'"><span class="btn btn-danger btn-sm">
            						<span class="icon-trash"></span>
          							</span></a>
        						 </td>
      						</tr>';
         		}

         		echo $tabla.$tbody.'</table>';
		}



		function insert(){
			$proveedor=[];
			parse_str($_POST['datos'],$proveedor);

			parent::cargarModelo('Proveedor');
			$resul=$this->model->insert($proveedor['proveedor']);
			echo $resul;
		}


		function editar($id){

				parent::cargarModelo('Proveedor');
				$this->view->proveedor=$this->model->selectProveedor($id[0]);

				$this->view->titulo="Editar";
				$this->view->cargarVista('Proveedores/editar');
		}


		function actualizar(){
			$proveedor=[];
			parse_str($_POST['datos'],$proveedor);

			// print_r($proveedor);

			parent::cargarModelo('Proveedor');
			$resul=$this->model->updateProveedor($proveedor);
			echo $resul;
		}


		function eliminar($id){
				parent::cargarModelo('Proveedor');
				$resul=$this->model->delete($id[0]);

				self::index();
		}
	}