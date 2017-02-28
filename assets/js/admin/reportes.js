$(document).ready(function(){

    /*$("#btnUsuariosPorFecha").click(function(){
        if($("#txtFechaHasta").val() == "" || $("#txtFechaDesde").val() == "")
        {
            alert('no selecciono fecha');
        }
        else
        {
            var fecha1 = $("#txtFechaDesde").val();
            var fecha2 = $("#txtFechaHasta").val();

            $.ajax({
                url: 'AdministradorController/usuariosPorFecha',
                data: {
                    fecha_desde: fecha1,
                    fecha_hasta: fecha2
                },
                method: "get",
                dataType: "json",
                success: function (e) {
                    alert('entro success');
                },
                error: function(err) {
                    alert('entro mal: ' + err.responseText);
                }
            });
        }
    });*/

});