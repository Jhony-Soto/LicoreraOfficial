<?php 

class VentasModel extends Modelo
	{
		
		function __construct()
		{
			date_default_timezone_set('America/Bogota');
			parent::__construct();
		}


		function crearVenta(){
			$fecha=date('yy-m-d h:i:s A');
			// return $fecha;
			$sql=mysqli_query($this->connec,"INSERT INTO tbl_venta VALUES ('','$fecha')");
			if ($sql){
				return true;
			}else{
				return false;
			}	
		}


		function crearVentaProducto($datos,$venta){
			$id_pro=$datos[0];
			$cantidad=$datos[1];
			$valor=$datos[2];
			$valor_compra=$datos[3];
			// var_dump ($datos);
			$sql=mysqli_query($this->connec,"INSERT INTO tbl_venta_producto VALUES ('','$venta[0]','$id_pro','$cantidad','$valor','$valor_compra')"  );
			if ($sql){
				return true;
			}else{
				return false;
			}	
		}


		function ultimaVenta(){
			$sql=mysqli_query($this->connec,"SELECT  * FROM `tbl_venta`ORDER BY id  DESC LIMIT 1"  );
			$sql=mysqli_fetch_array($sql);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}




		function reporteVentas($datos=null){
			$fecha=date('Y-m-d');

			if (isset($datos)){
				$sql=mysqli_query($this->connec,"SELECT ve.id,ve.fecha, SUM(vp.cantidad) as 'Numero_de_ventas',
													 	sum(vp.cantidad*vp.valor_venta) as 'Total_de_ventas',
														 sum((vp.valor_venta-vp.valor_compra)*vp.cantidad) as 'Total_de_ganancias'
												        
												FROM tbl_venta as ve inner join tbl_venta_producto as vp
													on ve.id=vp.id_venta
												    
												    
												  where cast(ve.fecha as date)>='".$datos['fechainicial']."' and cast(ve.fecha as date)<='".$datos['fechafinal']."'
												    
												GROUP by ve.id");

			}else{
			$sql=mysqli_query($this->connec,"SELECT ve.id,ve.fecha, SUM(vp.cantidad) as 'Numero_de_ventas',

													sum(vp.cantidad*vp.valor_venta) as 'Total_de_ventas',
											        
													 sum((vp.valor_venta-vp.valor_compra)*vp.cantidad) as 'Total_de_ganancias'
																						        
											FROM tbl_venta as ve inner join tbl_venta_producto as vp
												on ve.id=vp.id_venta

											 where cast(ve.fecha as date)='$fecha'
																						    
											GROUP by ve.id");
			}		

			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}


		function gananciaMenual(){
			$fecha=date('Y-m-d');
			$fecha_final=date('Y-m-d',strtotime($fecha.'- 1 month'));
			// echo $fecha_final;
			$sql=mysqli_query($this->connec,"SELECT SUM((vp.valor_venta - vp.valor_compra)* vp.cantidad) as 'ganancias'

											FROM `tbl_venta_producto` as vp INNER join tbl_venta as ven
													on vp.id_venta=ven.id
											        
											      INNER JOIN tbl_productos as prod
											      on vp.id_producto=prod.codigo
											      
											WHERE cast(ven.fecha as date)>='$fecha_final' and cast(ven.fecha as date)<='$fecha'
											");
			$sql=mysqli_fetch_array($sql);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}
		}


		function detalleVenta($id){
			$sql=mysqli_query($this->connec,"SELECT prod.producto,vp.cantidad,vp.valor_compra,vp.valor_venta,
														sum(vp.cantidad * vp.valor_venta) as 'Total',
												        sum((vp.valor_venta - vp.valor_compra)* vp.cantidad) as 'Ganancia'
												FROM `tbl_venta` as ven INNER JOIN tbl_venta_producto as vp
														on ven.id=vp.id_venta
												        
												      INNER JOIN tbl_productos	as prod
												      on prod.codigo=vp.id_producto
												      
												where ven.id='$id'
												      
												GROUP by vp.id");
			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}
		}
}