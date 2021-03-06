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
            <h3 style="color: #dd4814">Días restantes: </t><span style="color: #0c0c0c"><?php echo $dias_restantes; ?></span></h3>
        </div>

        <div>
            <?php
            if($pdf)
            {
                echo '<h3 style="color: #dd4814">Para más información </h3>';
                echo '<h4> <a style="color: #3284b7" target="_blank" href="'.base_url('/uploads/'.$pdf->pdf).'">Consulta el PDF</a> </h4>';
            }
            ?>
        </div>

        <br>
        <br>
        <br>

        <div>
            <a href="<?php echo $mp_preference["response"]["sandbox_init_point"]; ?>" name="MP-Checkout" class="btn btn-primary" onreturn="execute_my_onreturn" >Quiero invertir en este proyecto</a>
            <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
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

<script type="text/javascript">
    function execute_my_onreturn (data) {
        if (data.collection_status=='approved')
        {
            window.location.replace("<?php echo base_url().'pagar/'.$proyecto->ID_proyecto.'/'; ?>" + data.collection_id);
        }
        else
        {
            alert('La transacción no se ha completado. Intente nuevamente.');
        }
    }
</script>


