<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
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
                        <td>'.$p->nombre_estad.'</td>
                        <td>'.$p->fecha_alta.'</td>
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
