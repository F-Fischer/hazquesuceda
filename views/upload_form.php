<html>
    <head>
        <title>Upload Form</title>
    </head>
    <body>
    <br>
    <br>

    <img src="<?php echo base_url('assets/img/banner_proyecto.jpg') ?>" class="img-responsive" align="center">
    <br>
        <div class="col-md-offset-4">
            <?php echo $error;?>

            <?php echo form_open_multipart('upload/do_upload');?>

            <label>Imagen 1:</label>
            <input type="file" multiple name="userfile[]" size="20" />
            <br />

            <label>Imagen 2:</label>
            <input type="file" multiple name="userfile[]" size="20" />
            <br />

            <label>Imagen 3:</label>
            <input type="file" multiple name="userfile[]" size="20" />
            <br />

            <label>Video:</label>
            <input type="file" multiple name="userfile[]" size="20" />
            <br />

            <label>Archivo pdf:</label>
            <input type="file" multiple name="userfile[]" size="20" />
            <br />

        </div>

            <div class="col-lg-8 col-lg-offset-2 text-center">
                <input type="submit" class="btn btn-default btn-xl wow tada" align="center" value="upload!" />
            </div>

            </form>
    </body>
</html>