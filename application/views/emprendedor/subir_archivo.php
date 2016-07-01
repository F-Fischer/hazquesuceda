<div class="container-fluid">

    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Crear proyecto
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation" ><a href="<?php echo base_url('emprendedor') ?> ">Ver todos los proyectos</a></li>
            <li role="presentation" class="active dropdown-menu"><a href="crearproyecto">Crear proyecto</a>

                <ul class="nav nav-pills nav-stacked" >
                    <li role="presentation" class="disabled"><a href="crearproyecto">Nuevo proyecto</a></li>
                    <li role="presentation" class="disabled"><a href="video">Video</a></li>
                    <li role="presentation" class="disabled"><a href="imagenes">Imágenes</a></li>
                    <li role="presentation" id="caro"><a href="archivo">Archivo</a></li>
                </ul>

            </li>
            <li role="presentation"><a href="<?php echo base_url('misproyectos') ?>">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href="<?php echo base_url('micuentaE') ?>">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="form-group ">
                    <h4>Usted subirá un archivo para el proyecto: <?php echo $proyecto->nombre; ?></h4>
                </div>

                <?php

                if($error)
                {
                    echo "<div class=\"alert alert-danger\"><strong> Alerta! </strong>".$error."</div>";
                    echo "<input type='file' name='userfile' size='20' disabled />";
                    echo "<br>";
                    echo "<input type='submit' class='btn btn-default' name='submit' value='upload' disabled/> ";
                }
                else if ($msg)
                {
                    echo "<div class=\"alert alert-success\"><strong> Exito! </strong>".$msg."</div>";
                    echo "<input type='file' name='userfile' size='20' disabled />";
                    echo "<br>";
                    echo "<input type='submit' class='btn btn-default' name='submit' value='upload' disabled/> ";
                }
                else
                {
                    echo form_open_multipart('proyectocontroller/do_upload_pdf'.'/'.$proyecto->ID_proyecto);

                    echo "<input type='file' name='userfile' size='20' />";
                    echo "<br>";
                    echo "<input type='submit' class='btn btn-default' name='submit' value='upload' /> ";

                    echo form_close();

                    echo '<br>'.anchor('http://localhost/hazquesuceda/archivo/'.$proyecto->ID_proyecto.'/Proyecto_sin_archivo','No tengo pdf todavía');
                }
                ?>

                <br>
                <br>
                <div class="form-group ">
                    <h5>* Por el momento solo se podrán cargar 1 archivo por proyecto. Disculpe las molestias.</h5>
                </div>

            </div>
        </div>

    </div>

</div>