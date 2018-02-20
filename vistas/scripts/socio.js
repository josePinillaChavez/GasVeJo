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
    $("#rut_socio").val("");
    $("#dv_socio").val("");
    $("#nombre").val("");
    $("#fechaIngreso").val("");
    $("#telefono").val("");
    $("#region").val("");   
    $("#estado").val("");
    $("#user_type").val("");
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
            url: '../ajax/socio.php?op=listar',
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

function guardar(e){
    e.preventDefault();
    $("#btnGuardar").prop("disable",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/socio.php?op=guardar",
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

function mostrar(rut_soc){
    $.post("../ajax/socio.php?op=mostrar", {rut_soc: rut_soc}, function(data, status) {
        data = JSON.parse(data);
        mostrarFormulario(true);

        $("#rut_soc").val(data.rut_soc);
        $("#dv_soc").val(data.dv_soc);
        $("#nombre").val(data.nombre);
        $("#fechaIngreso").val(data.fechaIngreso);
        $("#region").val(data.region);
        $("#telefono").val(data.telefono);
         $("#estado").val(data.estado);
        $("#user_type").val(data.user_type);
     
    });




}
function desactivar(rut_soc){
    bootbox.confirm("¿Esta Seguro de desactivar la Categora?",function(result){
        if (result) {
            $.post("../ajax/socio.php?op=desactivar", {rut_soc : rut_soc}, function(e){
            bootbox.alert(e);
            tabla.ajax.reload();


            });
         
        }
    })
}


function ativar(rut_soc){
    bootbox.confirm("¿Esta Seguro de tivar la Categora?",function(result){
        if (result) {
            $.post("../ajax/socio.php?op=activar", {rut_soc : rut_soc}, function(e){
                   bootbox.alert(e);
                   tabla.ajax.reload();

            });
         
        }
    })
}
init();