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
            <br><h1 class="page-header" style="font-size: 65px; color: white;">Crear proyecto
                <br>
                <br>
            </h1>
        </div>

    </div>

    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="active"><a>Tu proyecto</a></li>
        <li role="presentation" class="disabled"><a>Video</a></li>
        <li role="presentation" class="disabled"><a>Imágenes</a></li>
        <li role="presentation" class="disabled"><a>Archivo</a></li>
    </ul>

    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 5%">
            <span class="sr-only">10% Complete (success)</span>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-12">

        <div class="col-md-6">

            <?php
            echo form_open('proyecto/crearproyecto');

            echo '<div class="form-group">'.form_label('Título del proyecto ').form_error('nombre', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'inputNombre',
                'name' => 'nombre',
                'class' => 'form-control',
                'value' => set_value('nombre')
            );

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Descripción ').form_error('descripcion', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'inputDescripcion',
                'name' => 'descripcion',
                'class' => 'form-control',
                'value' => set_value('descripcion')
            );

            echo form_textarea($data).'</div>';

            echo '<div class="form-group">'.form_error('rubro', '<div class="error" style="color:red; float: right;">', '</div>');

            echo '<select id="comboRubros" name="comboRubros" class="col-md-6" class="form-control">';
            foreach($rubros as $rubro)
                echo '<option value="'.$rubro->ID_rubro.'">'.$rubro->nombre.'</option>';
            echo '</select><br>';

            $data = array(
                'id' => 'btnCrearProyecto',
                'class' => 'btn btn-default',
                'value' => 'Crear proyecto!',
            );

            echo '<br>'.form_submit($data,'Crear proyecto!');

            echo form_close();
            ?>

            <a href="<?php echo base_url('emprendedor')?>">Regresar</a>

        </div>

    </div>

</div>
