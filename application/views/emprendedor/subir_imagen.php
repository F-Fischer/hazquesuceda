<style>
    .banner {
        background-image: url("<?php echo base_url().'assets/img/emp.jpg'; ?>");
    }
</style>

<div class="container-fluid">

    <div class="highlight" align="center">

        <div class="col-lg-12 banner">
            <br>
            <br>
            <br>
            <br><h1 class="page-header" style="font-size: 65px; color: white;">Crear proyecto
                <br>
                <br>
            </h1>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="disabled"><a>Tu proyecto</a></li>
        <li role="presentation" class="disabled"><a>Video</a></li>
        <li role="presentation" class="active"><a>Imágenes</a></li>
        <li role="presentation" class="disabled"><a>Archivo</a></li>
    </ul>

    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 49%">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-6">
        <div>

            <div class="form-group">
                <h4>Usted subirá una imágen para el proyecto: <?php echo $proyecto->nombre; ?></h4>
                <div class="alert alert-info" role="alert">
                    <?php if(!$special_case) { echo '<a href="#" class="alert-link">Cantidad actual de imágenes: '.$cantimg.'</a>'; } ?>
                </div>
            </div>
            <br>
            <div>
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
                    echo form_open_multipart('ProyectoController/do_upload_img/'.$proyecto->ID_proyecto);

                    echo "<div class=\"alert alert-warning\"><strong> Cuidado! </strong>".$warning."</div>";
                    echo "<input type='file' name='userfile' size='20' />";
                    echo "<br>";
                    echo "<input type='submit' class='btn btn-default' name='submit' value='upload'/> ";

                    echo form_close();

                    echo '<br>'.anchor('ProyectoController/no_img_upload/'.$proyecto->ID_proyecto,'No tengo imágenes todavía');
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
                    echo form_open_multipart('ProyectoController/do_upload_img'.'/'.$proyecto->ID_proyecto);

                    echo "<input type='file' name='userfile' size='20' />";
                    echo "<br>";
                    echo "<input type='submit' class='btn btn-default' name='submit' value='upload' /> ";

                    echo form_close();

                    echo '<br>'.anchor('ProyectoController/no_img_upload/'.$proyecto->ID_proyecto,'No tengo imágenes todavía');
                    echo '<h5> ó </h5>'.anchor(base_url().'archivo/'.$proyecto->ID_proyecto,'Ya subí mis imágenes');
                }
                ?>
            </div>
            <br>
            <br>
            <div>
                <h5>* Por el momento solo se podrán cargar 3 imágenes por proyecto. Disculpe las molestias.</h5>
            </div>

        </div>
    </div>

</div>
