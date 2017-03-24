$(document).ready(function (){

    $('body').on('click','.modificar', function(){
        if(confirm('Desea modificar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            redirect("emprendedor/editarproyecto",idProyecto);
        }
    });

    $('body').on('click','.clausurar', function(){
        if(confirm('Desea clausurar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'emprendedor/clausurarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                dataType: "json"
            }).done(function(e){
                if(e.success){
                    redirect("misproyectos","");
                }
            }).fail(function(e){

            });
        }
    });

    $('body').on('click','.renovar', function(){
        if(confirm('Desea renovar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'emprendedor/renovarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                dataType: "json"
            }).done(function(e){
                if(e.success)
                {
                    redirect("misproyectos","");
                }
            }).fail(function(e){

            });
        }
    });

    $('body').on('click','.finalizar', function(){
        if(confirm('Desea finalizar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'emprendedor/finalizarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                dataType: "json"
            }).done(function(e){
                redirect("misproyectos","");
            }).fail(function(e){

            });
        }
    });

    function redirect(uri,attr) {
        pathArray = location.href.split( '/' );
        protocol = pathArray[0];
        host = pathArray[2];
        if(host.includes(".org")){
            if(attr==""){
                url = protocol + '//' + host + '/' + uri;
            }
            else{
                url = protocol + '//' + host + '/' + uri + '/' + attr;
            }
        }
        else {
            if(attr==""){
                url = protocol + '//' + host + '/hazquesuceda/' + uri;
            }
            else{
                url = protocol + '//' + host + '/hazquesuceda/' + uri + '/' + attr;
            }
        }
        window.location.href = url;
    }

});