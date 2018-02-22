var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		guardaryeditar(e);
	})

	$.post("../ajax/pedido.php?op=selectGas", function(r){
		$("#gas_id_gas").html(r);
		$("#gas_id_gas").selectpicker('refresh');
	});

}

function limpiar(){
	$("#id_pedido").val("");
	$("#cantidad").val("");
	$("#total_pedido").val("");
	$("#total_kilos_pedidos").val("");
	$("#estado").val("");
	$("#usuario_id_usuario").val("");
	$("#gas_id_gas").val("");

}

function mostrarform(flag){
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		$("#btnAgregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnAgregar").show();
	}
}

function cancelarform(){
	limpiar();
	mostrarform(false);
}

function listar(){
	tabla = $('#tbllistado').dataTable(
	{
		"aProcessing": true,//activamos el procesamiento del datatables
		"aServerSide": true,//paginacion y filtrados realizados por el servidor
		dom: 'Bfrtip', //Definimis los elemontos del control de tabla
		buttons:[
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
		],
		"ajax":
				{
					url:'../ajax/pedido.php?op=listar',
					type: "get",
					dataType: "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//paginacion cada 5 registros
		"order":[[0,"desc"]]
	}).DataTable();
}

function guardaryeditar(e){
	e.preventDefault();//no se activara la funcion predeterminada del evento
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url:"../ajax/pedido.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}



	});
	limpiar();

}


function mostrar(id_pedido){
	$.post("../ajax/pedido.php?op=mostrar",{id_pedido : id_pedido}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#gas_id_gas").val(data.gas_id_gas);
		$("#gas_id_gas").selectpicker('refresh');
		$("#cantidad").val(data.cantidad);
		$("#total_pedido").val(data.total_pedido);
		$("#total_kilos_pedidos").val(data.total_kilos_pedidos);
		$("#estado").val(data.estado);
		$("#usuario_id_usuario").val(data.usuario_id_usuario);
		$("#id_pedido").val(data.id_pedido);
	})
}

function desactivar(id_pedido){
	bootbox.confirm("¿Esta seguro de desactivar pedido?", function(resultado){
		if(resultado){
			$.post("../ajax/pedido.php?op=desactivar", {id_pedido : id_pedido}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(id_pedido){
	bootbox.confirm("¿Esta seguro de activar pedido?",function(resultado){
		if(resultado){
			$.post("../ajax/pedido.php?op=activar", {id_pedido : id_pedido}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();