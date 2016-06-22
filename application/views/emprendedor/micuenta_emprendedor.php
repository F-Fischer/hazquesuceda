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

                            <tr><td>Apodo</td><td><?php echo $micuenta[0]->user_name; ?></td><td>Edit</td></tr>
                            <tr><td>Clave</td><td>********</td><td>Edit</td></tr>
                            <tr><td>Nombre</td><td><?php echo $micuenta[0]->nombre;?></td><td>Edit</td></tr>
                            <tr><td>Apellido</td><td><?php echo $micuenta[0]->apellido;?></td><td>Edit</td></tr>
                            <tr><td>E-mail</td><td><?php echo $micuenta[0]->mail;?></td><td>Edit</td></tr>
                            <tr><td>Telefono</td><td><?php echo $micuenta[0]->telefono;?></td><td>Edit</td></tr>

                        </table>
                    </div>
                </div>

            </div>

        </div>


    </div>

</div>
