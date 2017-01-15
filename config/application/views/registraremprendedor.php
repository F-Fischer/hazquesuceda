<div class="panel panel-default">

    <div class="panel-heading">Bienvenido a Haz que suceda!</div>

    <div class="panel-body">

        <div class="col-lg-6">

            <?php
            echo form_open('registroemprendedor/registrar');

            echo '<div class="form-group">'.form_label('Nombre: ').form_error('nombre', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtNombre',
                'name' => 'nombre',
                'class' => 'form-control',
                'value' => set_value('nombre')
            );

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Apellido: ').form_error('apellido', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtApellido',
                'name' => 'apellido',
                'class' => 'form-control',
                'value' => set_value('apellido')
            );

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Teléfono: ').form_error('telefono', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtTelefono',
                'name' => 'telefono',
                'class' => 'form-control',
                'value' => set_value('telefono'));

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Dirección de mail: ').form_error('mail', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtMail',
                'name' => 'mail',
                'type' => 'email',
                'class' => 'form-control',
                'value' => set_value('mail'));

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Fecha de nacimiento: ').form_error('fecha_nacimiento', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtFecha',
                'type' => 'date',
                'name' => 'fecha_nacimiento',
                'class' => 'form-control',
                'value' => set_value('fecha_nacimiento'));

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Usuario: ').form_error('username', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtUsername',
                'name' => 'username',
                'class' => 'form-control',
                'value' => set_value('username'));

            echo form_input($data).'</div> <div id="Info"></div>';

            echo '<div class="form-group">'.form_label('Contraseña: ').form_error('password', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtContrasena1',
                'type' => 'password',
                'name' => 'password',
                'class' => 'form-control');

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Repita contraseña: ').form_error('passconf', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'txtContrasena2',
                'type' => 'password',
                'name' => 'passconf',
                'class' => 'form-control');

            echo form_input($data).'</div>';

            $data = array (
                'name' => 'Términos y condiciones',
                'id' => 'tyc');
            $js = 'onclick="btnRegistrarEmprendedor.disabled = !this.checked"';

            echo '<br>'.form_checkbox($data,'accept',FALSE,$js).form_label(' He leído los
                    <a data-toggle="modal" data-target="#myModal"> términos y condiciones</a>
                    de la plataforma.');

            $data = array(
                'name' => 'newsletter',
                'id' => 'newsletter',
                'value' => 1
            );

            $dataHidden = array(
                'type' => 'hidden',
                'name' => 'newsletter',
                'value' => 0
            );
            echo '<br>'.form_input($dataHidden).form_checkbox($data).form_label('Quiero recibir el newsletter mensual.');

            $data = array(
                'id' => 'btnRegistrarEmprendedor',
                'class' => 'btn btn-default',
                'value' => 'Registrame!',
                'disabled' => ''
            );

            echo '<br>'.form_submit($data);

            echo form_close();
            ?>

        </div>
        <img src="<?php echo base_url('assets/img/emprendedor/registroemprendedor.jpg') ?>" class="img-responsive" align="right">

    </div>


    <!-- PARA LOS TERMINOS Y CONDICIONES -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Términos y condiciones</h4>
                </div>
                <div class="modal-body">Acá van los términos y condiciones, en forma de texto plano, como acordamos con Marcelo.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>