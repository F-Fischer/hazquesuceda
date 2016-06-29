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

            <li role="presentation"><a href="http://localhost/hazquesuceda/emprendedor">Ver todos los proyectos</a></li>
            <li role="presentation"><a href="http://localhost/hazquesuceda/crearproyecto">Crear proyecto</a></li>
            <li role="presentation"><a href="http://localhost/hazquesuceda/misproyectos">Ver todos mis proyectos</a></li>
            <li role="presentation" class="active"><a href="http://localhost/hazquesuceda/micuenta">Mi cuenta</a></li>

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
                                <td>Clave</td><td type="password"><?php echo $micuenta[0]->contrasena; ?></td>
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
                                <td> No puede editarse </td>
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
        <?php echo form_open('emprendedorcontroller/editarnombre'); ?>
        <input type="text" name="nuevo_nombre" class="form-control input-lg-12" placeholder="Ingrese el nuevo nombre" >
        <br>
        <div align="center">
            <input type="submit" class="btn btn-default" value="Actualizar"/>
        </div>
        </form>
    </div>

    <div id="popover-content-apellido" class="hide col-md-12">
        <?php echo form_open('emprendedorcontroller/editarapellido'); ?>
        <input type="text" name="nuevo_apellido" class="form-control input-lg-12" placeholder="Ingrese el nuevo apellido" >
        <br>
        <div align="center">
            <input type="submit" class="btn btn-default" value="Actualizar"/>
        </div>
        </form>
    </div>

    <div id="popover-content-contrasena" class="hide col-md-12">
        <?php echo form_open('emprendedorcontroller/editarcontrasena'); ?>
        <input type="text" name="nueva_cont_1" class="form-control input-lg-12" placeholder="Ingrese la contraseña actual " >
        <br>
        <input type="text" name="nueva_cont_2" class="form-control input-lg-12" placeholder="Ingrese la nueva contraseña " >
        <br>
        <div align="center">
            <input type="submit" class="btn btn-default" value="Actualizar"/>
        </div>
        </form>
    </div>

    <div id="popover-content-telefono" class="hide col-md-12">
        <?php echo form_open('emprendedorcontroller/editartelefono'); ?>
        <input type="text" name="nuevo_telefono" class="form-control input-lg-12" placeholder="Ingrese el nuevo telefono " >
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


    <script>

        $('#popover-nombre').popover({
            html : true,
            content: function(value) {
                return $("#popover-content-nombre").html();
            }
        });

        $('#popover-apellido').popover({
            html : true,
            content: function(value) {
                return $("#popover-content-apellido").html();
            }
        });

        $('#popover-contrasena').popover({
            html : true,
            content: function(value) {
                return $("#popover-content-contrasena").html();
            }
        });

        $('#popover-telefono').popover({
            html : true,
            content: function(value) {
                return $("#popover-content-telefono").html();
            }
        });

    </script>


