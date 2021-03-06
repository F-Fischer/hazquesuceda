<style>
    .banner {
        background-image: url("<?php echo base_url().'assets/img/emp.jpg'; ?>");
    }
</style>

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/emprendedor/acciones.proyectos.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">


<div class="container-fluid">

    <div class="highlight" align="center">

        <div class="col-lg-12 banner">
            <br>
            <br>
            <br>
            <br><h1 class="page-header" style="font-size: 65px; color: white;">Ver proyectos propios
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
                            <th>Código identificador</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Cantidad de visitas</th>
                            <th>Cantidad de veces pago</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php

                        /*var_dump($proyectos);*/
                        foreach($proyectos as $p)
                        {
                            echo '<tr>
                                 <td>'.$p->ID_proyecto.'</td>
                                 <td><a target="_blank" href="'.base_url().'descripcionemprendedor/'.$p->ID_proyecto.'" >'.$p->nombre.'</a></td>
                                 <td>'.$p->estado.'</td>
                                 <td>'.$p->cant_visitas.'</td>
                                 <td>'.$p->cant_veces_pago.'</td>
                                 <td id="acciones'.$p->ID_proyecto.'">';

                            switch ($p->estado)
                            {
                                case "activo":
                                    echo '<button type="button" title="Modificar" class="btn btn-default modificar" id="btnModificar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-pencil"></span></button>
                                     <button type="button" title="Clausurar" class="btn btn-default clausurar" id="btnClausurar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-remove"></span></button>
                                     <button type="button" title="Renovar" class="btn btn-default renovar" id="btnRenovar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-repeat"></span></button>
                                     <button type="button" title="Finalizar" class="btn btn-default finalizar" id="btnFinalizar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-ok"></span></button>';
                                    break;
                                case "finalizado":
                                    echo "No hay acciones disponibles";
                                    break;
                                case "clausurado":
                                    echo "No hay acciones disponibles";
//                                        echo '<button type="button" title="Renovar" class="btn btn-default renovar" id="btnRenovar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-repeat"></span></button>';
                                    break;
                                case "solicitado":
                                    echo '<button type="button" title="Clausurar" class="btn btn-default clausurar" id="btnClausurar'.$p->ID_proyecto.'" value="'.$p->ID_proyecto.'"> <span class="glyphicon glyphicon-remove"></span></button>';
                                    break;

                            }
                            echo '</td>
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
        $(document).ready(function(){
            $('#proyectosPropios').DataTable();
        });
    </script>
</div>

