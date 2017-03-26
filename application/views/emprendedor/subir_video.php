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
            <br>
            <h1 class="page-header" style="font-size: 65px; color: white;">Crear proyecto
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

    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 26%">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-6">

        <div>

            <div>
                <h4>Ingrese a continuación la url del video para el proyecto: <?php echo $proyecto->nombre; ?></h4>
                <label id="id_proyecto" value="<?php echo $proyecto->ID_proyecto; ?>"><?php echo $proyecto->ID_proyecto; ?></label>
            </div>

            <div>
                <label>Url del video: </label>
                <br>
                <input type="text" id="video">
                <br>
                <br>
            </div>

            <div>
                <input type="button" id="subir_video" value="Subir video" class="btn btn-default">
                <a href="<?php echo base_url().'imagenes/'.$proyecto->ID_proyecto; ?>">No tengo video todavía</a>
            </div>

            <br>
            <div>
                <h5>* Querido emprendedor, por el momento sólo admitimos videos de YouTube. Disculpe las molestias.</h5>
            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function (){

        $("#subir_video").click(function(){
            if($("#video").val() == "")
            {
                alert('No insertó url');
            }
            else
            {
                var video = $("#video").val();
                var id_proyecto = document.getElementById("id_proyecto").innerText;

                debugger;

                $.ajax({
                    url: 'ProyectoController/subirVideo',
                    data: {
                        video: video,
                        id: id_proyecto
                    },
                    type: "POST",
                    success: function (res) {
                        debugger;
                        window.location.href = 'imagenes/' + res;
                    },
                    error: function(err) {
                        debugger;
                        alert('algo salió mal: ' + err.responseText);
                    }
                });
            }
        });

    });
</script>
