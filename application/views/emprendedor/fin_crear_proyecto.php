<style>
    .banner {
        background-image: url("<?php echo base_url().'assets/img/emp.jpg'; ?>");
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
        <li role="presentation" class="disabled"><a>Tu proyecto</a></li>
        <li role="presentation" class="disabled"><a>Video</a></li>
        <li role="presentation" class="disabled"><a>Imágenes</a></li>
        <li role="presentation" class="active"><a>Archivo</a></li>
    </ul>

    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div>

    <div class="col-lg-offset-3 col-md-6">
        <br>
        <br>
        <div class="jumbotron">
            <h2><strong> Felicitaciones! </strong></h2>
            <p>Tu proyecto se creó exitosamente.</p>
            <p><a class="btn btn-primary btn-lg" href="<?php echo base_url('misproyectos'); ?>" role="button">Ver mis proyectos</a></p>
        </div>
        <br>
        <br>
    </div>

</div>