

function filtrarCompras(URL){
	var datos= $('#form_filtrar').serialize();

	$.ajax({
		type:"POST",
		url:URL+"Compras/comprasFiltrada",
		data:{datos},
		success:function(r){
			document.getElementById('contenido').innerHTML=r;
		}
	});
}


function tablaTemporal(direccion){
	var datos =$('#compra').serialize();

	$.ajax({
		type:"POST",
		url:direccion+"Compras/tablaTemp",
		cache:false,
		data:{datos},
		success:function(r){
			$("#compra")[0].reset();
			document.getElementById('tabla').innerHTML=r;
		}
	});
}

function cargarTablaTemp(direccion){
	$.ajax({
		type:"POST",
		url:direccion+"Compras/cargarTabla",
		cache:false,
		success:function(r){
			document.getElementById("tabla").innerHTML =r;
		}
	});
}

function limpiarTabla(direccion){

	$.ajax({
		type:"POST",
		url:direccion+"Compras/limpiarTabla",
		cache:false,
		success:function(r){
			document.getElementById("tabla").innerHTML =r;
		}
	});
}


function generarCompra(direccion){
	swal({
		  title: "Desea realizar la compra?",
		  text: "Si no esta segur@ por favor reviza de nuevo!",
		  icon: "warning",
		  buttons: true,
		  success: true,
	})
	.then((willDelete) => {
		  if (willDelete) {
		    var datos =$('#comprar').serialize();
				$.ajax({
					type:"POST",
					url:direccion+"Compras/generarCompra",
					cache:false,
					data:{datos},
					success:function(r){
						if(r=1){
							limpiarTabla(direccion);
							swal("La compra se realizo con exito","","success");
						}
					}
				});
		  }
	});

	
}


//*********** VENTASS ********************* 


function consultarProducto(opcion,URL,tipo){
	if(tipo=="venta"){
		$.ajax({
			type:"POST",
			url:URL+"Ventas/consultarProducto",
			data:{opcion},
			success:function(r){
				if(r==1 || r==0){
					swal("¡ NO HAY PRODUCTO !","No queda del producto elegido en el inventario ,por favor realiza la compra.","error");
					$('#venta')[0].reset();
				}else{
					document.getElementById('valor_venta').value=r;
				}
			}
		});
	}else{
		$.ajax({
			type:"POST",
			url:URL+"Compras/consultarProducto",
			data:{opcion},
			success:function(r){
				document.getElementById('valor_venta').value=r;
			}
		});
	}
	
}

function tablaTemporalventa(direccion){
	var datos =$('#venta').serialize();

		$.ajax({
			type:"POST",
			url:direccion+"Ventas/tablaTemp",
			cache:false,
			data:{datos},
			beforeSend:function(){
				$('agg_venta').attr("disabled");
			},
			success:function(r){
				$('agg_venta').removeAttr("disabled");
				$("#venta")[0].reset();
				document.getElementById('tablaventa').innerHTML=r;
			}
		});
}


function cargarTablaTempventa(direccion){
	$.ajax({
		type:"POST",
		url:direccion+"Ventas/cargarTabla",
		cache:false,
		success:function(r){
			document.getElementById("tablaventa").innerHTML =r;
		}
	});
}

function limpiarTablaventas(direccion){

	$.ajax({
		type:"POST",
		url:direccion+"Ventas/limpiarTabla",
		cache:false,
		success:function(r){
			document.getElementById("tablaventa").innerHTML =r;
		}
	});
}


function generarVenta(direccion){

	var filas=$("#tablaventa tr").length;

	if(filas>1){
		$.ajax({
			type:"POST",
			url:direccion+"Ventas/generarVenta",
			cache:false,
			success:function(r){
				swal(r);
				if(r=1){
					limpiarTablaventas(direccion);
					swal("La venta se realizo con exito","","success");
				}
			}
		});
	}else {
		swal("¡ Error !","No hay productos ingresados para la venta.","error");
	}

	
}


function filtrarVenta(URL){
	var datos= $('#form_filtrarventa').serialize();

	$.ajax({
		type:"POST",
		url:URL+"Ventas/ventasFiltrada",
		data:{datos},
		success:function(r){
			document.getElementById('contenido').innerHTML=r;
		}
	});
}


function detalleVenta(id){
	var URL=$('#URL').val();
	$.ajax({
		type:"POST",
		url:URL+"Ventas/detalleVenta",
		data:{id},
		beforeSend:function(){
			document.getElementById('detalleventa').innerHTML='<div class="alert alert-success" role="alert"><h4>Cargando ...</h4></div>';
			$('.ventana').addClass('mostrar');
		},
		success:function(r){
			document.getElementById('detalleventa').innerHTML=r;
		}
	});
}

function cerrarVentana(){
	$('.ventana').removeClass('mostrar');
}