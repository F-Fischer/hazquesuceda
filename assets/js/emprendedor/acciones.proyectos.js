$(document).ready(function (){

    $('body').on('click','.modificar', function(){
        if(confirm('Desea modificar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                url: 'emprendedor/modificarproyecto',
                data: {idProyecto: idProyecto},
                method: "get",
                processData: false,
                dataType: "json",
            }).done(function(e){
                window.location.href = location.origin + '/hazquesuceda/emprendedor/editarproyecto/' + idProyecto;
            }).fail(function(e){

            });
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
                    $("#acciones" + idProyecto).html("No hay acciones disponibles");
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
                    $("#acciones"+idProyecto).html('<button type="button" title="Clausurar" class="btn btn-default clausurar" id="btnClausurar' + idProyecto + ' value="'+ idProyecto +' "> <span class="glyphicon glyphicon-remove"></span></button>');
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
                $("#acciones" + idProyecto).html("No hay acciones disponibles");
            }).fail(function(e){
                alert("no successo");
            });
        }
    });

});