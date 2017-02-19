<br>
<br>
<br>
<br>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">


            <table id="table_id" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>ID Autor</th>
                    <th>Nombre Autor</th>
                    <th>Apellido Autor</th>
                    <th>Estado</th>
                    <th>Fecha de creación</th>
                </tr>
                </thead>
                <tbody>

                <?php

                foreach($proyectos as $p)
                {
                    echo
                        '<tr>'.
                        '<td>'.$p->ID_proyecto.'</td>'.
                        '<td>'.$p->proy_nombre.'</td>'.
                        '<td>'.$p->user_id.'</td>'.
                        '<td>'.$p->nombre.'</td>'.
                        '<td>'.$p->apellido.'</td>'.
                        '<td>'.$p->nombre_estad.'</td>'.
                        '<td>'.$p->fecha_alta.'</td>'.
                        '<tr>';
                }

                ?>

                </tbody>
            </table>

        </div>
    </div>
</div>


<script type="text/javascript" charset="utf8" src="jquery-2.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">

<script type="text/javascript" charset="utf8" src="jquery.dataTables.min.js"></script>

<script type="application/javascript">
    $( document ).ready(function() {

        $('#table_id').DataTable({

        });
    });
</script>