<?php 

	/**
	 * 
	 */
	class BD
	{
		private $conexion;	

		public function __construct()
		{
			$this->conexion=mysqli_connect(DB_HOST,BD_USER,DB_PASS,DB_NAME);
            $this->conexion->set_charset("utf8");
			if ($this->conexion){
         
				return $this->conexion;
			}else{
				echo "Error al conectarse a la BD";
				die();
			}
		}
	}



 ?>