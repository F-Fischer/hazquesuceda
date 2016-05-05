<body>
<div class="container-fluid">

    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Cargar nuevo proyecto
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation"><a href="emprendedor">Ver todos los proyectos</a></li>
            <li role="presentation" class="active"><a href="crearproyecto">Crear proyecto</a></li>
            <li role="presentation"><a href="misproyectos">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href="micuenta">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

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

        $data = array();

        foreach($rubros as $r){
            $provisorio = array(
                $r->ID_rubro = $r->nombre
            );

            array_splice( $data,2,0,$provisorio);
        }

        echo form_dropdown('comboRubros', $data);

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


    </div>

</div>

<script src="<?= base_url('assets/js/file-validator.js'); ?>"></script>
<!-- <script src="<?php //echo base_url('assets/js/validarformatos.js'); ?>"></script> -->
<script src="<?= base_url('assets/js/crearproyecto.js'); ?>"></script>
</body>