<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 20/1/17
 * Time: 8:58 PM
 */
class TareasAutomaticas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Proyecto');
    }

    public function clausurarProyectosDelDia()
    {
        $p = new Proyecto();
        $proyectos = $p->getAllProyectos();
        $date = new DateTime();
        $hoy = $date->format('Y-m-d');

        foreach ($proyectos as $proyecto)
        {
            if($proyecto->fecha_baja == $hoy)
            {
                $p->clausurarProyecto($proyecto->ID_proyecto);
            }
        }

        echo 'estado de proyectos actualizados';
    }

}