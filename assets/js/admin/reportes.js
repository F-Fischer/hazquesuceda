$(document).ready(function(){

    $("#reporte_usuarios").click(function(){
        if($("#fecha_desde_u").val() == "" || $("#fecha_hasta_u").val() == "")
        {
            alert('Seleccione fechas para usuarios');
        }
        else
        {
            var fecha1 = $("#fecha_desde_u").val();
            var fecha2 = $("#fecha_hasta_u").val();

            $.ajax({
                url: 'AdministradorController/usuariosPorFecha',
                data: {
                    fecha_desde_u: fecha1,
                    fecha_hasta_u: fecha2
                },
                type: "POST",
                dataType: 'json',
                success: function (res) {
                    drawChartUsuariosPorFecha(res.respuesta);
                },
                error: function(err) {
                    debugger;
                    alert('algo salió mal: ' + err.responseText);
                }
            });
        }
    });

    $("#reporte_proyectos").click(function(){
        if($("#fecha_desde_p").val() == "" || $("#fecha_hasta_p").val() == "")
        {
            alert('Seleccione fechas para proyectos');
        }
        else
        {
            var fecha1 = $("#fecha_desde_p").val();
            var fecha2 = $("#fecha_hasta_p").val();

            $.ajax({
                url: 'AdministradorController/proyectosPorFecha',
                data: {
                    fecha_desde_p: fecha1,
                    fecha_hasta_p: fecha2
                },
                type: "POST",
                dataType: "json",
                success: function (res) {
                    drawChartProyectosPorFecha(res.respuesta);
                },
                error: function(err) {
                    alert('algo salió mal: ' + err.responseText);
                }
            });
        }
    });

    function drawChartUsuariosPorFecha(respuesta) {
        var array = JSON.parse(respuesta);
        var data = google.visualization.arrayToDataTable(array);

        var options = {
            chart: {
                title: 'Registro de usuarios en la plataforma',
                subtitle: 'Inversores y emprendedores',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_users_date'));

        chart.draw(data, options);
    }

    function drawChartProyectosPorFecha(respuesta) {
        var array = JSON.parse(respuesta);
        var data = google.visualization.arrayToDataTable(array);

        var options = {
            chart: {
                title: 'Popularidad de proyectos en la plataforma',
                subtitle: 'Medida según cantidad de visitas',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_projects_date'));

        chart.draw(data, options);
    }

});


