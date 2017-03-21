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
                $proy_div = $proy_div.'<tr>
						<td align="center" valign="center" width="50%" >
							<img src="'.base_url().'/uploads/'.$p->previs.'" alt="Responsive image" height="200" width="200">
						</td>
						<td align="center" valign="center" width="50%" >
							<h3 style="font-family: \'Courier New\', Courier, monospace;">'.$p->nombre.'</h3>
							<p style="font-family: \'Courier New\', Courier, monospace;">'.substr($p->descripcion, 0, 200).'</p>
							<a href="'.base_url().'descripcion/'.$p->ID_proyecto.'" role="button" style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">conocer mas</a>
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

        $message = "<html>
                    <div role=\"document\">

                        <!-- HEADER GRIS -->
                        <div style=\"margin:0; padding:0; width:100%!important\">
                            <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0\">
                                <tbody>
                                    <tr bgcolor=\"#D8D8D8\">
                                        <td align=\"center\" valign=\"top\" width=\"50%\" style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#dfa9ca;font-size:12px;line-height:50px;border-collapse:collapse;\">
                                            Haz que suceda!
                                        </td>

                                        <td align=\"center\" valign=\"top\" width=\"50%\" style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#dfa9ca;font-size:12px;line-height:50px;border-collapse:collapse;\">
                                            Newsletter
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- HEADER NARANJA -->
                        <div style=\"margin:0; padding:0; width:100%!important\">
                            <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0\">
                                <tbody>
                                    <tr bgcolor=\"#FF8000\">
                                        <td width=\"25%\"></td>
                                        <td align=\"center\" valign=\"top\" width=\"50%\" style=\"font-family: 'Copperplate','Copperplate Gothic Light',sans-serif;color:white;font-size:15px;line-height:100px;border-collapse:collapse;\">
                                            Te traemos tu newsletter de Haz que suceda!
                                        </td>
                                        <td width=\"25%\"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- CUERPO, LISTADO DE PROYECTOS -->
                        <div style=\"margin:0; padding:0; width:100%!important\">
                            <div>
                                <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0\">
                                    <tbody>
                                          ". $div_proyectos ."
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- FOOTER GRIS Y NARANJA -->
                        <div style=\"margin:0; padding:0; width:100%!important\" >
                            <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0\">
                                <tbody>
                                    <tr bgcolor=\"#D8D8D8\">
                                        <td align=\"center\" valign=\"top\" width=\"50%\" style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:white;font-size:20px;line-height:100px;border-collapse:collapse;\" > ... </td>
                                        <td align=\"center\" valign=\"top\" width=\"50%\" style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:white;font-size:20px;line-height:100px;border-collapse:collapse;\" > ... </td>
                                    </tr>
                                    <tr bgcolor=\"#FF8000\">
                                        <td align=\"center\" valign=\"top\" width=\"50%\" style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:white;font-size:20px;line-height:100px;border-collapse:collapse;\" > ... </td>
                                        <td align=\"center\" valign=\"top\" width=\"50%\" style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:white;font-size:20px;line-height:100px;border-collapse:collapse;\" > ... </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
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