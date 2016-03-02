<body>
<div class="panel panel-default">
    <br>
    <br>
    <br>
    <div class="panel-heading">Cargar nuevo proyecto</div>
    <div class="panel-body">
        <div class="col-lg-6">

            <?php

            echo form_open('proyectocontroller/crearproyecto');

            echo '<div class="form-group">'.form_label('Nombre del proyecto: ').form_error('nombre', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtNombre',
                'name' => 'nombre',
                'class' => 'form-control',
                'value' => set_value('nombre')
            );

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Descripción: ').form_error('descripcion', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtDescripcion',
                'name' => 'descripcion',
                'class' => 'form-control',
                'rows' => 10,
                'columns' => 50,
                'value' => set_value('descripcion')
            );

            echo form_textarea($data).'</div>';

            echo '<div class="form-group">'.form_label('Rubro: ').form_error('rubro', '<div class="error" style="color:red; float: right;">', '</div>');

            $options = array(
                '1'  => 'franquicia',
                '2'    => 'proyecto generico',
            );

            echo form_dropdown('comboRubros', $options);

            echo '<div class="form-group">'.form_label('Imágenes: ');

            ?>

            <input type="file" name="imagen[]" class="images" id="imagen1">
            <input type="file" name="imagen[]" class="images" id="imagen2">
            <input type="file" name="imagen[]" class="images" id="imagen3">

            <?php
            $data = array(
                'id' => 'btnCrearProyecto',
                'class' => 'btn btn-default',
                'value' => 'Crear Proyecto!'
            );

            echo '<br>'.form_submit($data);

            echo form_close();
            ?>

        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/file-validator.js'); ?>"></script>
<!-- <script src="<?php //echo base_url('assets/js/validarformatos.js'); ?>"></script> -->
<script src="<?= base_url('assets/js/crearproyecto.js'); ?>"></script>
</body>