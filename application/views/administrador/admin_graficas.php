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
            <li role="presentation" ><a href="admin">Todos los proyectos</a></li>
            <li role="presentation" ><a href="users">Usuarios</a></li>
            <li role="presentation" class="active"><a href="statistics">Estadísticas</a></li>
        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Proyectos activos en la plataforma:</h3>
                <div id="piechart_projects" style="width: 900px; height: 500px;"></div>
            </div>
            <div class="panel-body">
                <h3>Usuarios registrados:</h3>
                <div id="piechart_users" style="width: 900px; height: 500px;"></div>
            </div>
            <div class="panel-body">
                <h3>Popularidad de proyectos:</h3>
                <div id="barchart_values" style="width: 900px; height: 300px;"></div>
            </div>
<!--            <div class="panel-body">-->
<!--                <h3>Data:</h3>-->
<!--                <div id="segundo">-->
<!--                    --><?php
//                    print_r($array);
//                    ?>
<!--                </div>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <h3>Chart bis:</h3>-->
<!--                <div id="chartbis" style="width: 900px; height: 500px;"></div>-->
<!--            </div>-->
        </div>

    </div>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChartProyectos);
    google.charts.setOnLoadCallback(drawChartUsuarios);
    google.charts.setOnLoadCallback(drawChartPopularidad);

    function drawChartProyectos() {
        var data = google.visualization.arrayToDataTable([
            ['Rubro', 'Cantidad'],
            ['Proyecto genérico', 11],
            ['Franquicia', 2],
            ['Social', 2],
            ['Industrial', 2],
            ['Económico', 7],
            ['Servicios', 8],
            ['Infraestructura', 7],
            ['Manufacturero', 5],
            ['Agropecuario', 15],
            ['Comercial', 10]
        ]);

        var chart = new google.visualization.PieChart(document.getElementById('piechart_projects'));

        chart.draw(data);
    }

    function drawChartUsuarios() {
        var data = google.visualization.arrayToDataTable([
            ['Tipo', 'Cantidad'],
            ['Emprendedor', 20],
            ['Inversor', 60],
            ['Admin', 1]
        ]);

        var chart = new google.visualization.PieChart(document.getElementById('piechart_users'));

        chart.draw(data);
    }

    function drawChartPopularidad() {
        var data = google.visualization.arrayToDataTable([
            ["Rubro", "Visitas", { role: "style" } ],
            ["Proyecto genérico", 8, "color: #cc00ff"],
            ["Franquicia", 10, "color: #ff3399"],
            ["Social", 19, "color: #ff0000"],
            ["Industrial", 21, "color: #ff9933"],
            ["Económico", 21, "color: #ffff66"],
            ["Servicios", 28, "color: #ccff66"],
            ["Infraestructura", 30, "color: #33ccff"],
            ["Manufacturero", 2, "color: #0000ff"],
            ["Agropecuario", 79, "color: #cc6699"],
            ["Comercial", 5, "color: #800000"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            title: "Popularidad medida según visitas de cada proyecto en la plataforma",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
        chart.draw(view, options);
    }

    function drawChartBis() {

        var arr = [['Rubro', 'Cantidad'], ['primero', 50]];

        var hola = <?php echo json_encode($array, JSON_HEX_TAG); ?>;
        alert(typeof hola);

//        var obj = {"segundo":"20","tercero":"30"};
//        var ar = [];
//        for (elem in obj) {
//            arr.push([elem, obj[elem]]);
//        }

        var array = hola.split(",");

        alert(array);

        var data = google.visualization.arrayToDataTable(array);

        var options = {
            title: 'Rubros'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chartbis'));

        chart.draw(data, options);
    }

</script>
