

function cargarProductos(opcion,direccion){

	if (opcion==0) {
		todosProductos(direccion);
	}else{
		$.ajax({
			type:"POST",
			url:direccion+"Main/consultarProductos",
			data:{opcion},
			beforeSend:function(){
				document.getElementById('contenido').innerHTML='<div class="alert alert-success" role="alert"><h1>Cargando ...</h1></div>';
			
			},
			success:function(r){
				document.getElementById('contenido').innerHTML=r;
			}
		});
	}
}


function todosProductos(direccion){

	$.ajax({
		type:"POST",
		url:direccion+"Main/todosProductos",
		beforeSend:function(){
			document.getElementById('contenido-productos').innerHTML='<div class="alert alert-success" role="alert"><h1>Cargando ...</h1></div>';
		},
		success:function(r){
			document.getElementById('contenido-productos').innerHTML=r;
		}
	});
}


function login(direccion){

	var datos=$('#formulario').serialize();

	$.ajax({
		type:"POST",
		url:direccion+"Login/validarLogin",
		cache:false,
		data:{datos},
		success:function(r){
			if(r==1){
				swal("BIENVENIDO !","","success")
				.then((value) => {
  					window.location=direccion+"Home";
				});
			}else{
				swal("Datos incorrectos","Por favor valida tus datos","error");
			}
		}
	});
}	


function aggCategoria(direccion){
	var datos=$('#frmcategoria').serialize();

	$.ajax({
		type:"POST",
		url:direccion+"Categoria/insert",
		cache:false,
		data:{datos},
		success:function(r){
			if(r==1){
				cargarCategoria(direccion);
			}else{
				swal("Datos incorrectos","Por favor valida tus datos","error");
			}
		}
	});
}


function SetProductos(direccion){

	$.ajax({
		type:"POST",
		url:direccion+"Producto/todosProductos",
		beforeSend:function(){
			document.getElementById('contenido').innerHTML='<div class="alert alert-success" role="alert"><h1>Cargando ...</h1></div>';
			
		},
		success:function(r){
			document.getElementById('contenido').innerHTML=r;
			
		}
	});
}


function aggAumento(direccion){
	var datos=$('#frmaunmento').serialize();

	$.ajax({
		type:"POST",
		url:direccion+"Categoria/aumento",
		cache:false,
		data:{datos},
		success:function(r){
			if(r==1){
				cargarAumento(direccion);
			}else{
				swal("Datos incorrectos","Por favor valida tus datos","error");
			}
		}
	});
}

function cargarCategoria(direccion){
	$.ajax({
		type:"POST",
		url:direccion+"Categoria/todosCategoria",
		beforeSend:function(){
			document.getElementById('contenido').innerHTML='<div class="alert alert-success" role="alert"><h1>Cargando ...</h1></div>';
			
		},
		success:function(r){
			document.getElementById('contenido').innerHTML=r;
		}
	});
}

function cargarAumento(direccion){
	$.ajax({
		type:"POST",
		url:direccion+"Categoria/todosAumento",
		beforeSend:function(){
			document.getElementById('tablaAumento').innerHTML='<div class="alert alert-success" role="alert"><h1>Cargando ...</h1></div>';
			
		},
		success:function(r){
			document.getElementById('tablaAumento').innerHTML=r;
		}
	});
}

function cerrarModal(){
	document.getElementById('overlay').style.display="none";
}


function nuevaVisita(direccion){
	$.ajax({
		type:"POST",
		url:direccion+"Main/nuevaVisita",
		cache:false,
	});
}

function consultarVisitas(direccion){
	var datos=$('#formVisitas').serialize();

	$.ajax({
		type:"POST",
		url:direccion+"Visitas/consultar",
		cache:false,
		data:{datos},
		success:function(r){
			document.getElementById('contenido').innerHTML=r;
		}
	});
}


function buscarProducto(direccion){
	var input=$('#buscador').val();

	$.ajax({
		type:"POST",
		url:direccion+"Producto/consultar",
		cache:false,
		data:{input},
		beforeSend:function(){
			document.getElementById('contenido').innerHTML='<div class="alert alert-success" role="alert"><h1>Cargando ...</h1></div>';
		},
		success:function(r){
			document.getElementById('contenido').innerHTML=r;
			$('#formBuscar')[0].reset();
		}
	});
}

function buscarProductoCliente(direccion){
	var input=$('#buscador').val();

	$.ajax({
		type:"POST",
		url:direccion+"Producto/consultaPorcliente",
		cache:false,
		data:{input},
		success:function(r){
			document.getElementById('contenido-productos').innerHTML=r;
			 location.href="#contenido-productos";
		}
	});
}
		

function totalInventario(direccion){
		$.ajax({
			type:"POST",
			url:direccion+"Home/totalInventario",
			beforeSend:function(){
				document.getElementById('total_inventario').innerHTML='Cargando...';
			},
			success:function(r){
				document.getElementById('total_inventario').innerHTML=r;
			}
		});
}

function gananciaMenual(direccion){
		$.ajax({
			type:"POST",
			url:direccion+"Home/gananciaMenual",
			beforeSend:function(){
				document.getElementById('ganancia_mensual').innerHTML='Cargando...';
			},
			success:function(r){
				document.getElementById('ganancia_mensual').innerHTML=r;
			}
		});
}
