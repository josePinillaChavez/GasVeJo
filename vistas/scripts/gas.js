var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		guardaryeditar(e);
	})

}

function limpiar(){
	$("#id_gas").val("");
	$("#descripcion_gas").val("");
	$("#kilos").val("");
	$("#valor").val("");
	$("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");
}

function mostrarform(flag){
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		//$("#btnAgregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		//$("#btnAgregar").show();
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
					url:'../ajax/gas.php?op=listar',
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
		url:"../ajax/gas.php?op=guardaryeditar",
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

function mostrar(id_gas){
	$.post("../ajax/gas.php?op=mostrar",{id_gas : id_gas}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#descripcion_gas").val(data.descripcion_gas);
		$("#kilos").val(data.kilos);
		$("#valor").val(data.valor);
		$("#id_gas").val(data.id_gas);
		$("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/gas/"+data.imagen);
        $("#imagenactual").val(data.imagen);  
	})
}


init();