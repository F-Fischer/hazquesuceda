<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
<div class="container-fluid">
    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Mis proyectos...
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation"><a href="<?php echo base_url('emprendedor')?> ">Ver todos los proyectos</a></li>
            <li role="presentation"><a href="<?php echo base_url('crearproyecto')?>">Crear proyecto</a></li>
            <li role="presentation" class="active" ><a href="<?php echo base_url('misproyectos')?>">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href="<?php echo base_url('micuentaE')?>">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <table id="proyectosPropios"  class="table table-striped">

                    <thead>
                        <tr>
                            <th>Id Proyecto</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cantidad de veces pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        foreach($proyectos as $p)
                        {
                            echo '<tr><td>'.$p->ID_proyecto.'</td><td>'.$p->nombre.'</td><td>'.$p->descripcion.'</td><td>'.$p->cant_veces_pago.'</td><td>
                             <button type="button" class="btn btn-default" id="btnModificar'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-pencil"></span></button>
                             <button type="button" class="btn btn-default" id="btnClausurar'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-remove"></span></button>
                             <button type="button" class="btn btn-default" id="btnRenovar'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-repeat"></span></button>
                             <button type="button" class="btn btn-default" id="btnFinalizar'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-ok"></span></button>
                             </td></tr>';

                        }

                        ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>

</div>

<script>
    $(document).ready(function(){
        $('#proyectosPropios').DataTable();
    });
</script>
