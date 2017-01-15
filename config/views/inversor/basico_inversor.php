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
            <h1 class="page-header" style="font-size: 65px;">Basico, a editar
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

    </div>

</div>