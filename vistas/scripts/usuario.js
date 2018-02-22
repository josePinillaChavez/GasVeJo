var tabla;

function init(){
mostrarFormulario(false);
listar();

$("#formulario").on("submit",function(e)
{
    guardaryeditar(e);
})
$("#imagenmuestra").hide();

}

function limpiar(){

    $("#id_usuario").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#imagen").val("");
    $("#condicion").val("");

    $("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");

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
            url: '../ajax/usurio.php?op=listar',
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
        url: "../ajax/usuario.php?op=guardaryeditar",
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
        url: "../ajax/usuario.php?op=editar",
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
    $.post("../ajax/usuario.php?op=mostrar", {id_gas: id_gas}, function(data, status) {
        data = JSON.parse(data);
        mostrarFormulario(true);

        $("#id_usuario").val(data.id_gas);
        //$("#id_gas").selectpicker('refresh');
        $("#login").val(data.descripcion_gas);
        $("#clave").val(data.kilos);
        $("#imagen").val(data.valor);
        $("#condicion").val(data.valor);
        
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/usuarios/"+data.imagen);
        $("#imagenactual").val(data.imagen);    
    });



}
init();