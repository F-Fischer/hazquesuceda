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
        <li role="presentation" class="active"><a>Imágenes</a></li>
        <li role="presentation" class="disabled"><a>Archivo</a></li>
    </ul>

    <div class="col-md-9">
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

            <br>
            <br>
            <div class="form-group ">
                <h5>* Por el momento solo se podrán cargar 3 imágenes por proyecto. Disculpe las molestias.</h5>
            </div>

        </div>
    </div>

</div>
