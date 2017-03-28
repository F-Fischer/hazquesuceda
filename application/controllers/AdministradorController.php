<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 5/30/2016
 * Time: 6:34 PM
 */
class AdministradorController extends CI_Controller
{
    function __construct ()
    {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->model('Emprendedor');
        $this->load->model('Usuario');
        $this->load->model('Rubro');
        $this->load->model('RubroInteres');
        $this->load->model('Rol');
        $this->load->model('Provincia');
        $this->load->model('ErrorPropio');
        $this->load->model('Permisos');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function validateUrl()
    {
        $username = $this->session->userdata['logged_in']['username'];
        $data['username'] = $username;
        $url = $this->uri->segment(1);

        $u = new Usuario();
        $usuario = $u->getRolByUsername($username);
        $rol = $usuario[0]->ID_rol;

        $p = new Permisos();
        $permiso = $p->getPermiso($rol, $url);

        if($permiso)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function index()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        if($this->validateUrl())
        {
            $p = new Proyecto();
            $data['proyectos'] = $p->getAllProyectosAdmin();

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/basico_administrador',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
    }
    
    public function users()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        if($this->validateUrl())
        {
            $u = new Usuario();
            $data['users'] = $u->getAllUsers();

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_usuarios',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
    }
    
    public function aceptarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');
        $p = new Proyecto();

        if($p->activarProyecto($idProyecto))
        {
            $data = array(
                'status' => true,
                'message' => 'Se activo proyecto'
            );
        }
        else
        {
            $data = array(
                'status' => false,
                'message' => 'El proyecto '.$idProyecto.' no puede ser activado'
            );
        }

        echo json_encode($data);

        if($data["status"])
        {
            $proyecto = $p->getProyectoByIdBasico($idProyecto);

            $usuario = new Usuario();
            $u = $usuario->getUsuarioById($proyecto[0]->ID_usuario_emprendedor);

            $this->send_email_proyecto_activo($u[0]->mail, $proyecto[0]->nombre);
        }
    }

    public function clausurarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');
        $p = new Proyecto();

        if($p->clausurarProyecto($idProyecto))
        {
            $data = array(
                'status' => true,
                'message' => 'Se clausuro proyecto'
            );
        }
        else
        {
            $data = array(
                'status' => false,
                'message' => 'El proyecto '.$idProyecto.' no puede ser clausurado'
            );
        }

        echo json_encode($data);

        if($data["status"])
        {
            $proyecto = $p->getProyectoByIdBasico($idProyecto);

            $usuario = new Usuario();
            $u = $usuario->getUsuarioById($proyecto[0]->ID_usuario_emprendedor);

            $this->send_email_proyecto_rechazado($u[0]->mail, $proyecto[0]->nombre);
        }
    }

    public function rechazarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');
        $p = new Proyecto();

        if($p->rechazarProyecto($idProyecto))
        {
            $data = array(
                'status' => true,
                'message' => 'Se rechazo proyecto'
            );
        }
        else
        {
            $data = array(
                'status' => false,
                'message' => 'El proyecto '.$idProyecto.' no puede ser rechazado'
            );
        }

        echo json_encode($data);

        if($data["status"])
        {
            $proyecto = $p->getProyectoByIdBasico($idProyecto);

            $usuario = new Usuario();
            $u = $usuario->getUsuarioById($proyecto[0]->ID_usuario_emprendedor);

            $this->send_email_proyecto_rechazado($u[0]->mail, $proyecto[0]->nombre);
        }
    }

    public function inhabilitarUsuario () 
    {
        $idUsuario = $this->input->get('idUsuario'); 
        $u = new Usuario();
        
        if($u->inhabilitarUsuario($idUsuario))
        {
            $data = array(
                'status' => true,
                'message' => 'Se inhabilito usuario'
            );
        }
        else
        {
            $data = array(
                'status' => false,
                'message' => 'El usuario '.$idUsuario.' no puede ser inhabilitado'
            );
        }

        echo json_encode($data);

        if($data["status"])
        {
            $user = $u->getUsuarioById($idUsuario);
            $this->send_email_usuario_inhabilitado($user[0]->mail);
        }
    }

    public function send_email_usuario_inhabilitado ($email) {
        $to = $email;
        $subject = "Su cuenta de haz que suceda!";

        $message = "
                    <html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <div class=\"jumbotron\">
                              <h1>Que pena!</h1>
                              <p>
                                  Hemos detectuado un problema con su cuenta. La misma 
                                  ha sido inhabilitada por no cumplir con los requisitos de HQS.
                              </p>
                              <label>Por favor contáctese con nosotros!</label>
                              <p>
                                  El equipo de Haz que suceda!
                              </p>
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

    public function send_email_proyecto_activo ($email, $nombre) {

        $to = $email;
        $subject = "Tu proyecto en Haz que suceda!";

        $message = "
                    <!doctype html>
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

                      .full-width {
                        width: 100% !important;
                      }
                    }

                    /* ANDROID CENTER FIX */
                    div[style*=\"margin: 16px 0;\"] { margin: 0 !important; }
                    </style>
                    </head>
                    <body style=\"margin: 0 !important; padding: 0; !important background-color: #ffffff;\" bgcolor=\"#ffffff\">

                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                        <tr>
                            <td align=\"center\" valign=\"top\" width=\"100%\" background=\"images/bg.jpg\" bgcolor=\"#B74215\" style=\"background: #B74215 url('images/bg.jpg'); background-size: cover; padding: 35px 15px 0 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"full-width\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 50px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png' width=\"50\" height=\"50\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 20px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png' width=\"300\" height=\"300\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" height=\"100%\" valign=\"top\" width=\"100%\" bgcolor=\"#f6f6f6\" style=\"padding: 0 15px 50px 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"full-width\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 25px 0; font-family: Open Sans, Helvetica, Arial, sans-serif;\">
                                            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
                                                <tr>
                                                    <td align=\"center\" bgcolor=\"#ffffff\" style=\"border-radius: 0 0 3px 3px; padding: 25px;\">
                                                        <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
                                                            <tr>
                                                                <td align=\"center\" style=\"font-family: Open Sans, Helvetica, Arial, sans-serif;\">
                                                                    <h2 style=\"font-size: 28px; color: #444444; margin: 0; padding-bottom: 10px;\">Felicitaciones!</h2>
                                                                    <p style=\"color: #999999; font-size: 16px; line-height: 24px; margin: 0;\">
                                                                      Nuestro administrador ha aprobado tu proyecto <strong>" . $nombre. " </strong>.
                                                                      Nuestros inversores ya pueden verlo.
                                                                    </p>
                                                                    <br />
                                                                    <label> ¡Exitos a ti y a tu proyecto! </label>
                                                                    <p style=\"color: #999999; font-size: 16px; line-height: 24px; margin: 0;\">
                                                                       Gracias por confiar en nosotros.
                                                                       <br />
                                                                       El equipo de Haz que suceda!
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align=\"center\" style=\"padding: 30px 0 0 0;\">
                                                                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                                                        <tr>
                                                                            <td align=\"center\" style=\"border-radius: 26px;\" bgcolor=\"#75b6c9\">
                                                                                <a href=\"https://www.hazquesuceda.org\" target=\"_blank\" style=\"font-size: 16px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 26px; background-color: #B72F20; padding: 14px 26px; border: 1px solid #B72F20; display: block;\">Read more &rarr;</a>
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
                                    </tr>
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

    public function send_email_proyecto_rechazado ($email, $nombre) {

        $to = $email;
        $subject = "Tu proyecto en Haz que suceda!";

        $message = "
                    <!doctype html>
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

                      .full-width {
                        width: 100% !important;
                      }
                    }

                    /* ANDROID CENTER FIX */
                    div[style*=\"margin: 16px 0;\"] { margin: 0 !important; }
                    </style>
                    </head>
                    <body style=\"margin: 0 !important; padding: 0; !important background-color: #ffffff;\" bgcolor=\"#ffffff\">

                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                        <tr>
                            <td align=\"center\" valign=\"top\" width=\"100%\" background=\"images/bg.jpg\" bgcolor=\"#B74215\" style=\"background: #B74215 url('images/bg.jpg'); background-size: cover; padding: 35px 15px 0 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"full-width\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 50px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png' width=\"50\" height=\"50\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 20px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png' width=\"300\" height=\"300\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" height=\"100%\" valign=\"top\" width=\"100%\" bgcolor=\"#f6f6f6\" style=\"padding: 0 15px 50px 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"full-width\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 25px 0; font-family: Open Sans, Helvetica, Arial, sans-serif;\">
                                            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
                                                <tr>
                                                    <td align=\"center\" bgcolor=\"#ffffff\" style=\"border-radius: 0 0 3px 3px; padding: 25px;\">
                                                        <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
                                                            <tr>
                                                                <td align=\"center\" style=\"font-family: Open Sans, Helvetica, Arial, sans-serif;\">
                                                                    <h2 style=\"font-size: 28px; color: #444444; margin: 0; padding-bottom: 10px;\">UPS!</h2>
                                                                    <p style=\"color: #999999; font-size: 16px; line-height: 24px; margin: 0;\">
                                                                      Nuestro administrador leyó tu proyecto <strong>" . $nombre. " </strong>., pero detectó un problema con el mismo, por lo cual el mismo fue rechazado.
                                                                      Esto significa que aún no es visible en Haz que suceda!. Pero no implica que no pueda serlo a futuro. Checkea su informacióna
                                                                      y nuestras políticas hacerca de proyectos. Crea una nueva versión del mismo y envíala.
                                                                    </p>
                                                                    <br />
                                                                    <label> Suerte con eso! </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align=\"center\" style=\"padding: 30px 0 0 0;\">
                                                                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                                                        <tr>
                                                                            <td align=\"center\" style=\"border-radius: 26px;\" bgcolor=\"#75b6c9\">
                                                                                <a href=\"https://www.hazquesuceda.org\" target=\"_blank\" style=\"font-size: 16px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 26px; background-color: #B72F20; padding: 14px 26px; border: 1px solid #B72F20; display: block;\">Read more &rarr;</a>
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
                                    </tr>
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

    public function statistics ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        if($this->validateUrl())
        {
            $u = new Usuario();

            //TOP 5 MAS PAGADOS
            $p = new Proyecto();
            $proyectos = $p->getTopCinco('asc');
            $data['top_asc'] = $proyectos;

            //TOP 5 MENOS PAGADOS
            $proyectos = $p->getTopCincoDown();
            $data['top_desc'] = $proyectos;

            // PROYECTOS
            $r = new Rubro();
            $rubros = $r->getRubros();
            $array_proyectos[0] = array('Rubro','Cantidad');

            $i = 1;
            foreach ($rubros as $rubro)
            {
                $p = new Proyecto();
                $proyectos = $p->getProyectosByRubro($rubro->ID_rubro, 3);
                $cant = count($proyectos);

                $array_proyectos[$i] = array(($rubro->nombre), (int) $cant);
                $i++;
            }

            $data['array_proyectos'] = $array_proyectos;

            // USUARIOS
            $u = new Usuario();
            $array_usuarios[0] = array('Tipo','Cantidad');
            $r = new Rol();
            $roles = $r->getRoles();

            $i = 1;
            foreach ($roles as $rol)
            {
                $usuarios = $u->getUsuariosPorRol($i);
                $cant = count($usuarios);

                $array_usuarios[$i] = array(($rol->nombre), (int) $cant);
                $i++;
            }

            $data['array_usuarios'] = $array_usuarios;

            // POPULARIDAD DE RUBROS
            $r = new Rubro();
            $rubros = $r->getRubros();
            $array_popularidad[0] = array();

            $i = 1;
            foreach ($rubros as $rubro)
            {
                $ri = new RubroInteres();
                $interes = $ri->getRubroInteres($rubro->ID_rubro);

                if($interes)
                {
                    $cant = count($interes);
                }
                else
                {
                    $cant = 0;
                }

                $array_popularidad[$i] = array(($rubro->nombre), (int) $cant, "color: #33ccff");
                $i++;
            }

            $data['array_popularidad'] = $array_popularidad;

            // PROVINCIAS
            $pro = new Provincia();
            $provincias = $pro->getProvincias();

            $array_provincias[0] = array('Provincia', 'Usuarios registrados');

            $i = 1;
            foreach ($provincias as $provincia)
            {
                $usuarios = $u->getUsuariosPorProvincia($provincia->ID_provincia);

                if($usuarios)
                {
                    $cant = count($usuarios);
                }
                else
                {
                    $cant = 0;
                }

                $array_provincias[$i] = array(($provincia->nombre), (int) $cant);
                $i++;
            }

            $data['array_provincias'] = $array_provincias;

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_graficas',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
    }

    public function reportesCustom()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        if($this->validateUrl())
        {
            $array_usuarios_fecha[0] = array('Fecha','Usuarios');
            $data['array_usuarios_fecha'] = $array_usuarios_fecha;

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_reportes_custom',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
    }

    public function usuariosPorFecha ()
    {
        $fechaDesde = $this->input->post('fecha_desde_u');
        $fechaHasta = $this->input->post('fecha_hasta_u');

        $array_usuarios_fecha[0] = array('Fecha','Usuarios');
        $meses = array();
        $cantidades = array();

        $u = new Usuario();
        $usuarios = $u->getUsuariosPorFecha($fechaDesde, $fechaHasta);

        foreach ($usuarios as $usuario)
        {
            $mes = date("m",strtotime($usuario->fecha_alta));
            $ano = date("y",strtotime($usuario->fecha_alta));
            $fecha = $mes.'-'.$ano;

            if (in_array($fecha, $meses))
            {
                for($i = 0; $i < count($meses); $i ++)
                {
                    if($fecha == $meses[$i])
                    {
                        $cantidades[$i] = $cantidades[$i] + 1;
                    }
                }
            }
            else
            {
                array_push($meses, $fecha);
                array_push($cantidades, 1);
            }
        }

        $i = 0;
        foreach($meses as $mes)
        {
            array_push($array_usuarios_fecha, array($mes, $cantidades[$i]));
            $i++;
        }

        $data = array(
            'respuesta' => json_encode($array_usuarios_fecha)
        );

        echo json_encode($data);
    }

    public function proyectosPorFecha ()
    {
        $fechaDesde = $this->input->post('fecha_desde_p');
        $fechaHasta = $this->input->post('fecha_hasta_p');

        $array_proyectos_fecha[0] = array('Fecha','Usuarios');
        $array_proyectos_fecha[1] = array($fechaDesde, 5);
        $array_proyectos_fecha[2] = array($fechaHasta, 9);

        $data = array(
            'respuesta' => json_encode($array_proyectos_fecha)
        );

        echo json_encode($data);
    }

    public function newsletterEmprendedor()
    {
        $this->form_validation->set_rules('titulo', 'inputTitulo', 'trim|required', array('required' => 'No ingreso título del artículo'));
        $this->form_validation->set_rules('descripcion', 'inputDescripcion', 'trim|required',array('required' => 'No ingreso contenido'));

        if ($this->form_validation->run() == FALSE)
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_newsletter_empr',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];

            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];

            $usuario = new Usuario();
            $usuarios = $usuario->getEmprendedoresNewsletter();

            // para cada usuario emprendedor
            foreach ($usuarios as $u)
            {
                $this->send_newsletter_emprendedor($u->mail, $titulo, $descripcion);
            }

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_news_exito',$data);
            $this->load->view('commons/footer');
        }
    }

    public function send_newsletter_emprendedor ($email, $titulo, $descripcion) {
        $to = $email;
        $subject = "newsletter";

        $message = "
                   <!doctype html>
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

                      .full-width {
                        width: 100% !important;
                      }
                    }

                    /* ANDROID CENTER FIX */
                    div[style*=\"margin: 16px 0;\"] { margin: 0 !important; }
                    </style>
                    </head>
                    <body style=\"margin: 0 !important; padding: 0; !important background-color: #ffffff;\" bgcolor=\"#ffffff\">

                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                        <tr>
                            <td align=\"center\" valign=\"top\" width=\"100%\" background=\"images/bg.jpg\" bgcolor=\"#B74215\" style=\"background: #B74215 url('images/bg.jpg'); background-size: cover; padding: 35px 15px 0 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"full-width\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 50px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png' width=\"50\" height=\"50\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 20px 0;\">
                                            <img src='". base_url()."/assets/img/hqslogo2.png' width=\"300\" height=\"300\" border=\"0\" style=\"display: block;\">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" height=\"100%\" valign=\"top\" width=\"100%\" bgcolor=\"#f6f6f6\" style=\"padding: 0 15px 50px 15px;\" class=\"mobile-padding\">
                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"480\" class=\"full-width\">
                                    <tr>
                                        <td align=\"center\" valign=\"top\" style=\"padding: 0 0 25px 0; font-family: Open Sans, Helvetica, Arial, sans-serif;\">
                                            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
                                                <tr>
                                                    <td align=\"center\" bgcolor=\"#ffffff\" style=\"border-radius: 0 0 3px 3px; padding: 25px;\">
                                                        <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
                                                            <tr>
                                                                <td align=\"center\" style=\"font-family: Open Sans, Helvetica, Arial, sans-serif;\">
                                                                    <h2 style=\"font-size: 28px; color: #444444; margin: 0; padding-bottom: 10px;\">Tu newsletter de Haz que suceda!</h2>
                                                                    <p style=\"color: #999999; font-size: 16px; line-height: 24px; margin: 0;\">
                                                                      Nos interesa tu proyecto, por eso te traemos un par de sugerencias para que aumenten la cantidad de visitas.
                                                                    </p>
                                                                    <h1 style=\"color: #999999; font-size: 26px; line-height: 34px; margin: 0;\">". $titulo ."</h1>
                                                                    <p style=\"color: #999999; font-size: 16px; line-height: 24px; margin: 0; white-space: pre-wrap;\"> ". $descripcion ."</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align=\"center\" style=\"padding: 30px 0 0 0;\">
                                                                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                                                        <tr>
                                                                            <td align=\"center\" style=\"border-radius: 26px;\" bgcolor=\"#75b6c9\">
                                                                                <a href=\"https://www.hazquesuceda.org\" target=\"_blank\" style=\"font-size: 16px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 26px; background-color: #B72F20; padding: 14px 26px; border: 1px solid #B72F20; display: block;\">Read more &rarr;</a>
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
                                    </tr>
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
}
