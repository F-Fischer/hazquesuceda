<body>
<div class="panel panel-default">

    <div class="panel-heading">Bienvenido a Haz que suceda!</div>

    <script>


        $(document).ready(function(){
            var ProvLoc;
            $("#txtUsername").focusout(function(){

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('RegistroInversor/validarUsuario')?>",
                    data: {username: $("#txtUsername").val()},
                    dataType: "text",
                    cache:false,
                    success:
                        function(data){
                            alert(data.respuesta);  //as a debugging message.
                        }
                });
            });


            $.ajax({
                type: "GET",
                url: "<?= base_url('RegistroInversor/getProvinciasLocalidad')?>",
                cache:false,
                success:
                    function(data){
                        ProvLoc = JSON.parse(data);
                        $.each(ProvLoc.provincias,function(index,value){
                            $('#dpProvincia').append($('<option>').text(value.provincia).attr('value', value.id));
                        });

                        fillLocalitiesSelect(ProvLoc);
                    }
            });

            $('#dpProvincia').on("change",function(){

                fillLocalitiesSelect(ProvLoc);
            });
        });

        function fillLocalitiesSelect (ProvLoc){
                var id = $("#dpProvincia option:selected" ).val();

                $('#dpLocalidad')
                    .find('option')
                    .remove()
                    .end();

                $.each(ProvLoc.localidades, function(index,value){
                    if(value.id_provincia == id){
                        $('#dpLocalidad').append($('<option>').text(value.localidad).attr('value', value.id));
                    }

                });
        }

    </script>

    <div class="panel-body">

        <div class="col-lg-6">

            <?php
            echo form_open('registroinversor/registrar');

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

            echo '<div class="form-group">'.form_label('Provincia: ');

            $data = array (
                'id' => 'dpProvincia',
                'name' => 'provincia',
                'class' => 'form-control');

            echo form_dropdown($data).'</div>';

            echo '<div class="form-group">'.form_label('Localidad: ');

            $data = array (
                'id' => 'dpLocalidad',
                'name' => 'localidad',
                'class' => 'form-control');

            echo form_dropdown($data).'</div>';

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

            echo form_label('Seleccione sus rubros de interes...').'<br>';

            foreach($rubros as $r)
            {
                $data = array(
                    'name' => 'rubroSel[]',
                    'value' => $r->ID_rubro
                );

                echo form_checkbox($data).form_label($r->nombre).'<br>';
            }

            $data = array (
                'name' => 'Términos y condiciones',
                'id' => 'tyc');
            $js = 'onclick="btnRegistrarEmprendedor.disabled = !this.checked"';

            echo '<br>'.form_checkbox($data,'accept',FALSE,$js).form_label(' He leído los
                    <a href="#" data-toggle="modal" data-target="#myModal"> términos y condiciones</a>
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

            echo '<br>'.form_submit($data,'Registrame!');

            echo form_close();
            ?>

        </div>
        <img src="<?php echo base_url('assets/img/registroinversor.jpg') ?>" class="img-responsive" align="right">

    </div>


    <!-- PARA LOS TERMINOS Y CONDICIONES -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Términos y
                        condiciones</h4>
                </div>
                <div class="modal-body">Acá van los términos y condiciones,
                    en forma de texto plano, ni bien los redactemos jaja.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
</body>