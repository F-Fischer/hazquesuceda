$(document).ready(function(){

    $('body').on('click','.aceptar', function(){
        if(confirm('Desea activar este proyecto? Recuerde que esto implica que el proyecto será visible para todos los inversores de la plataforma.')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'admin/aceptarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                dataType: "json",
                success: function (e) {
                    redirect();
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
                    redirect();
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
                    redirect();
                }
            });
        }
    });

    function redirect() {
        pathArray = location.href.split( '/' );
        protocol = pathArray[0];
        host = pathArray[2];
        if(host.includes(".org")){
            url = protocol + '//' + host + '/admin';
        }
        else {
            url = protocol + '//' + host + '/hazquesuceda/admin';
        }
        window.location.href = url;
    }

});
