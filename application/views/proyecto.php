<div class="container">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
            <h1 class="page-header" align="center"><?php echo $proyecto->nombre; ?></h1>
            <h3 align="center" style="color: #888888"><?php echo $proyecto->rubro; ?></h3>
        </div>
    </div>

    <br>

    <div id="video" class="col-lg-8">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $proyecto->youtube; ?>" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="col-lg-4" style="width:300px; height:400px;">
        <h3 style="color: #dd4814">Cantidad de visitas: </h3>
        <h3><?php echo $proyecto->cant_visitas; ?></h3>
        <h3 style="color: #dd4814">Cantidad de veces pago: </h3>
        <h3><?php echo $proyecto->cant_veces_pago; ?></h3>
    </div>

    <div>
        <h3>Sobre el proyecto...</h3>

        <p><?php echo $proyecto->descripcion; ?></p>
    </div>

    <br>
    <br>
    <br>
    <div align="center">
        <form class="form-inline" data-wow-offset="0">
            <div class="form-group">
                <a target="_blank" href="" class="btn btn-primary">Quiero conocer al emprendedor</a>
            </div>
        </form>

    </div>

</div>