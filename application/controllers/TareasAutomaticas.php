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
        $this->load->model('proyecto');
    }

    public function clausurarProyectosDelDia()
    {
        $p = new Proyecto();
        $proyectos = $p->getAllProyectos();
        $date = new DateTime(); //this returns the current date time
        $hoy = $date->format('Y-m-d-H-i-s');

        echo $proyectos[0]->getFechaBaja();

//        foreach ($proyectos as $proyecto)
//        {
//            echo $proyecto->fecha_baja;
////            if($proyecto->fecha_baja == $hoy)
////            {
////                $proyecto->clausurarProyecto($proyecto->ID_proyecto);
////            }
//        }

        //echo 'estado de proyectos actualizados';
    }

}