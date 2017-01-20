<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 10/20/2015
 * Time: 12:21 PM
 */
class RegistroEmprendedor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('calendar');
        $this->load->model('emprendedor');
    }


    public function index(){
        $this->load->helper('form');

        $data['username'] = null;

        $this->load->view('commons/header', $data);
        $this->load->view('registraremprendedor');
        $this->load->view('commons/footer');
    }

    public function registrar(){

        //Validaciones emprendedor

        $this->form_validation->set_rules('nombre','Nombre', 'trim|required', array('required' => 'No ingreso nombre'));
        $this->form_validation->set_rules('apellido','Apellido', 'trim|required',array('required' => 'No ingreso apellido'));
        $this->form_validation->set_rules('username','Usuario', 'trim|required|callback_validate_username', array('required' => 'Debe ingresar un nombre de usuario',
            'validate_username' => 'El usuario ya existe'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', array('min_length[6]' => 'La contraseña debe tener mas de 6 caracteres',
            'required' => 'Debe ingresar una contraseña'));
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]', array('matches[password]' => 'Las contraseñas no son iguales'));
        $this->form_validation->set_rules('mail', 'E-Mail', 'trim|required|valid_email|callback_validate_email', array('required' => 'Debe ingresar una cuenta de e-mail',
            'valid_email' => 'Debe ingresar un mail',
            'validate_email' => 'Ya existe un usuario con esa dirección de mail'));

        //Valores obtenidos del form emprendedor

        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $mail = $this->input->post('mail');
        $fechaNacimiento = $this->input->post('fecha_nacimiento');
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
        $newsletter = $this->input->post('newsletter');

        if($newsletter == true) {
            $newsletter = 1;
        }
        else {
            $newsletter = 0;
        }

        if ($this->form_validation->run() == FALSE)
        {
            $data['username'] =  null;

            $this->load->view('commons/header',$data);
            $this->load->view('registraremprendedor');
            $this->load->view('commons/footer');
        }
        else
        {
            $e = new Emprendedor();
            $e->setEmprendedor($nombre,$apellido,$telefono,$mail,$fechaNacimiento,$password,$username,$newsletter);

            if($e->insertarUsuario())
            {
                $this->send_email($mail, $username, $password);
                redirect('exitoemprendedor');
            }
        }
    }

    public function exito()
    {
        $data['username'] =  null;

        $this->load->view('commons/header',$data);
        $this->load->view('postregistro');
        $this->load->view('commons/footer');
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
                    <html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <div class=\"jumbotron\">
                              <h1>Bienvenido a Haz que suceda!</h1>
                              <label>Tu usuario es: <strong>" . $username. " </strong></label>
                              <br>
                              <label>Y tu contraseña es: <strong>" . $password . " </strong></label>
                              <p><a href=\"http://www.hazquesuceda.org/activar/". $username ."\" >Activar mi cuenta!</a></p>
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

?>