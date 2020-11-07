<?php 

	/**
	 * 
	 */
	class AdminModel extends Modelo
	{
		
		function __construct()
		{
			parent::__construct();
		}


		function consultar($datos){

			$user=$datos['usuario'];
			$pass=$datos['password'];

			$sql=mysqli_query($this->connec,"SELECT * FROM tbl_admin WHERE documento='$user' and contrasenia='$pass'");
			$_SESSION['user']=mysqli_fetch_array($sql);
			$sql=mysqli_num_rows($sql);
			if ($sql){
				return true;
			}else{
				return false;
			}
			
		}

	}



 ?>