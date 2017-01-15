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
            <h1 class="page-header" style="font-size: 65px;">Mi cuenta

                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation"><a href=" <?php echo base_url('inversor'); ?> ">Ver todos los proyectos</a></li>
            <li role="presentation"><a href=" <?php echo base_url('proyectospagos'); ?> ">Proyectos consultados</a></li>
            <li role="presentation" class="active" ><a href=" <?php echo base_url('micuentaI'); ?> ">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">

            <div class="panel-heading">

                <h2 class="panel-title">Datos personales</h2>

            </div>

            <div class="panel-body">

                <div class="col-md-8">
                    <div class="table table-hover">
                        <table class="table">

                            <tr>
                                <td>Username</td><td><?php echo $micuenta[0]->user_name; ?></td>
                                <td> No puede editarse </td>
                            </tr>
                            <tr>
                                <td>Clave</td><td> <?php for($i=0;$i<strlen($micuenta[0]->contrasena);$i++){ echo '*';} ?> </td>
                                <td><a id="popover-contrasena"> Editar </a></td>
                            </tr>
                            <tr>
                                <td>Nombre</td><td id="nombre"><?php echo $micuenta[0]->nombre;?></td>
                                <td><a id="popover-nombre"> Editar </a></td>
                            </tr>
                            <tr>
                                <td>Apellido</td><td><?php echo $micuenta[0]->apellido;?></td>
                                <td><a id="popover-apellido" > Editar </a></td>
                            </tr>
                            <tr>
                                <td>E-mail</td><td><?php echo $micuenta[0]->mail;?></td>
                                <td><a id="popover-mail" > Editar </a></td>
                            </tr>
                            <tr>
                                <td>Telefono</td><td><?php echo $micuenta[0]->telefono;?></td>
                                <td><a id="popover-telefono" > Editar </a></td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<div id="popover-content-nombre" class="hide col-md-12">
    <?php echo form_open('inversor/editarnombre'); ?>
    <input type="text" name="nuevo_nombre" class="form-control input-lg-12" placeholder="Ingrese el nuevo nombre" >
    <br>
    <div align="center">
        <input type="submit" class="btn btn-default" value="Actualizar"/>
    </div>
    </form>
</div>

<div id="popover-content-apellido" class="hide col-md-12">
    <?php echo form_open('inversor/editarapellido'); ?>
    <input type="text" name="nuevo_apellido" class="form-control input-lg-12" placeholder="Ingrese el nuevo apellido" >
    <br>
    <div align="center">
        <input type="submit" class="btn btn-default" value="Actualizar"/>
    </div>
    </form>
</div>

<div id="popover-content-contrasena" class="hide col-md-12">
    <?php echo validation_errors(); ?>
    <?php echo form_open('inversor/editarcontrasena'); ?>
    <input type="password" name="nueva_cont_1" class="form-control input-lg-12" placeholder="Ingrese la contraseña actual " >
    <br>
    <input type="password" name="nueva_cont_2" class="form-control input-lg-12" placeholder="Ingrese la nueva contraseña " >
    <br>
    <div align="center">
        <input type="submit" class="btn btn-default" value="Actualizar"/>
    </div>
    </form>
</div>

<div id="popover-content-telefono" class="hide col-md-12">
    <?php echo form_open('inversor/editartelefono'); ?>
    <input type="text" name="nuevo_telefono" class="form-control input-lg-12" placeholder="Ingrese el nuevo telefono " >
    <br>
    <div align="center">
        <input type="submit" class="btn btn-default" value="Actualizar"/>
    </div>
    </form>
</div>

<div id="popover-content-mail" class="hide col-md-12">
    <?php echo validation_errors(); ?>
    <?php echo form_open('inversor/editarmail'); ?>
    <input type="text" name="nuevo_mail" class="form-control input-lg-12" placeholder="Ingrese la nueva dirección de correo " >
    <br>
    <div align="center">
        <input type="submit" class="btn btn-default" value="Actualizar"/>
    </div>
    </form>
</div>


<!-- jQuery -->
<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo base_url('assets/js/jquery.easing.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fittext.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/wow.min.js'); ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('assets/js/creative.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/usuario/micuenta.js'); ?>"></script>


