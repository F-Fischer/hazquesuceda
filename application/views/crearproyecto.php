<body>
<div class="panel panel-default">
    <br>
    <br>
    <br>
    <div class="panel-heading">Cargar nuevo proyecto</div>
    <br>
    <div class="panel-body">
        <img src="<?php echo base_url('assets/img/ideas1.jpg') ?>" class="img-responsive" align="left">
        <div class="col-md-4 container">

            <?php

            echo form_open_multipart('proyectocontroller/crearproyecto');

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

            
            foreach($rubros as $r)
            {
                $data1 = array(
                    'name' => 'rubroSel[]',
                    'value' => $r->ID_rubro
                );

                //echo form_dropdown($data).form_label($r->nombre).'<br>';
            };
            echo form_dropdown('comboRubros', $data1).'<br>';
            /*$options = array(
                '1'  => 'franquicia',
                '2'    => 'proyecto generico',
            );

            echo form_dropdown('comboRubros', $options);*/

            echo '<div class="form-group">'.form_label('Imágenes: ');

            $data = array(
                'id' => 'btnCrearProyecto',
                'class' => 'btn btn-default btn-xl wow tada',
                'value' => 'Crear Proyecto!'
            );

            echo '<br>'.form_submit($data);

            echo form_close();
            ?>

        </div>
        <img src="<?php echo base_url('assets/img/ideas2.jpg') ?>" class="img-responsive" align="right">

    </div>
</div>




<script src="<?= base_url('assets/js/file-validator.js'); ?>"></script>
<!-- <script src="<?php //echo base_url('assets/js/validarformatos.js'); ?>"></script> -->
<script src="<?= base_url('assets/js/crearproyecto.js'); ?>"></script>
</body>