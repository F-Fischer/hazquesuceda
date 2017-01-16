<style>
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
<script src="<?php echo base_url('assets/js/admin/acciones.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
<div class="container-fluid">

    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Proyectos
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation" class="active"><a href="admin">Todos los proyectos</a></li>
            <li role="presentation" ><a href="users">Usuarios</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <table id="todosLosProyectos"  class="table table-striped">

                    <thead>
                    <tr>
                        <th>Id Proyecto</th>
                        <th>Nombre</th>
                        <th>Id de Usuario</th>
                        <th>Nombre de usuario</th>
                        <th>Apellido de usuario</th>
                        <th>Estado</th>
                        <th>Fecha Alta</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php

                    foreach($proyectos as $p)
                    {
                        echo '<tr>

                        <td>'.$p->ID_proyecto.'</td>
                        <td>'.$p->proy_nombre.'</td>
                        <td>'.$p->user_id.'</td>
                        <td>'.$p->nombre.'</td>
                        <td>'.$p->apellido.'</td>
                        <td id="nombreEstado'.$p->ID_proyecto.'">'.$p->nombre_estad.'</td>
                        <td>'.$p->fecha_alta.'</td>
                        <td>
                            <button type="button" title="Aceptar" class="btn btn-default aceptar" id="btnAceptar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"><span class="glyphicon glyphicon-ok"></span></button>
                            <button type="button" title="Rechazar" class="btn btn-default rechazar" id="btnRechazar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-remove"></span></button>
                            <button type="button" title="Clausurar" class="btn btn-default clausurar" id="btnClausurar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-ban-circle"></span></button></td>
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
        $('#todosLosProyectos').DataTable( {
            initComplete: function () {
                this.api().column(5).every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.header()) )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );
    } );

</script>
