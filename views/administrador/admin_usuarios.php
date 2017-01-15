<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
<div class="container-fluid">

    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Usuarios
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation" ><a href="admin">Todos los proyectos</a></li>
            <li role="presentation" class="active"><a href="users">Usuarios</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <table id="users"  class="table table-striped">

                    <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Mail</th>
                        <th>Fecha de nacimiento</th>
                        <th>ID Rol</th>
                        <th>Fecha Alta</th>
                        <th>Fecha baja</th>
                        <th>Habilitado</th>
                        <th>User Name</th>
                        <th>Newsletter</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php

                    foreach($users as $u)
                    {
                        echo '<tr>

                        <td>'.$u->ID_usuario.'</td>
                        <td>'.$u->nombre.'</td>
                        <td>'.$u->apellido.'</td>
                        <td>'.$u->telefono.'</td>
                        <td>'.$u->mail.'</td>
                        <td>'.$u->fecha_nacimiento.'</td>
                        <td>'.$u->ID_rol.'</td>
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
