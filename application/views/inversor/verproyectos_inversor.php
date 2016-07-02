<style>
    .nav-pills > li.active > a, .nav-pills > li.active > a:focus {
        color: white;
        background-color: mediumvioletred;
    }

    .nav-pills > li.active > a:hover {
        background-color: #a07ab1;
        color:white;
    }

    a {
        color: mediumvioletred;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    a:hover,
    a:focus {
        color: #a07ab1;
    }

    .btn-primary {
        border-color: mediumvioletred;
        color: #fff;
        background-color: mediumvioletred;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary.focus,
    .btn-primary:active,
    .btn-primary.active,
    .open > .dropdown-toggle.btn-primary {
        border-color: #a07ab1;
        color: #fff;
        background-color: #a07ab1;
    }

    .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover,
    .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
        z-index: 2;
        color: #fff;
        cursor: default;
        background-color: mediumvioletred;
        border-color: mediumvioletred
    }

    .pagination > li > a, .pagination > li > span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: mediumvioletred;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd
    }

    hr {
        max-width: 50px;
        border-color: mediumvioletred;
        border-width: 3px;
    }

    .btn-default {
        border-color: mediumvioletred;
        color: #222;
        background-color: mediumvioletred;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .btn-default:hover,
    .btn-default:focus,
    .btn-default.focus,
    .btn-default:active,
    .btn-default.active,
    .open > .dropdown-toggle.btn-default {
        border-color: mediumvioletred;
        color: #222;
        background-color: mediumvioletred;
    }

</style>

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

            <li role="presentation" class="active"><a href=" <?php echo base_url('inversor'); ?> ">Ver todos los proyectos</a></li>
            <li role="presentation"><a href=" <?php echo base_url('proyectospagos'); ?> ">Proyectos consultados</a></li>
            <li role="presentation"><a href=" <?php echo base_url('micuentaI'); ?> ">Mi cuenta</a></li>

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
                            <img class="img-responsive" style="max-height: 200px; height: 200px;" src=" <?php echo base_url('/uploads/'.$p->previs); ?> " alt="">
                        </a>
                        <h3 style="color: mediumvioletred"><?php echo $p->nombre; ?></h3>
                        <p><?php echo substr($p->descripcion, 0, 110); ?>...</p>
                        <form class="form-inline" data-wow-offset="0" align="center">
                            <div class="form-group">
                                <a target="_blank" href="<?php echo base_url().'descripcion/'.$p->ID_proyecto; ?>" class="btn btn-primary" >Conocer más</a>
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