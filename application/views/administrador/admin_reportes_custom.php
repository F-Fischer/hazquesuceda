<style>
    .banner {
        background-image: url("assets/img/admin.jpg");
    }

    .nav-pills > li.active > a, .nav-pills > li.active > a:focus {
        color: white;
        background-color: #129FEA;
    }

    .nav-pills > li.active > a:hover {
        background-color: #a07ab1;
        color:white;
    }

    a {
        color: #129FEA;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    a:hover,
    a:focus {
        color: #a07ab1;
    }

    .btn-primary {
        border-color: #129FEA;
        color: #fff;
        background-color: #129FEA;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary.focus,
    .btn-primary:active,
    .btn-primary.active,
    .open > .dropdown-toggle.btn-primary {
        border-color: #a07ab1;
        color: #fff;
        background-color: #a07ab1;
    }

    .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover,
    .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
        z-index: 2;
        color: #fff;
        cursor: default;
        background-color: #129FEA;
        border-color: #129FEA
    }

    .pagination > li > a, .pagination > li > span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #129FEA;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd
    }

    hr {
        max-width: 50px;
        border-color: #129FEA;
        border-width: 3px;
    }

    .btn-default {
        border-color: #129FEA;
        color: #222;
        background-color: #129FEA;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .btn-default:hover,
    .btn-default:focus,
    .btn-default.focus,
    .btn-default:active,
    .btn-default.active,
    .open > .dropdown-toggle.btn-default {
        border-color: #129FEA;
        color: #222;
        background-color: #129FEA;
    }
</style>

<div class="container-fluid">
    <div class="highlight" align="center">
        <div class="col-lg-12 banner">
            <br>
            <br>
            <br>
            <br>
            <h1 class="page-header" style="font-size: 65px; color: white;">
                Reportes custom
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked" >
            <li role="presentation" ><a href="statistics">Estadísticas</a></li>
            <li role="presentation" class="active"><a href="reports">Reportes custom</a></li>
            <li role="presentation" ><a href="admin">Todos los proyectos</a></li>
            <li role="presentation" ><a href="users">Usuarios</a></li>
            <li role="presentation" ><a href="newletterempr">Newsletter Emprendedor</a></li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Usuarios segun fecha:</h3>
            </div>
            <div class="panel-body">
                <div>

                    <label>Fecha desde: </label>
                    <input type="date" id="fecha_desde_u">
                    <label>Fecha hasta: </label>
                    <input type="date" id="fecha_hasta_u">
                    <input type="button" id="reporte_usuarios" value="Generar reporte" class="btn btn-default">
                    <br>
                    <br>
                    <br>

                </div>
                <div id="barchart_users_date" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Proyectos segun fecha:</h3>
            </div>
            <div class="panel-body">
                <div>

                    <label>Fecha desde: </label>
                    <input type="date" id="fecha_desde_p">
                    <label>Fecha hasta: </label>
                    <input type="date" id="fecha_hasta_p">
                    <input type="button" id="reporte_proyectos" value="Generar reporte" class="btn btn-default">
                    <br>
                    <br>
                    <br>

                </div>

                <div id="barchart_projects_date" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/admin/reportes.js'); ?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChartUsuariosPorFecha);
    google.charts.setOnLoadCallback(drawChartProyectosPorFecha);

    function drawChartUsuariosPorFecha() {
        var array = <?php echo json_encode($array_usuarios_fecha); ?>;
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

    function drawChartProyectosPorFecha() {
        var array = <?php echo json_encode($array_proyectos_fecha); ?>;
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

</script>
