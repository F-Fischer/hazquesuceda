<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">

<style>
    .banner {
        background-image: url("<?php echo base_url().'assets/img/emp.jpg'; ?>");
    }
</style>

<div class="container-fluid">

    <div class="highlight" align="center">

        <div class="col-lg-12 banner">
            <br>
            <br>
            <br>
            <br><h1 class="page-header" style="font-size: 65px; color: white;">Mis proyectos
                <br>
                <br>
            </h1>
        </div>

    </div>


    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked" >

            <li role="presentation"><a href="<?php echo base_url('emprendedor')?> ">Ver todos los proyectos</a></li>
            <li role="presentation"><a href="<?php echo base_url('crearproyecto')?>">Crear proyecto</a></li>
            <li role="presentation" class="active" ><a href="<?php echo base_url('misproyectos')?>">Ver todos mis proyectos</a></li>
            <li role="presentation"><a href="<?php echo base_url('micuentaE')?>">Mi cuenta</a></li>

        </ul>

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-body">

                <h4>No tienes proyectos propios todavía, deseas crear uno nuevo?</h4>
                <button type="button" class="btn btn-default" style="float:left">CREAR PROYECTO</button>

            </div>
        </div>

    </div>

</div>

<script>
    $(document).ready(function(){
        $('#proyectosPropios').DataTable();
    });
</script>
