$("#frmAccseso").on('submit',function(e){
	e.preventDefault();
	logina=$("#logina").val();
	clavea=$("#clavea").val();

	$.post("../ajax/usuario.php?op=verificar", {"logina": logina,"clavea":clavea}, function(data) 
	{
		if (data != "null") {
			$(location).attr("href","gas.php");

		}
			else{
			bootbox.alert("Incorrecto");
			}
	});
}) 