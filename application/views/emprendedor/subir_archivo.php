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

    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="disabled"><a>Tu proyecto</a></li>
        <li role="presentation" class="disabled"><a>Video</a></li>
        <li role="presentation" class="disabled"><a>Imágenes</a></li>
        <li role="presentation" class="active"><a>Archivo</a></li>
    </ul>

    <div class="col-md-9">

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
            echo "<a href='".base_url('misproyectos')."'>Ver mis proyectos</a>";
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