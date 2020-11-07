<?php 


	class ProductosModel extends Modelo
	{
		
		function __construct()
		{
			parent::__construct();
		}


		function todosProductos(){
			$sql=mysqli_query($this->connec,"SELECT pro.codigo,pro.producto,pro.cantidad,pro.Valor_unidad,										pro.Valor_venta,ca.nombre,pro.Descripcion,pro.imagen
												FROM `tbl_productos` as pro INNER join tbl_categoria as ca
														on pro.cod_categoria=ca.codigo");
			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}

		function productoXcategoria($categoria){
			$sql=mysqli_query($this->connec,"SELECT * from tbl_productos where cod_categoria='$categoria'");
			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	
		}


		function insert($datos){
							$nombre=$datos['nombre'];
						    $V_venta=$datos['V_venta'];
						    $categoria=$datos['categoria'];
						    $descripcion=$datos['descripcion'];
						    $imagen=$datos['imagen'];

			$sql=mysqli_query($this->connec,"INSERT INTO tbl_productos VALUES ('','$nombre','0','0','$V_venta','$categoria','$descripcion','$imagen')");
			if ($sql){
				return true;
			}else{
				return fale;
			}	
		}


		function delete($id){
			$sql=mysqli_query($this->connec,"DELETE FROM tbl_productos where codigo='$id'");
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	

		}

		function selectProducto($id){
			$sql=mysqli_query($this->connec,"SELECT * FROM tbl_productos where codigo='$id'");
			$sql=mysqli_fetch_array($sql);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}	

		}


		function updateProducto($datos){
			$sql=mysqli_query($this->connec,"UPDATE tbl_productos 
											  	SET producto='$datos[1]' , 
											  		cantidad='$datos[2]' , 
											  		Valor_unidad ='$datos[3]' , 
											  		Valor_venta='$datos[4]' , 
											  		cod_categoria='$datos[5]' , 
											  		Descripcion='$datos[6]' , 
											  		imagen='$datos[7]'  

											  WHERE codigo='$datos[0]'");
			if ($sql){
				return true;
			}else{
				return false;
			}	

		}

		function selectProductoLike($dato){
			$sql=mysqli_query($this->connec,"SELECT pro.codigo,pro.producto,pro.cantidad,pro.Valor_unidad,														pro.Valor_venta,ca.nombre,pro.Descripcion,pro.imagen

											FROM `tbl_productos` as pro INNER join tbl_categoria as ca
														on pro.cod_categoria=ca.codigo 
														
											 where pro.codigo like '%$dato%' or pro.producto like '%$dato%'");
			$sql=mysqli_fetch_all($sql,MYSQLI_ASSOC);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}
		}


		function totalInventario(){
			$sql=mysqli_query($this->connec,"SELECT SUM(cantidad*Valor_unidad) as 'Total_inventario' FROM `tbl_productos");
			$sql=mysqli_fetch_array($sql);
			if ($sql){
				return $sql;
			}else{
				return $sql;
			}
		}

	}
