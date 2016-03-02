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
        $this->load->model('rubrointeres');
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

    public function registrar(){

        //Validaciones emprendedor

        $this->form_validation->set_rules('nombre','Nombre', 'trim|required', array('required' => 'No ingreso nombre'));
        $this->form_validation->set_rules('apellido','Apellido', 'trim|required',array('required' => 'No ingreso apellido'));
        $this->form_validation->set_rules('username','Usuario', 'trim|required|callback_validate_username', array('required' => 'Debe ingresar un nombre de usuario',
            'dvalidate_username' => 'El usuario ya existe'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', array('min_length[6]' => 'La contrase�a debe tener mas de 6 caracteres',
            'required' => 'Debe ingresar una contrase�a'));
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]', array('matches[password]' => 'Las contrase�as no son iguales'));
        $this->form_validation->set_rules('mail', 'E-Mail', 'trim|required|valid_email|callback_validate_email', array('required' => 'Debe ingresar una cuenta de e-mail',
            'valid_email' => 'Debe ingresar un mail'));

        //Valores obtenidos del form emprendedor

        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $mail = $this->input->post('mail');
        $fechaNacimiento = $this->input->post('fecha_nacimiento');
        $username =  $this->input->post('username');
        $password =  hash('sha256',$this->input->post('password'));
        $newsletter = $this->input->post('newsletter');

        $rubroInteres = $this->input->post('rubroSel');



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

            $e->setInversor($nombre,$apellido,$telefono,$mail,$fechaNacimiento,$password,$username,$newsletter);

            if($e->insertInversor())
            {
                $ri = new RubroInteres();
                $idUsuario = $e->getIdByUsername($username);
                $ri->setIdUsuario($idUsuario->ID_usuario);
                foreach($rubroInteres as $rubro)
                {
                    $ri->setIdRubro($rubro);
                    $ri->insertRubroInteres();
                }
                redirect('exito');
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
}