<style>
    .banner {
        background-image: url("assets/img/admin.jpg");
    }

    .nav-pills > li.active > a, .nav-pills > li.active > a:focus {
        color: white;
        background-color: #129FEA;
    }

    .nav-pills > li.active > a:hover {
        background-color: #a07ab1;
        color:white;
    }

    a {
        color: #129FEA;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    a:hover,
    a:focus {
        color: #a07ab1;
    }

    .btn-primary {
        border-color: #129FEA;
        color: #fff;
        background-color: #129FEA;
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
        background-color: #129FEA;
        border-color: #129FEA
    }

    .pagination > li > a, .pagination > li > span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #129FEA;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd
    }

    hr {
        max-width: 50px;
        border-color: #129FEA;
        border-width: 3px;
    }

    .btn-default {
        border-color: #129FEA;
        color: #222;
        background-color: #129FEA;
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
        border-color: #129FEA;
        color: #222;
        background-color: #129FEA;
    }
</style>

<div class="container-fluid">

    <div class="highlight" align="center">
        <div class="col-lg-12 banner">
            <br>
            <br>
            <br>
            <br>
            <h1 class="page-header" style="font-size: 65px; color: white;">
                Newsletter al Emprendedor
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >
            <li role="presentation" ><a href="statistics">Estadísticas</a></li>
            <li role="presentation" ><a href="reports">Reportes custom</a></li>
            <li role="presentation" ><a href="admin">Todos los proyectos</a></li>
            <li role="presentation" ><a href="users">Usuarios</a></li>
            <li role="presentation" class="active" ><a href="newletterempr">Newsletter Emprendedor</a></li>
        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <br>
            <?php
            echo form_open('AdministradorController/newsletterEmprendedor');

            echo '<div class="form-group">'.form_label('Título del artículo: ').form_error('titulo', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'inputTitulo',
                'name' => 'titulo',
                'class' => 'form-control',
                'value' => set_value('titulo')
            );

            echo form_input($data).'</div>';

            echo '<div class="form-group">'.form_label('Descripción ').form_error('descripcion', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array (
                'id' => 'inputDescripcion',
                'name' => 'descripcion',
                'class' => 'form-control',
                'value' => set_value('descripcion')
            );

            echo form_textarea($data).'</div>';

            echo '<div class="form-group">'.form_error('rubro', '<div class="error" style="color:red; float: right;">', '</div>');

            $data = array(
                'id' => 'btnEnviarNewsletter',
                'class' => 'btn btn-default',
                'value' => 'Enviar newsletter',
            );

            echo '<br>'.form_submit($data,'Enviar newsletter');

            echo form_close();
            ?>

        </div>

    </div>
</div>
