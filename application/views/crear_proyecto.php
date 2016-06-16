<div class="container-fluid">

    <div class="highlight" align="center">
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-size: 65px;">Crear proyecto
                <br>
                <br>
            </h1>
        </div>

    </div>

    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation" ><a href="emprendedor">Ver todos los proyectos</a></li>
            <li role="presentation" class="active"><a href="crearproyecto">Crear proyecto</a></li>
            <li role="presentation"><a href="misproyectos">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href="micuenta">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-md-6">

                    <form>
                        <div class="form-group ">
                            <label for="inputTitulo">Título del proyecto</label>
                            <input type="text" class="form-control" id="inputTitulo" placeholder="Ingrese el título del proyecto">
                        </div>
                        <div class="form-group ">
                                <label for="inputDescripcion">Descripción</label>
                                <textarea class="form-control" rows="5" id="inputDescripcion"></textarea>
                            </div>

                        <label >Archivos</label>
                        <div class="form-group">
                            <label for="inputFileVideo">Video</label>
                            <input type="file" id="inputFileVideo">
                            <p class="help-block">Seleccione un video</p>
                        </div>
                        <div class="form-group">
                            <label for="inputFileImg1">Imagen 1</label>
                            <input type="file" id="inputFileImg1">
                            <p class="help-block">Seleccione una imagen</p>
                        </div>
                        <div class="form-group">
                            <label for="inputFileImg2">Imagen 2</label>
                            <input type="file" id="inputFileImg2">
                            <p class="help-block">Seleccione una imagen</p>
                        </div>
                        <div class="form-group">
                            <label for="inputFileImg3">Imagen 3</label>
                            <input type="file" id="inputFileImg3">
                            <p class="help-block">Seleccione una imagen</p>
                        </div>
                        <div class="form-group">
                            <label for="inputFilePDF">PDF</label>
                            <input type="file" id="inputFilePDF">
                            <p class="help-block">Seleccione un archivo PDF</p>
                        </div>

                        <div class="form-group">
                            <label>Rubro</label>
                            <br>
                            <select id="comboRubros" class="col-md-3" class="form-control">
                                <?php
                                foreach($rubros as $rubro)
                                    echo '<option value="'.$rubro->ID_rubro.'">'.$rubro->nombre.'</option>'
                                ?>
                            </select>
                            <br>
                        </div>

                        <button type="submit" class="btn btn-default">Crear proyecto</button>
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>
