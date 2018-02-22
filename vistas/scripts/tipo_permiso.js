var tabla;

function init(){
	mostrarform(false);
	listar();


}


function mostrarform(flag){

	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnAgregar").hide();
		
	}
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
					url:'../ajax/tipo_permiso.php?op=listar',
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




init();