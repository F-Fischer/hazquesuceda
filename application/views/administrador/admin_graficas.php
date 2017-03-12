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
                Estadísticas
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked" >
            <li role="presentation" class="active"><a href="statistics">Estadísticas</a></li>
            <li role="presentation" ><a href="reports">Reportes custom</a></li>
            <li role="presentation" ><a href="admin">Todos los proyectos</a></li>
            <li role="presentation" ><a href="users">Usuarios</a></li>
            <li role="presentation" ><a href="newletterempr">Newsletter Emprendedor</a></li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Top 5 de proyectos más pagos</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Nombre</th>
                            <th>Rubro</th>
                            <th>VIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        for($i = 1; $i<=5; $i++)
                        {
                            echo '<tr>

                            <td>'.$i.'</td>
                            <td>'.$top_asc[$i]->nombre.'</td>
                            <td>'.$top_asc[$i]->rubro.'</td>
                            <td><a target="_blank" href="'.base_url().'descripcion/'.$top_asc[$i]->ID_proyecto.'" >Ver proyecto</a></td>

                            </tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-lg-offset-3 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Top 5 de proyectos menos pagos</h3>
            </div>
            <div class="panel-body">
                <p>*Tiene sentido este? porque hay muchos proyectos que nunca se pagaron, estaríamos poniendo 5 al azar...
                    además la bd parece ignorar ese aspecto en las búsquedas. Igual se puede ver lo de la bd.</p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Puesto</th>
                        <th>Nombre</th>
                        <th>Rubro</th>
                        <th>VIP</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    for($i = 1; $i<=5; $i++)
                    {
                        echo '<tr>

                            <td>'.$i.'</td>
                            <td>'.$top_desc[$i]->nombre.'</td>
                            <td>'.$top_desc[$i]->rubro.'</td>
                            <td><a target="_blank" href="'.base_url().'descripcion/'.$top_desc[$i]->ID_proyecto.'" >Ver proyecto</a></td>
                            </tr>';
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Proyectos activos en la plataforma:</h3>
            </div>
            <div class="panel-body">
                <div id="piechart_projects" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Usuarios registrados:</h3>
            </div>
            <div class="panel-body">
                <div id="piechart_users" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Popularidad de rubros:</h3>
            </div>
            <div class="panel-body">
                <div id="barchart_values" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Ubicación de usuarios por provincias:</h3>
            </div>
            <div class="panel-body">
                <div id="regions_div" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

    var username = <?php if($username) { echo 1; } else { echo 0; } ?>;

    if(username == 0)
    {
        window.location.href = "<?php echo base_url(); ?>";
    }

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'geochart']});
    google.charts.setOnLoadCallback(drawChartProyectos);
    google.charts.setOnLoadCallback(drawChartUsuarios);
    google.charts.setOnLoadCallback(drawChartPopularidad);
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawChartProyectos() {
        var array = <?php echo json_encode($array_proyectos); ?>;
        var data = google.visualization.arrayToDataTable(array);

        var options = {
            title: 'Rubros'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_projects'));

        chart.draw(data, options);
    }

    function drawChartUsuarios() {
        var array = <?php echo json_encode($array_usuarios); ?>;
        var data = google.visualization.arrayToDataTable(array);

        var options = {
            title: 'Roles'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_users'));

        chart.draw(data);
    }

    function drawChartPopularidad() {
        var array1 = ["Rubro", "Inversores interesados", { role: "style" } ];
        var array2 = <?php echo json_encode($array_popularidad); ?>;
        array2[0] = array1;
        var data = google.visualization.arrayToDataTable(array2);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            title: "Popularidad medida según rubros preferidos por inversores",
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
        chart.draw(view, options);
    }

    function drawRegionsMap() {
        var array = <?php echo json_encode($array_provincias); ?>;
        var data = google.visualization.arrayToDataTable(array);

        var options = {
            region: 'AR',
            resolution: 'provinces',
            defaultColor: '#ffffff',
            keepAspectRatio: true,
            tooltip:{trigger:'selection'},
            width:900,height:500
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
    }

</script>
