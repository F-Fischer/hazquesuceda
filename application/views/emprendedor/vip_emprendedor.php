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
        <div>
            <h3 style="color: #dd4814">Visitas: <span style="color: #0c0c0c"><?php echo $proyecto->cant_visitas; ?></span></h3>
        </div>

        <div>
            <h3 style="color: #dd4814">Fecha en la que fue creado: <span style="color: #0c0c0c"><?php echo $proyecto->fecha_alta; ?></span></h3>
        </div>

        <?php

        if($proyecto->ID_estado == 5)
        {
            ?>
            <div>
                <h3 style="color: #dd4814">Fecha en la que consiguió financiación: <span style="color: #0c0c0c"><?php echo $proyecto->fecha_baja; ?></span></h3>
            </div>
            <?php
        }

        ?>

        <div>
            <?php
            if($pdf)
            {
                echo '<h3 style="color: #dd4814">Para más información </h3>';
                echo '<h4> <a style="color: #3284b7" target="_blank" href="'.base_url('/uploads/'.$pdf->pdf).'">Consulta el PDF</a> </h4>';
            }
            ?>
        </div>

    </div>

    <div class="col-md-12">
        <br>
        <h3>Sobre el proyecto...</h3>
        <br>
        <p style="white-space: pre-wrap"><?php echo $proyecto->descripcion; ?></p>
    </div>

    <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                for ($i = 0; $i< $cant_img; $i++)
                {
                    if($i==0)
                    {
                        echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                    }
                    else
                    {
                        echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
                    }
                }
                ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <?php
                for ($i = 0; $i< $cant_img; $i++)
                {
                    if($i==0)
                    {
                        echo '<div class="item active" align="middle" style="height: 600px; max-height: 600px"><img src="'.base_url('/uploads/'.$imgs[$i]->path).'" alt="Chania"></div>';
                    }
                    else
                    {
                        echo '<div class="item" align="middle" style="height: 600px; max-height: 600px"><img src="'.base_url('/uploads/'.$imgs[$i]->path).'" alt="Chania"></div>';
                    }
                }
                ?>

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

</div>