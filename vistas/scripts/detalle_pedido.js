var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		guardaryeditar(e);
	})

}

function limpiar(){
	$("#id_detalle_pedido").val("");
	$("#cantidad").val("");
	$("#precio_total_pedido").val("");
	$("#pedido_id_pedido").val("");
	$("#gas_id_gas").val("");
}

function mostrarform(flag){
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
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
					url:'../ajax/detalle_pedido.php?op=listar',
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
		url:"../ajax/detalle_pedido.php?op=guardaryeditar",
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
function mostrar(id_detalle_pedido){
	$.post("../ajax/detalle_pedido.php?op=mostrar",{id_detalle_pedido : id_detalle_pedido}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#cantidad").val(data.cantidad);
		$("#precio_total_pedido").val(data.precio_total_pedido);
		$("#pedido_id_pedido").val(data.pedido_id_pedido);
		$("#gas_id_gas").val(data.gas_id_gas);
	})
}


init();