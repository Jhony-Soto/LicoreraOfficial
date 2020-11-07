<?php 

class ProveedorModel extends Modelo
{
		
		function __construct()
		{
			parent::__construct();
		}


		function todosProveedores(){
			$sql=mysqli_query($this->connec,"SELECT *
											 FROM `tbl_proveedor");
			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}


		function insert($datos){
	
			$sql=mysqli_query($this->connec,"INSERT INTO tbl_proveedor VALUES ('','$datos')");
			if ($sql){
				return true;
			}else{
				return fale;
			}	
		}


		function delete($id){
			$sql=mysqli_query($this->connec,"DELETE FROM tbl_proveedor where id='$id'");
			if ($sql){
				return true;
			}else{
				return false;
			}	

		}

		function selectProveedor($id){
			$sql=mysqli_query($this->connec,"SELECT * FROM tbl_proveedor where id='$id'");
			$sql=mysqli_fetch_array($sql);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	

		}


		function updateProveedor($datos){
			$id=$datos['id'];
			$nombre=$datos['proveedor'];

			$sql=mysqli_query($this->connec,"UPDATE  tbl_proveedor
											 SET proveedor='$nombre'
											 WHERE id='$id'");
			if ($sql){
				return true;
			}else{
				return fale;
			}	

		}

	}
