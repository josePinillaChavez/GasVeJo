var tabla;

function init(){
mostrarFormulario(false);
listar();

$("#formulario").on("submit",function(e)
{
    guardar(e);
})

}

function limpiar(){
    $("#id_gas").val("");
    $("#descripcion_gas").val("");
    $("#kilos").val("");
    $("#valor").val("");
   // $("#imagen").val("");
}
function mostrarFormulario(flag){
    limpiar();
    if (flag) {
        $("#listadoRegistros").hide();
        $("#formularioregistros").show();       
        $("#btnGuardar").prop("disabled",false);
    }
    else{
        $("#listadoRegistros").show();
        $("#formularioregistros").hide();
    }

}
function cancelarForm(){
    limpiar();
    mostrarFormulario(false);
}

function listar(){
    tabla=$('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide":true,
        dom: 'Bfrtip',
        buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":
        {
            url: '../ajax/gas.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e){
                console.log(e.responseText);
            }

        },
        "bDestroy":true,
        "iDisplayLenght":10,
        "order":[[0,"desc"]]
    }).DataTable();
}

function guardaryeditar(e){
    e.preventDefault();
    $("#btnGuardar").prop("disable",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/gas.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos){
            bootbox.alert(datos);
            mostrarFormulario(false);
            tabla.ajax.reload();
        }

    });
    limpiar();

}
function editar(){
    
    $("#btnGuardar").prop("disable",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/socio.php?op=editar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos){
            bootbox.alert(datos);
            mostrarFormulario(false);
            tabla.ajax.reload();
        }

    });
    limpiar();

}

function mostrar(id_gas){
    $.post("../ajax/gas.php?op=mostrar", {id_gas: id_gas}, function(data, status) {
        data = JSON.parse(data);
        mostrarFormulario(true);

        $("#id_gas").val(data.id_gas);
        $("#descripcion_gas").val(data.descripcion_gas);
        $("#kilos").val(data.kilos);
        $("#valor").val(data.valor);
        $("#imagen").val(data.imagen);



     
    });




}
init();