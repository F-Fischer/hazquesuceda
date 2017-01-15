<script src="<?= base_url('assets/js/jquery-2.2.1.min.js');?>"></script>
<div class="panel panel-default">
    <br>
    <br>
    <br>
    <div class="panel-heading">
        <h4 class="title" align="center">¡Bienvenido <?php echo $username; ?>!</h4>
    </div>

    <div class="panel-body">

            <div>
                <h3>
                    <font color="#FF6600">Proyectos registrados en la plataforma</font>
                </h3>
            </div>

            <br>
            <br>

            <div>
                <label>Filtrar proyectos por estado: </label>
                <select id="comboEstados">
                    <option id="0" <!--onclick=getProyectoByEstado(0, $limit, $start)-->  Todos </option>
                    <?php

                    foreach($estados as $e)
                    {
                        echo '<option id=" '.$e->ID_estado.'" onclick="getProyectoByEstado ('.$e->ID_estado.', $limit, $start)"> '.$e->nombre.' </option>';
                    }

                    ?>

                </select>
            </div>

            <br>
            <br>

            <table id="table_id" class="table">
                <thead>
                <tr>
                    <th>Num.</th>
                    <th>ID</th>
                    <th>Título</th>
                    <th>ID Autor</th>
                    <th>Nombre Autor</th>
                    <th>Apellido Autor</th>
                    <th>Estado</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php

                $cont = 0;
                foreach($proyectos as $p)
                {
                    $cont++;
                    echo
                        '<tr>'.
                        '<td>'.$cont.'</td>'.
                        '<td>'.$p->ID_proyecto.'</td>'.
                        '<td>'.$p->proy_nombre.'</td>'.
                        '<td>'.$p->user_id.'</td>'.
                        '<td>'.$p->nombre.'</td>'.
                        '<td>'.$p->apellido.'</td>'.
                        '<td>'.$p->nombre_estad.'</td>'.
                        '<td type="date">'.$p->fecha_alta.'</td>'.
                        '<td> <button type="button">accion 1</button> </td>'.
                        '<td> <button type="button">accion 2</button> </td>'.
                        '<td> <button type="button">accion 3</button> </td>'.
                        '<tr>';
                }

                ?>

                </tbody>
            </table>

            <br />

    </div>


</div>

<!--<script src="<?= " "; //base_url('assets/js/jquery.min.js'); ?>"></script>->
<script src="<?= base_url('assets/js/jquery.dataTables.min.js');?>"></script>

<script type="application/javascript">
    $(document).ready( function () {

       $('#table_id').DataTable({
            //scrollY: 400
        });
    } );
</script>


