/**
 * Created by franc on 11/10/2015.
 */
$(document).ready( function() {

    $('#btnCrearProyecto').click(function() {

        $.ajax({
            url : "http://localhost/Haz-que-suceda/ProyectoController/crearProyecto",
            type: "POST",
            data : formData(),
            processData: false,
            contentType: false,
            success : function(data) {
              alert(data);
              //  window.location.replace("http://localhost/Haz-que-suceda");
            }
        })
    });

    function formData() {

        var data = new FormData();
        var imagen1 = document.getElementById("imagen1").files[0];
        var imagen2 = document.getElementById("imagen2").files[0];
        var imagen3 = document.getElementById("imagen3").files[0];
        data.append('imagen1', imagen1);
        data.append('imagen2', imagen2);
        data.append('imagen3', imagen3);
        data.append('nombre',$('#nombre').val());
        data.append('descripcion',$('#descripcion').val());
        data.append('comboRubros',parseInt($('#comboRubros').val()));

        return data;
    }

});