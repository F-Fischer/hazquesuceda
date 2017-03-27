<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 11/1/2015
 * Time: 9:53 PM
 */
class RegistroInversor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('inversor');
        $this->load->model('rubro');
        $this->load->model('usuario');
        $this->load->model('RubroInteres');
        $this->load->model('Ubicacion');
        $this->load->library('form_validation');
        $this->load->library('calendar');
    }

    public function index()
    {
        $r = new Rubro();
        $data['rubros'] = $r->getRubros();
        $data['username'] = null;

        $this->load->view('commons/header', $data);
        $this->load->view('registroinversor',$data);
        $this->load->view('commons/footer');
    }

    public function getProvinciasLocalidad ()
    {
        $u = new Ubicacion();

        $result['provincias'] = $u->getProvincias();
        $result['localidades'] = $u->getLocalidades();

        $jsonString = json_encode($result);
        echo $jsonString;
    }

    public function registrar()
    {
        $this->form_validation->set_rules('nombre','Nombre', 'trim|required', array('required' => 'No ingreso nombre'));
        $this->form_validation->set_rules('apellido','Apellido', 'trim|required',array('required' => 'No ingreso apellido'));
        $this->form_validation->set_rules('username','Usuario', 'trim|required|callback_validate_username', array('required' => 'Debe ingresar un nombre de usuario',
            'validate_username' => 'El usuario ya existe'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', array('min_length[6]' => 'La contrase�a debe tener mas de 6 caracteres',
            'required' => 'Debe ingresar una contrase�a'));
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]', array('matches[password]' => 'Las contrase�as no son iguales'));
        $this->form_validation->set_rules('mail', 'E-Mail', 'trim|required|valid_email|callback_validate_email', array('required' => 'Debe ingresar una cuenta de e-mail',
            'valid_email' => 'Debe ingresar un mail'));

        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $mail = $this->input->post('mail');
        $fechaNacimiento = $this->input->post('fecha_nacimiento');
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
        $newsletter = $this->input->post('newsletter');
        $rubroInteres = $this->input->post('rubroSel');
        $provincia = $this->input->post('provincia');
        $localidad = $this->input->post('localidad');

        if($newsletter == true) {
            $newsletter = 1;
        }
        else {
            $newsletter = 0;
        }

        if ($this->form_validation->run() == FALSE)
        {
            $r = new Rubro();
            $data['rubros'] = $r->getRubros();
            $data['username'] =  null;

            $this->load->view('commons/header',$data);
            $this->load->view('registroinversor',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            $e = new Inversor();

            $e->setInversor($nombre,$apellido,$telefono,$mail,$fechaNacimiento,$password,$username,$newsletter,$provincia,$localidad);

            if($e->insertarUsuario())
            {
                $ri = new RubroInteres();
                $idUsuario = $e->getIdByUsername($username);
                $ri->setIdUsuario($idUsuario->ID_usuario);

                foreach($rubroInteres as $rubro)
                {
                    $ri->setIdRubro($rubro);
                    $ri->insertRubroInteres();
                }

                $this->send_email($mail, $username, $password);
                redirect('exitoinversor');
            }
        }
    }

    public function validarUsuario()
    {
        $usuario = new Usuario();
        $username = $this->input->post('username');

        if($usuario->validate_username($username))
        {
            echo $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('respuesta' => false)));

        }
        else {
            echo '{"respuesta" : true}';
        }
    }

    public function validate_username($username)
    {
        $this->load->model('usuario');
        $usuario = new Usuario();

        if($usuario->validate_username($username))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function validate_email($email)
    {
        $this->load->model('usuario');
        $usuario = new Usuario();

        if($usuario->validate_email($email))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function send_email($email, $username, $password) {
        $to = $email;
        $subject = "Bienvenido a Haz que suceda!";

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
                                                                    <h2 style=\"font-size: 28px; color: #444444; margin: 0; padding-bottom: 10px;\">Bienvenido a Haz que suceda!</h2>
                                                                    <p style=\"color: #999999; font-size: 16px; line-height: 24px; margin: 0;\">
                                                                      Tu usuario es: <strong>" . $username. " </strong>
                                                                      <br />
                                                                      Y tu contraseña es: <strong>" . $password . " </strong>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align=\"center\" style=\"padding: 30px 0 0 0;\">
                                                                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                                                        <tr>
                                                                            <td align=\"center\" style=\"border-radius: 26px;\" bgcolor=\"#75b6c9\">
                                                                                <a href=\"http://www.hazquesuceda.org/activar/". $username ."\" target=\"_blank\" style=\"font-size: 16px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 26px; background-color: #B72F20; padding: 14px 26px; border: 1px solid #B72F20; display: block;\">Activar mi cuenta! &rarr;</a>
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

    public function exito()
    {
        $data['username'] =  null;

        $this->load->view('commons/header',$data);
        $this->load->view('postregistro');
        $this->load->view('commons/footer');
    }
}