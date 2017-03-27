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
        <li role="presentation" class="disabled"><a>Imágenes</a></li>
        <li role="presentation" class="active"><a>Archivo</a></li>
    </ul>

    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-6">

        <div class="form-group">
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
        else
        {
            echo form_open_multipart('ProyectoController/do_upload_pdf'.'/'.$proyecto->ID_proyecto);

            echo "<input type='file' name='userfile' size='20' />";
            echo "<br>";
            echo "<input type='submit' class='btn btn-default' name='submit' value='upload' /> ";

            echo form_close();

            echo '<br>'.anchor(base_url().'archivo/'.$proyecto->ID_proyecto.'/Proyecto_sin_archivo','No tengo pdf todavía');
        }
        ?>

        <br>
        <br>
        <div class="form-group ">
            <h5>* Por el momento solo se podrán cargar 1 archivo por proyecto. Disculpe las molestias.</h5>
        </div>

    </div>

</div>