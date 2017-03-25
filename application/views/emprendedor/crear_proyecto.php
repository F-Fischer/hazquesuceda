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

    <div class="col-lg-offset-3 col-md-6">

        <div class="col-md-12">
            <div align="left">
                <label>Nombre de tu proyecto: </label>
                <br>
                <input type="text" id="nombre">
            </div>

            <div align="left">
                <label>Contanos de qué se trata: </label>
                <br>
                <textarea id="descripcion" cols="60" rows="10">Tu descripcion acá</textarea>
            </div>

            <div>
                <label>Rubro:</label>
                <br>
                <select id="rubros" name="comboRubros" class="col-md-6">
                    <option value="1">Otro</option>
                    <option value="2">Franquicia</option>
                    <option value="3">Social</option>
                    <option value="4">Industrial</option>
                    <option value="5">Económico</option>
                    <option value="6">Servicios</option>
                    <option value="7">Infraestructura</option>
                    <option value="8">Manufacturero</option>
                    <option value="9">Agropecuario</option>
                    <option value="10">Comercial</option>
                </select>
            </div>

            <div align="center">
                <input type="button" id="crear_proyecto" value="Crear proyecto" class="btn btn-default">
                <a href="<?php echo base_url('emprendedor')?>">Regresar</a>
            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function (){

        $("#crear_proyecto").click(function(){
            if($("#nombre").val() == "" || $("#descripcion").val() == "")
            {
                alert('Todos los datos son obligatorios');
            }
            else
            {
                var nombre = $("#nombre").val();
                var descripcion = $("#descripcion").val();
                var rubro =  $("#rubros :selected").val();

                $.ajax({
                    url: 'ProyectoController/crearProyecto',
                    data: {
                        nombre: nombre,
                        descripcion: descripcion,
                        rubro: rubro
                    },
                    type: "POST",
                    dataType: 'json',
                    success: function (res) {
                        window.location.href = 'video/' + res;
                    },
                    error: function(err) {
                        alert('algo salió mal: ' + err.responseText);
                    }
                });
            }
        });

    });
</script>