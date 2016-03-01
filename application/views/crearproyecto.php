<body>
<div class="panel panel-default">
    <div class="panel-heading">Cargar nuevo proyecto</div>
    <div class="panel-body">
        <div class="col-lg-6">

            <form role="form">
                <div class="form-group">
                    <label>Nombre</label>
                    <input name="nombre" id="nombre" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <textarea name="descripcion" id="descripcion" cols="40" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Rubro</label>
                    <br>
                    <select id="comboRubros" class="col-md-3" class="form-control">
                        <?php
                        foreach($rubros as $rubro)
                            echo '<option value="'.$rubro->ID_rubro.'">'.$rubro->nombre.'</option>'
                        ?>
                    </select>
                    <br>
                </div>

                <div class="form-group">
                    <label>Imágenes</label>
                    <input type="file" name="imagen[]" class="images" id="imagen1">
                    <input type="file" name="imagen[]" class="images" id="imagen2">
                    <input type="file" name="imagen[]" class="images" id="imagen3">
                </div>

                <div class="form-group">
                    <input value="Crear Proyecto" class="btn btn-default" id="btnCrearProyecto">
                </div>
            </form>

        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/file-validator.js'); ?>"></script>
<!-- <script src="<?php //echo base_url('assets/js/validarformatos.js'); ?>"></script> -->
<script src="<?= base_url('assets/js/crearproyecto.js'); ?>"></script>
</body>