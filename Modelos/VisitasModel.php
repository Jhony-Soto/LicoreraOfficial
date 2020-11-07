<?php 

	/**
	 * 
	 */
	class VisitasModel extends Modelo
	{
		
		function __construct()
		{
			parent::__construct();
		}


		function nuevaVisita(){
			date_default_timezone_set('America/Bogota');
			$fecha=date('yy-m-d h:i:s');
			$sql=mysqli_query($this->connec, "INSERT INTO tbl_visitas VALUES ('','$fecha')");
			if ($sql){
				return true;
			}else{
				return false;
			}
		}


		function totalVisitas(){
		
			$sql=mysqli_query($this->connec, "SELECT  COUNT(fecha) as 'Total Visitas' 
												FROM `tbl_visitas`");
			if ($sql){
				$sql=mysqli_fetch_array($sql);
				return $sql;
			}else{
				return false;
			}

		}



		function consultarVisitas($datos){
			$fecha_inicial=$datos['fecha_inicial'];
			$fecha_final=$datos['fecha_final'];

			$sql=mysqli_query($this->connec, "SELECT COUNT(fecha) as 'Total Visitas' FROM `tbl_visitas` where 									fecha>='$fecha_inicial' and fecha<='$fecha_final'");
			if ($sql){
				$sql=mysqli_fetch_array($sql);
				return $sql;
			}else{
				return false;
			}
		}

	}


 ?>