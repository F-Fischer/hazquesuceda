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

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
<div class="container-fluid">

    <div class="highlight" align="center">
        <div class="col-lg-12 banner">
            <br>
            <br>
            <br>
            <br><h1 class="page-header" style="font-size: 65px; color: white;">Usuarios
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >
            <li role="presentation" ><a href="statistics">Estadísticas</a></li>
            <li role="presentation" ><a href="reports">Reportes custom</a></li>
            <li role="presentation" ><a href="admin">Todos los proyectos</a></li>
            <li role="presentation" class="active"><a href="users">Usuarios</a></li>
            <li role="presentation" ><a href="newletterempr">Newsletter Emprendedor</a></li>
        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <table id="users"  class="table table-striped">

                    <thead>
                    <tr>
                        <th>Código identificador</th>
                        <th>Apellido, Nombre</th>
                        <th>Telefono</th>
                        <th>Mail</th>
                        <th>Fecha de nacimiento</th>
                        <th>ID Rol</th>
                        <th>Fecha Alta</th>
                        <th>Fecha baja</th>
                        <th>Habilitado</th>
                        <th>User Name</th>
                        <th>Recibe Newsletter</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php

                    foreach($users as $u)
                    {
                        if($u->habilitado == 1) { $u->habilitado = 'Si'; } else { $u->habilitado = 'No'; }
                        if($u->recibir_newsletter == 1) { $u->recibir_newsletter = 'Si'; } else { $u->recibir_newsletter = 'No'; }

                        echo '<tr>
                        <td>'.$u->ID_usuario.'</td>
                        <td>'.$u->apellido.', '.$u->nombre.'</td>
                        <td>'.$u->telefono.'</td>
                        <td>'.$u->mail.'</td>
                        <td>'.$u->fecha_nacimiento.'</td>
                        <td>'.$u->rol.'</td>
                        <td>'.$u->fecha_alta.'</td>
                        <td>'.$u->fecha_baja.'</td>
                        <td>'.$u->habilitado.'</td>
                        <td>'.$u->user_name.'</td>
                        <td>'.$u->recibir_newsletter.'</td>
                        <td></td>
                        </tr>';
                    }

                    ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>

</div>
<script>

    $(document).ready(function() {
        $('#users').DataTable( {
            "scrollX": true
        } );
    } );

</script>
