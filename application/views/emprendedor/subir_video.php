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
        <li role="presentation" class="active"><a>Video</a></li>
        <li role="presentation" class="disabled"><a>Imágenes</a></li>
        <li role="presentation" class="disabled"><a>Archivo</a></li>
    </ul>

    <div class="col-md-9">

        <div class="col-md-9">

            <div class="form-group ">
                <h4>Ingrese a continuación la url del video para el proyecto: <?php echo $proyecto->nombre; ?></h4>
            </div>

            <?php
            echo form_open('proyectocontroller/subirVideo/'.$proyecto->ID_proyecto);

            echo '<div class="form-group">'.form_label('Título del proyecto ').form_error('video', '<div class="error" style="color:red; float: right;">', '</div>');

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
            <div class="form-group ">
                <h5>* Querido emprendedor, por el momento sólo admitimos videos de YouTube. Disculpe las molestias.</h5>
            </div>

        </div>

    </div>

</div>
