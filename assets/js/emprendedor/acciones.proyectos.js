$(document).ready(function (){

    $('body').on('click','.modificar', function(){
        if(confirm('Desea modificar este proyecto?')) {
            var idProyecto = $(this).attr('value');
            $.ajax({
                 url: 'emprendedor/modificarproyecto',
                 data: {idProyecto: idProyecto},
                 method: "get",
                 dataType: "json",
                 success: function (e) {
                 
             }
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
             dataType: "json",
             success: function (e) {
             
             }
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
             dataType: "json",
             success: function (e) {
             
             }
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
             dataType: "json",
             success: function (e) {
            
             }
             });
        }
    });

});