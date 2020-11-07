<?php 

class ComprasModel extends Modelo
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


		function crearCompra($proveedor){
			$fecha=date('yy-m-d');
			// return $fecha;
			$sql=mysqli_query($this->connec,"INSERT INTO tbl_compra VALUES ('','$fecha','$proveedor')"  );
			if ($sql){
				return true;
			}else{
				return false;
			}	
		}


		function crearCompraProducto($datos,$compra){
			$id_pro=$datos[0];
			$cantidad=$datos[1];
			$valor=$datos[2];
			// var_dump ($datos);
			$sql=mysqli_query($this->connec,"INSERT INTO tbl_compra_producto VALUES ('','$compra[0]','$id_pro','$cantidad','$valor')"  );
			if ($sql){
				return true;
			}else{
				return false;
			}	
		}


		function ultimaCompra(){
			$sql=mysqli_query($this->connec,"SELECT  * FROM `tbl_compra`ORDER BY id  DESC LIMIT 1"  );
			$sql=mysqli_fetch_array($sql);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}




		function reporteCompras($datos=null){

			if (isset($datos)){


				$sql=mysqli_query($this->connec,"SELECT com.id,prove.proveedor,
													sum(compro.cantidad*compro.valor_unidad) as 'Total_de_compras',
													count(com.id) as 'Numero_de_compras'
											from tbl_compra as com inner join tbl_compra_producto as compro
													on com.id=compro.id_compra
											      
											      inner join tbl_proveedor as prove
											      on com.proveedor=prove.id

											      where com.fecha>='".$datos['fechainicial']."' and com.fecha<='".$datos['fechafinal']."'

											GROUP by prove.proveedor");

			}else{
			$sql=mysqli_query($this->connec,"SELECT com.id,prove.proveedor,
													sum(compro.cantidad*compro.valor_unidad) as 'Total_de_compras',
													count(com.id) as 'Numero_de_compras'
											from tbl_compra as com inner join tbl_compra_producto as compro
													on com.id=compro.id_compra
											      
											      inner join tbl_proveedor as prove
											      on com.proveedor=prove.id
											      
											GROUP by prove.proveedor");
			}		

			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}
}