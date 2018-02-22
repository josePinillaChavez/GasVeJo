var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		guardaryeditar(e);
	})

}

function limpiar(){
	$("#id_registro_pago").val("");
	$("#comprobante_pago").val("");
	$("#num_comprobante").val("");
	$("#pedido_id_pedido").val("");
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
					url:'../ajax/registro_pago.php?op=listar',
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
		url:"../ajax/registro_pago.php?op=guardaryeditar",
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
$id_registro_pago, $comprobante_pago, $num_comprobante, $pedido_id_pedido
function mostrar(id_registro_pago){
	$.post("../ajax/registro_pago.php?op=mostrar",{id_registro_pago : id_registro_pago}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#comprobante_pago").val(data.comprobante_pago);
		$("#num_comprobante").val(data.num_comprobante);
		$("#pedido_id_pedido").val(data.pedido_id_pedido);
		$("#id_registro_pago").val(data.id_registro_pago);
	})
}


init();