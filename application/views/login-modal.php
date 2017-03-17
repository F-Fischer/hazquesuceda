<div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" href="<?php echo base_url('login-modal'); ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Inicia sesión</h4>
                </div>
                <?php echo validation_errors(); ?>
                <?php echo form_open('login'); ?>
                <div class="modal-body">
                    <label for="username">Usuario:</label>
                    <input type="text" name="username" id="username" class="form-control input-lg-12" placeholder="Usuario" tabindex="1">
                    <br/>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control input-lg-12" placeholder="Contraseña" tabindex="1">
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal">Volver</a>
                    <input type="submit" class="btn btn-default wow tada" value="Vamos!"/>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>