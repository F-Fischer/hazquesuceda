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

    <div class="col-md-4">
        <h3 style="color: #dd4814">Cantidad de visitas: </h3>
        <h3><?php echo $proyecto->cant_visitas; ?></h3>
        <h3 style="color: #dd4814">Cantidad de veces pago: </h3>
        <h3><?php echo $proyecto->cant_veces_pago; ?></h3>
        <h3 style="color: #dd4814">Días restantes: </h3>
        <h3> <?php echo $dias_restantes; ?> </h3>

        <?php
        if($pdf)
        {
            echo '<h3 style="color: #dd4814">Para más información: </h3>';
            echo '<h4> <a style="color: #3284b7" href="'.base_url($pdf->pdf).'">descarga del pdf</a> </h4>';
        }
        ?>

    </div>

    <div class="col-md-12">
        <br>
        <h3>Sobre el proyecto...</h3>
        <br>
        <p><?php echo $proyecto->descripcion; ?></p>
    </div>

    <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active" align="center" >
                    <img src="https://placehold.it/1280x720" alt="Chania">
                </div>
                <div class="item" align="center" >
                    <img   src="https://placehold.it/1280x720" alt="Chania">
                </div>
                <div class="item" align="center" >
                    <img  src="https://placehold.it/1280x720" alt="Flower">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="col-md-12" align="center">
        <br>
        <br>
        <form class="form-inline" data-wow-offset="0">
            <div class="form-group">
                <a target="_blank" href="" class="btn btn-primary">Quiero conocer al emprendedor</a>
            </div>
        </form>

    </div>

</div>