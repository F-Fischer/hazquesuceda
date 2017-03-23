<div id="content">
    <style>
        .banner {
            background-image: url("assets/img/emp.jpg");
        }
    </style>
    <div class="container">
        <div class="highlight" align="center">
            <div class="col-lg-12 banner">
                <br>
                <br>
                <br>
                <br><h1 class="page-header" style="font-size: 65px;">Editar proyecto...
                    <br>
                    <br>
                </h1>
            </div>
        </div>
        <div>
            <div class="col-md-12">


                    <div class="form-group">
                        <!--<label>Título del proyecto</label>
                        <input type="text" name="nombre" value="<?php /*echo $proyecto->nombre; */?>" id="inputNombre" class="form-control">
                        -->
                        <?php
                            echo form_open('ProyectoController/do_update_title'.'/'.$proyecto->ID_proyecto);
                            echo '<label>Título del proyecto</label>';
                            echo '<input type="text" name="nombre" value="'.$proyecto->nombre.'" id="inputNombre" class="form-control"><br/>';
                            echo "<input type='submit' class='btn btn-default' name='submit' value='Editar' /> ";
                            echo form_close();
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                            echo form_open('ProyectoController/do_update_desc'.'/'.$proyecto->ID_proyecto);
                            echo '<label>Descripción</label>';
                            echo '<textarea name="descripcion"  cols="40" rows="10" id="inputDescripcion" class="form-control">'.$proyecto->descripcion.'</textarea><br/>';
                            echo "<input type='submit' class='btn btn-default' name='submit' value='Editar' /> ";
                            echo form_close();
                        ?>
                    </div>

                    <div class="form-group">
                        <label>PDF</label>
                        <?php
                            echo form_open_multipart('ProyectoController/do_update_pdf'.'/'.$proyecto->ID_proyecto);

                            echo "<input type='file' id='pdf' name='userfile' size='20' />";
                            echo "<br>";
                            echo "<input type='submit' id='uploadPDF' class='btn btn-default' name='submit' value='Cargar' /> ";

                            echo form_close();
                        ?>
                        <?php
                        if($pdf)
                        {
                            echo '<h4><a style="color: #3284b7" target="_blank" href="'.base_url('/uploads/'.$pdf->pdf).'">Archivo PDF</a></h4>';
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Imagenes</label>
                        <div class="row">
                            <?php

                            for ($i = 0; $i< $cant_img; $i++)
                            {
                                echo '<div class="col-lg-4 col-sm-6" align="center">';
                                echo    '<div class="thumbnail">';
                                echo        '<a href="#">';
                                echo            '<img class="img-responsive" style="max-height: 200px; height: 200px;" src="'.base_url('/uploads/'.$imgs[$i]->path).'" alt="">';
                                echo        '</a>';
                                echo    form_open_multipart('ProyectoController/do_update_img'.'/'.$proyecto->ID_proyecto.'/'.$imgs[$i]->path);
                                echo        '<div class="form-group">';
                                echo        '<br/>';
                                echo        '<input type=\'file\' id=\'pdf\' name=\''.$imgs[$i]->path.'\' size=\'20\' /><input type=\'submit\' value="Actualizar" class=\'btn btn-default\' name=\'Cargar\'  />';
                                echo        '<br/>';
                                echo        '</div>';
                                echo    form_close();
                                echo    '</div>';
                                echo '</div>';
                            }

                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Video</label>

                        <?php

                        if($proyecto->youtube === NULL)
                        {
                            echo '<h3>Usted no posee nigún video</h3><br /><input type="text" name="nombre" value="" id="inputNoVideo" class="form-control">';
                        }
                        else
                        {
                            $yturl = "https://www.youtube.com/watch?v=";

                            echo form_open('ProyectoController/do_update_video'.'/'.$proyecto->ID_proyecto);
                            echo '<input type="text" name="video" value="'.$yturl.''.$proyecto->youtube.'" id="inputVideo" class="form-control">';
                            echo "<br/><input type='submit' class='btn btn-default' name='submit' value='Editar' /> ";
                            echo '<br /><br /><br />
                                    <div>
                                        <div id="video" class="col-lg-8">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/'.$proyecto->youtube.'" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>';
                            echo form_close();
                        }
                        ?>
                    </div>
                    <br />

            </div>

        </div>
    </div>
</div>
