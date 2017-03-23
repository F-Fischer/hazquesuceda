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
        $this->load->model('Pago');
        $this->load->model('ErrorPropio');
        $this->load->library('session');
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

                    if($p)
                    {
                        foreach ($p as $pp)
                        {
                            array_push($proyectos, $pp);
                        }
                    }
                }
            }

            // ordeno los proyectos segun cantidad de visitas
            arsort($proyectos);
            
            // le mando los 5 proyectos mas populares
            $proy_div = '';

            $cont = 0;
            foreach ($proyectos as $p)
            {
                $proy_div = $proy_div.'
                    <tr>
                    <td align="center" valign="top" style="padding: 0 0 25px 0; font-family: Open Sans, Helvetica, Arial, sans-serif;">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td align="center" bgcolor="#ffffff" style="border-radius: 3px 3px 0 0;">
                                <img src="'.base_url().'/uploads/'.$p->previs.'" width="480" height="160" alt="insert alt text here" style="display: block; border-radius: 3px 3px 0 0; font-family: sans-serif; font-size: 16px; color: #999999;" class="img-max"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="#ffffff" style="border-radius: 0 0 3px 3px; padding: 20px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif;">
                                            <h2 style="font-size: 20px; color: #444444; margin: 0; padding-bottom: 10px;">'.$p->nombre.'</h2>
                                            <p style="color: #999999; font-size: 16px; line-height: 24px; margin: 0;">
                                              '.substr($p->descripcion, 0, 200).'...
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="padding: 30px 0 0 0;">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center" style="border-radius: 26px;" bgcolor="#75b6c9">
                                                        <a href="'.base_url().'descripcion/'.$p->ID_proyecto.'" target="_blank" style="font-size: 16px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 26px; background-color: #e60000; padding: 14px 26px; border: 1px solid #e60000; display: block;">Conocer mas &rarr;</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>';

                $cont++;

                if($cont >= 5)
                {
                    break;
                }
            }

            $this->send_newsletter($u->mail, $proy_div);
        }

        echo 'newsletter enviados';
    }

    public function send_newsletter ($email, $div_proyectos) {
        $to = $email;
        $subject = "newsletter";

        $message = "<!doctype html>
                    <html>
                    <head>
                    <title></title>
                    <style type=\"text/css\">
                    /* CLIENT-SPECIFIC STYLES */
                    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                    img { -ms-interpolation-mode: bicubic; }

                    /* RESET STYLES */
                    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
                    table { border-collapse: collapse !important; }
                    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

                    /* iOS BLUE LINKS */
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }

                    /* MOBILE STYLES */
                    @media screen and (max-width: 480px) {
                      .img-max {
                        width: 100% !important;
                        max-width: 100% !important;
                        height: auto !important;
                      }

                      .max-width {
                        max-width: 100% !important;
                      }

                      .mobile-wrapper {
                        width: 85% !important;
                        max-width: 85% !important;
                      }

                      .mobile-padding {
                        padding-left: 5% !important;
                        padding-right: 5% !important;
                      }
                    }

                    /* ANDROID CENTER FIX */
                    div[style*=\"margin: 16px 0;\"] { margin: 0 !important; }
                    </style>
                    </head>
                    <body style=\"margin: 0 !important; padding: 0; !important background-color: #ffffff;\" bgcolor=\"#ffffff\">

                    <!-- HIDDEN PREHEADER TEXT -->
                    <div style=\"display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;\">
                        Haz que suceda!
                    </div>

                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                        <tr>
                            <td align=\"center\" valign=\"top\" width=\"100%\" background='' bgcolor=\"#ffbf80\" style=\"background: #ffbf80 url(''); background-size: cover; padding: 50px 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"mobile-wrapper\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 20px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png' width=\"300\" height=\"300\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0; font-family: Open Sans, Helvetica, Arial, sans-serif;\">
                                            <p style=\"color: black; font-size: 20px; line-height: 28px; margin: 0;\">
                                              Te traemos tu newsletter mensual, con proyectos que creemos te van a interesar...
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" height=\"100%\" valign=\"top\" width=\"100%\" bgcolor=\"#f6f6f6\" style=\"padding: 50px 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"mobile-wrapper\">

                                <!-- CUERPO, LISTADO DE PROYECTOS -->

                                ". $div_proyectos ."

                                <!-- FOOTER -->

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" height=\"100%\" valign=\"top\" width=\"100%\" bgcolor=\"#f6f6f6\" style=\"padding: 0 15px 40px 15px;\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"mobile-wrapper\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 5px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png'  width=\"100\" height=\"100\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #999999;\">
                                            <p style=\"font-size: 14px; line-height: 20px;\">
                                                Cordoba, Argentina
                                              <br><br>

                                              <a href=\"http://hazquesuceda.org\" style=\"color: #999999;\" target=\"_blank\">View Online</a>
                                              &nbsp; &bull; &nbsp;
                                              <a href=\"http://hazquesuceda.org\" style=\"color: #999999;\" target=\"_blank\">Unsubscribe</a>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

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

    public function borrarProyectos()
    {
        $p = new Proyecto();
        $proyectos = $p->getProyectosFinalizados();

        $date = date('Y-m-d');
        $date = strtotime("-1 year", strtotime($date));
        $final = date("Y-m-d", $date);

        if($proyectos)
        {
            foreach ($proyectos as $proyecto)
            {
                if($proyecto->fecha_baja == $final)
                {
                    $p->borrarProyecto($proyecto->ID_proyecto);
                }
            }
        }

        echo 'estado de proyectos actualizados';
    }

    public function informacionInversor()
    {
        if($this->session->userdata('logged_in'))
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];
            $inversor = new Usuario();
            $id_inversor = $inversor->getIdByUsername($data['username']);
            $idProyecto = $this->uri->segment(2);
            $idMP = $this->uri->segment(3);

            $date = new DateTime();
            $hoy = $date->format('Y-m-d');

            $pago = new Pago();
            $pago->generarPago($id_inversor, $hoy, $idProyecto, $idMP);

            if ($pago->registrarPago())
            {
                redirect('proyectospagos', 'refresh');
            }
            else
            {
                $error = new ErrorPropio();
                $error->Error_bd();
            }
        }
        else
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
    }

}