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

                $this->send_email($usuario[0]->mail, $proyecto->nombre, $diasRestantes);
            }
        }

        echo 'recordatorios enviados';
    }

    public function send_email($email, $nombre, $diasRestantes) {
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

}