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

            <li role="presentation" ><a href="<?php echo base_url('emprendedor')?>">Ver todos los proyectos</a></li>
            <li role="presentation" class="active dropdown-menu"><a href="<?php echo base_url('crearproyecto')?>">Crear proyecto</a>

                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="disabled"><a href="crearproyecto">Nuevo proyecto</a></li>
                    <li role="presentation" class="disabled"><a href="video">Video</a></li>
                    <li role="presentation" id="caro"><a href="imagenes">Imágenes</a></li>
                    <li role="presentation" class="disabled"><a href="archivo">Archivo</a></li>
                </ul>

            </li>
            <li role="presentation"><a href="<?php echo base_url('misproyectos')?>">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href="<?php echo base_url('micuentaE')?>">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-md-9">

                    <div class="form-group ">
                        <h4>Usted subirá una imágen para el proyecto: <?php echo $proyecto->nombre; ?></h4>
                        <?php if(!$special_case) { echo '<h5>Cantidad actual de imágenes: '.$cantimg.'</h5>'; } ?>
                    </div>

                    <?php

                    if($error)
                    {
                        echo "<div class=\"alert alert-danger\"><strong> Alerta! </strong>".$error."</div>";
                        echo "<input type='file' name='userfile' size='20' disabled />";
                        echo "<br>";
                        echo "<input type='submit' class='btn btn-default' name='submit' value='upload' disabled/> ";

                        echo '<br>'.anchor(base_url().'/archivo/'.$proyecto->ID_proyecto,'Continuar');
                    }
                    else if($warning)
                    {
                        echo form_open_multipart('proyectocontroller/do_upload_img/'.$proyecto->ID_proyecto);

                        echo "<div class=\"alert alert-warning\"><strong> Cuidado! </strong>".$warning."</div>";
                        echo "<input type='file' name='userfile' size='20' />";
                        echo "<br>";
                        echo "<input type='submit' class='btn btn-default' name='submit' value='upload'/> ";

                        echo form_close();

                        echo '<br>'.anchor('proyectocontroller/no_img_upload/'.$proyecto->ID_proyecto,'No tengo imágenes todavía');
                        echo '<h5> ó </h5>'.anchor(base_url().'/archivo/'.$proyecto->ID_proyecto,'Ya subí mis imágenes');
                    }
                    else if($special_case)
                    {
                        echo '<h5> Presione continuar para seguir...</h5>';
                        echo "<input type='file' name='userfile' size='20' disabled />";
                        echo "<br>";
                        echo "<input type='submit' class='btn btn-default' name='submit' value='upload' disabled/> ";

                        echo '<br>'.anchor(base_url().'/archivo/'.$proyecto->ID_proyecto,'Continuar');
                    }
                    else
                    {
                        echo form_open_multipart('proyectocontroller/do_upload_img'.'/'.$proyecto->ID_proyecto);

                        echo "<input type='file' name='userfile' size='20' />";
                        echo "<br>";
                        echo "<input type='submit' class='btn btn-default' name='submit' value='upload' /> ";

                        echo form_close();

                        echo '<br>'.anchor('proyectocontroller/no_img_upload/'.$proyecto->ID_proyecto,'No tengo imágenes todavía');
                        echo '<h5> ó </h5>'.anchor(base_url().'archivo/'.$proyecto->ID_proyecto,'Ya subí mis imágenes');
                    }
                    ?>

                    <br>
                    <br>
                    <div class="form-group ">
                        <h5>* Por el momento solo se podrán cargar 3 imágenes por proyecto. Disculpe las molestias.</h5>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
