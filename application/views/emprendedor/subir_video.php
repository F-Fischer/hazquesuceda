<style>
    .banner {
        background-image: url("assets/img/emp.jpg");
    }
</style>

<div class="container-fluid">

    <div class="highlight" align="center">

        <div class="col-lg-12 banner">
            <br>
            <br>
            <br>
            <br>
            <h1 class="page-header" style="font-size: 65px; color: white;">Crear proyecto
                <br>
                <br>
            </h1>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="disabled"><a>Tu proyecto</a></li>
        <li role="presentation" class="active"><a>Video</a></li>
        <li role="presentation" class="disabled"><a>Imágenes</a></li>
        <li role="presentation" class="disabled"><a>Archivo</a></li>
    </ul>

    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 26%">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-6">

        <div>

            <div class="form-group ">
                <h4>Ingrese a continuación la url del video para el proyecto: <?php echo $proyecto->nombre; ?></h4>
            </div>

            <?php
            echo form_open('proyectocontroller/subirVideo/'.$proyecto->ID_proyecto);

            echo '<div class="form-group">'.form_label('Url del video ').form_error('video', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'inputVideo',
                'name' => 'video',
                'class' => 'form-control',
                'value' => set_value('video'),
                'placeholder' => 'Pegue aquí la url de su video en YouTube'
            );

            echo form_input($data).'</div>';

            $data = array(
                'id' => 'btnGuardarVideo',
                'class' => 'btn btn-default',
                'value' => 'Guardar video!',
            );

            echo '<br>'.form_submit($data,'Guardar video!');

            echo form_close();

            echo '<br>'.anchor(base_url().'imagenes/'.$proyecto->ID_proyecto,'No tengo un video todavía');

            ?>

            <br>
            <br>
            <div>
                <h5>* Querido emprendedor, por el momento sólo admitimos videos de YouTube. Disculpe las molestias.</h5>
            </div>

        </div>

    </div>

</div>
