$(document).ready(function(){

    $('body').on('click','.aceptar', function(){
        if(confirm('Desea aceptar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'admin/aceptarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                dataType: "json",
                success: function (e) {
                    $("#nombreEstado" + idProyecto).html("activo");
                }
            });
        }
    });

    $('body').on('click','.clausurar', function(){
        if(confirm('Desea clausurar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'admin/clausurarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                dataType: "json",
                success: function (e) {
                    console.log(e);
                }
            });
        }
    });

    $('body').on('click','.rechazar', function(){
        if(confirm('Desea rechazar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'admin/rechazarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                dataType: "json",
                success: function (e) {

                }
            });
        }
    });

});
