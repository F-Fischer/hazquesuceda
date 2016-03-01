<!-- Page Content -->
<div class="container">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
            <h1 class="page-header">Proyectos
                <small>en busca de una oportunidad...</small>
            </h1>
        </div>
    </div>

    <div class="slider">
        <div id="about-slider">
            <div id="carousel-slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators visible-xs">
                    <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-slider" data-slide-to="1"></li>
                    <li data-target="#carousel-slider" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <img src="http://placehold.it/1500x300" class="img-responsive" alt="">
                        <div class="carousel-caption">
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.3s">
                                <h2><span>Su marca aquí</span></h2>
                            </div>
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">
                                <p>Su marca aquí</p>
                            </div>
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.9s">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <button type="livedemo" name="Live Demo" class="btn btn-primary btn-lg" required="required">Ver todas las marcas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <img src="http://placehold.it/1500x300" class="img-responsive" alt="">
                        <div class="carousel-caption">
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.3s">
                                <h2><span>Su marca aquí</span></h2>
                            </div>
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">
                                <p>Su marca aquí</p>
                            </div>
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.9s">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <button type="livedemo" name="Live Demo" class="btn btn-primary btn-lg" required="required">Ver todas las marcas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/1500x300" class="img-responsive" alt="">
                        <div class="carousel-caption">
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.3s">
                                <h2><span>Su marca aquí</span></h2>
                            </div>
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">
                                <p>Su marca aquí</p>
                            </div>
                            <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.9s">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <button type="livedemo" name="Live Demo" class="btn btn-primary btn-lg" required="required">Ver todas las marcas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>

                <a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div> <!--/#carousel-slider-->
        </div><!--/#about-slider-->
    </div><!--/#slider-->

    <br>

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

            $puntos = "...";

            echo         '<div class="col-lg-4 col-sm-6" align="center">
                             <div class="thumbnail">
                                <a href="#">
                                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                                </a>
                                <h3 style="color: #dd4814">'.$p->nombre.'</h3>
                                <p>'.substr($p->descripcion, 0, 110).$puntos.'</p>
                                <form class="form-inline" data-wow-offset="0" align="center">
                                    <div class="form-group">
                                        <a target="_blank" href="descripcionproyecto" class="btn btn-primary" >Conocer más</a>
                                    </div>
                                </form>
                             </div>
                            </div>';

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


    <hr>

    <!-- Pagination -->
    <div class="row text-center">
        <div class="col-lg-12">
            <?php echo $links;?>
        </div>
    </div>
    <hr>
</div>