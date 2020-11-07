<?php 


	class CategoriaModel extends Modelo
	{
		
		function __construct()
		{
			parent::__construct();
		}


		function categorias(){
			$sql=mysqli_query($this->connec,"SELECT * FROM tbl_categoria ");
			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}


		function insert($categoria){
			$sql=mysqli_query($this->connec,"INSERT INTO  tbl_categoria VALUES ('','$categoria')");
			if ($sql){
				return true;
			}else{
				return false;
			}	
		}


		function delete($id){
			$sql=mysqli_query($this->connec,"DELETE FROM tbl_categoria WHERE codigo='$id'");
			if ($sql){
				return true;
			}else{
				return	false;
			}
		}


		function aumento($aumento){
			$sql=mysqli_query($this->connec,"INSERT INTO  tbl_aumento VALUES('','$aumento')");
			if ($sql){
				return true;
			}else{
				return	false;
			}
		}

		function aumentos(){
			$sql=mysqli_query($this->connec,"SELECT * FROM tbl_aumento ");
			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}
		}

		function deleteAumento($id){
			$sql=mysqli_query($this->connec,"DELETE FROM tbl_aumento WHERE id='$id'");
			if ($sql){
				return true;
			}else{
				return	false;
			}
		}

	}

