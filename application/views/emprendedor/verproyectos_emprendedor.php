<div class="container-fluid">

    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Proyectos
                <small>en busca de una oportunidad...</small>
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation" class="active"><a href="http://localhost/hazquesuceda/emprendedor">Ver todos los proyectos</a></li>
            <li role="presentation"><a href="http://localhost/hazquesuceda/crearproyecto">Crear proyecto</a></li>
            <li role="presentation"><a href="http://localhost/hazquesuceda/misproyectos">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href="http://localhost/hazquesuceda/micuenta">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <?php

        if($portfolio && isset($portfolio))
        {
            $cont = 0;

            foreach($portfolio as $p)
            {

                if($cont == 0)
                {
                    echo '<div class="row">';
                }
                ?>

                <div class="col-lg-4 col-sm-6" align="center">
                 <div class="thumbnail">
                    <a href="#">
                        <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                    </a>
                    <h3 style="color: #dd4814"><?php echo $p->nombre; ?></h3>
                    <p><?php echo substr($p->descripcion, 0, 110); ?>...</p>
                    <form class="form-inline" data-wow-offset="0" align="center">
                        <div class="form-group">
                            <a target="_blank" href="descripcion/<?php echo $p->ID_proyecto; ?>" class="btn btn-primary" >Conocer más</a>
                        </div>
                    </form>
                 </div>
                </div>

                <?php

                $cont++;

                if($cont == 3)
                {
                    echo '</div>';
                    $cont = 0;
                }
            }
            if($cont != 3 && $cont > 0)
            {
                echo '</div>';
            }
        }
        ?>

        </div>

    <hr>

    <!-- Pagination -->
    <div class="row text-center">
        <div class="col-lg-12">
            <?php echo $links;?>
        </div>
    </div>
    <hr>


</div>
