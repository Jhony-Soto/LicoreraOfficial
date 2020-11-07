function setProveedores(URL){
	$.ajax({
		type:"POST",
		url:URL+"Proveedores/setProveedores",
		beforeSend:function(){
			document.getElementById('contenido').innerHTML='<div class="alert alert-success" role="alert"><h1>Cargando ...</h1></div>';
		},
		success:function(r){
			document.getElementById('contenido').innerHTML=r;
		}
	});
}


function insertProveedor(URL){
	var datos=$('#formProveedor').serialize();

	$.ajax({
		type:"POST",
		url:URL+"Proveedores/insert",
		cache:false,
		data:{datos},
		success:function(r){
			if(r==1){
				setProveedores(URL);
			}else{
				swal("Datos incorrectos","Por favor valida tus datos","error");
			}
		}
	});
}

function editarProveedor(URL){
	var datos=$('#editarProveedor').serialize();

	$.ajax({
		type:"POST",
		url:URL+"Proveedores/actualizar",
		cache:false,
		data:{datos},
		success:function(r){
			if(r==1){
				// setProveedores(URL);
				window.location=URL+"Proveedores";
			}else{
				swal("Datos incorrectos","Por favor valida tus datos","error");
			}
		}
	});
}

