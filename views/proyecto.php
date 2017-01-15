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
        <h3 style="color: #dd4814">Visitas: <span style="color: #0c0c0c"><?php echo $proyecto->cant_visitas; ?></span></h3>

        <?php
        if($proyecto->cant_veces_pago==0)
        {
            echo '<h3 style="color: #dd4814">No contactado</h3>';
        }
        else
        {
            echo '<h3 style="color: #dd4814">Evaluado <span style="color: #0c0c0c">'.$proyecto->cant_veces_pago.'</span> veces </h3>';
        }

        ?>

        <h3 style="color: #dd4814">Días restantes: </t><span style="color: #0c0c0c"><?php echo $dias_restantes; ?></span></h3>

        <?php
        if($pdf)
        {
            echo '<h3 style="color: #dd4814">Para más información </h3>';
            echo '<h4> <a style="color: #3284b7" target="_blank" href="'.base_url('/uploads/'.$pdf->pdf).'">Consulta el PDF</a> </h4>';
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

    <div class="col-md-12" align="center">
        <br>
        <br>

        <a mp-mode="dftl" href="https://www.mercadopago.com/mla/checkout/start?pref_id=99395965-937bd220-05e3-47e2-bf16-f041764a067f" name="MP-payButton" class="btn btn-primary">Quiero conocer al emprendedor</a>
        <script type="text/javascript">
            (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
        </script>

    </div>

</div>