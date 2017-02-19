$(document).ready(function(){

    $('#popover-nombre').popover({
        html : true,
        content: function(value) {
            return $("#popover-content-nombre").html();
        }
    });

    $('#popover-apellido').popover({
        html : true,
        content: function(value) {
            return $("#popover-content-apellido").html();
        }
    });

    $('#popover-contrasena').popover({
        html : true,
        content: function(value) {
            return $("#popover-content-contrasena").html();
        }
    });

    $('#popover-telefono').popover({
        html : true,
        content: function(value) {
            return $("#popover-content-telefono").html();
        }
    });

    $('#popover-mail').popover({
        html : true,
        content: function(value) {
            return $("#popover-content-mail").html();
        }
    });

});