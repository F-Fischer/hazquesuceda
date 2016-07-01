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

            <li role="presentation" ><a href=" <?php echo base_url('emprendedor'); ?> ">Ver todos los proyectos</a></li>
            <li role="presentation" class="active dropdown-menu"><a href="crearproyecto">Crear proyecto</a>

                    <ul class="nav nav-pills nav-stacked" >
                        <li role="presentation" id="caro"><a href="crearproyecto">Nuevo proyecto</a></li>
                        <li role="presentation" class="disabled" ><a href="video">Video</a></li>
                        <li role="presentation" class="disabled"><a href="imagenes">Imágenes</a></li>
                        <li role="presentation" class="disabled"><a href="archivo">Archivo</a></li>
                    </ul>

            </li>
            <li role="presentation"><a href=" <?php echo base_url('misproyectos'); ?> ">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href=" <?php echo base_url('micuentaE'); ?> ">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-md-6">

                    <?php
                    echo form_open('proyectocontroller/crearProyecto');

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

                </div>

            </div>
        </div>

    </div>

</div>
