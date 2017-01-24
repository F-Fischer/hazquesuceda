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
        $this->load->model('Usuario');
        $this->load->model('RubroInteres');
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

    public function recordatorioDeClausura()
    {
        $p = new Proyecto();
        $proyectos = $p->getAllProyectos();
        $dt2 = date('d');

        foreach ($proyectos as $proyecto)
        {
            $dt1 = $proyecto->fecha_baja;
            $dt1 = date('d', strtotime($dt1));

            if($dt1>$dt2)
            {
                $diasRestantes = $dt1 - $dt2;
            }
            else
            {
                $diasRestantes = 30 - ($dt2 - $dt1);
            }

            if(($diasRestantes == 5) || ($diasRestantes == 1))
            {
                $u = new Usuario();
                $usuario = $u->getUsuarioById($proyecto->ID_usuario_emprendedor);

                $this->send_email_recordatorio($usuario[0]->mail, $proyecto->nombre, $diasRestantes);
            }
        }

        echo 'recordatorios enviados';
    }

    public function send_email_recordatorio ($email, $nombre, $diasRestantes) {
        $to = $email;
        $subject = "Tu proyecto en Haz que suceda!";

        $message = "
                    <html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <div class=\"jumbotron\">
                              <h1>Recordatorio de Haz que suceda!</h1>
                              <p>
                                  Queremos recordarte que a tu proyecto <strong>" . $nombre. " </strong>
                                  le quedan tan solo <strong>" . $diasRestantes. " </strong> días restantes.
                              </p>
                              <br>
                              <label>¡Ingresa a la plataforma y renueva tu proyecto!</label>
                            </div>
                        </body>
                    </html>
                    ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <soporte@hazquesuceda.org>' . "\r\n";

        mail($to,$subject,$message,$headers);
    }

    public function newsletterInversor ()
    {
        $usuario = new Usuario();
        $usuarios = $usuario->getUsuariosPorRol(3);

        // para cada usuario inversor
        foreach ($usuarios as $u)
        {
            // busco los rubros que le interesan
            $rubro_interes = new RubroInteres();
            $rubros = $rubro_interes->getRubroInteresPorUsuario($u->ID_usuario);

            $proyecto = new Proyecto();
            $proyectos = array();

            // para cada uno de esos rubros...
            foreach ($rubros as $r)
            {
                if($r)
                {
                    // busco los proyectos que corresponden al mismo, y que estan activos
                    $p = $proyecto->getProyectosByRubro($r->ID_rubro, 3);

                    foreach ($p as $pp)
                    {
                        array_push($proyectos, $pp);
                    }
                }
            }

//            echo '=====>>>>>>> antes del sort ---- ';
//
//            foreach ($proyectos as $p)
//            {
//                echo $p->cant_visitas.' , ';
//            }
//
//            echo '=====>>>>>>> despues del sort ---- ';

            // ordeno los proyectos segun cantidad de visitas
            arsort($proyectos);

//            foreach ($proyectos as $p)
//            {
//                echo $p->cant_visitas.' , ';
//            }
            
            // le mando los 5 proyectos mas populares
            $proy_div = '<div>';

            $cont = 0;
            foreach ($proyectos as $p)
            {
                $proy_div = $proy_div.'<div><h3>'.$p->nombre.'</h3>'.'<p>'.$p->descripcion.'</p></div>';
                $cont++;

                if($cont >= 5)
                {
                    break;
                }
            }

            $proy_div = $proy_div.'</div>';
            $this->send_newsletter($u->mail, $proy_div);
        }

        echo 'newsletter enviados';
    }

    public function send_newsletter ($email, $div_proyectos) {
        $to = $email;
        $subject = "newsletter";

        $message = "
                    <html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <div class=\"jumbotron\">
                              <h1>Tu newsletter de Haz que suceda!</h1>
                              <p>
                                  Te traemos los proyectos más populares de nuestra plataforma,
                                  según los rubros que te interesan.
                              </p>
                              <br>
                              <label>Los proyectos más populares de este mes son...</label>
                              ". $div_proyectos ."
                            </div>
                        </body>
                    </html>
                    ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <soporte@hazquesuceda.org>' . "\r\n";

        mail($to,$subject,$message,$headers);
    }

}