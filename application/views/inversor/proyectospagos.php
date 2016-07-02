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

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
<div class="container-fluid">
    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Proyectos pagos
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation"><a href=" <?php echo base_url('inversor'); ?> ">Ver todos los proyectos</a></li>
            <li role="presentation" class="active"><a href=" <?php echo base_url('proyectospagos'); ?> ">Proyectos consultados</a></li>
            <li role="presentation"><a href=" <?php echo base_url('micuentaI'); ?> ">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <?php
        $i = 0;
        foreach($proyectos as $p)
        { ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $p->nombre; ?></h3>
            </div>
            <div class="panel-body">
                <h5><strong>Id Proyecto:</strong> <?php echo $p->ID_proyecto; ?></h5>
                <h5><strong>Nombre:</strong> <?php echo $p->nombre; ?></h5>
                <h5><strong>Descripcion:</strong> <?php echo $p->descripcion; ?></h5>
                <h5><strong>Rubro:</strong> <?php echo $p->rubro; ?></h5>
                <h5><strong>PDF:</strong> <?php if($p->pdf){ echo '<a target="_blank" href="'.base_url().'uploads/'.$p->pdf->pdf.'">click aquí</a>'; } else { echo 'no posee.'; }  ?></h5>
                <h5><strong>Video:</strong> <?php if($p->video){ echo '<a target="_blank" href="https://www.youtube.com/watch?v='.$p->video->video.'">click aquí</a>'; } else { echo 'no posee.'; }  ?></h5>
                <h5><strong>Fecha de pago:</strong> <?php echo $p->fecha_pago; ?></h5>
                <h5><strong>Emprendedor responsable:</strong> <?php echo $p->apellido_emprendedor.', '.$p->nombre_emprendedor; ?></h5>
                <h5><strong>Teléfono:</strong> <?php echo $p->tel_emprendedor; ?></h5>
                <h5><strong>E-mail:</strong> <?php echo $p->mail_emprendedor; ?></h5>
                <h5><strong>Username:</strong> <?php echo $p->username_emprendedor; ?></h5>
            </div>
        </div>

        <?php
        $i++;
        }?>

    </div>

</div>

<script>
    $(document).ready(function(){
        $('#proyectosPagos').DataTable();
    });
</script>
