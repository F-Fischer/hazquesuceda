<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 11/2/2015
 * Time: 12:41 PM
 */
class ProyectoController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('proyecto');
        $this->load->model('multimediaproyecto');
        $this->load->model('rubro');

    }

    public function index()
    {
        $r = new Rubro();

        $data['rubros'] = $r->getRubros();
        $data['username'] = $this->session->userdata['logged_in']['username'];

        $this->load->view('commons/header', $data);
        $this->load->view('crearproyecto',$data);
        $this->load->view('commons/footer');

    }

    public function crearProyecto()
    {


        /*$p -> setNombre($_POST["nombre"]);
        $p -> setDescripcion($_POST["descripcion"]);
        $p -> setIdRubroProyecto($_POST["comboRubros"]);*/


        $nombre = $this->input->post('nombre');
        $idUsuarioEmprendedor =

        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $mail = $this->input->post('mail');
        $fechaNacimiento = $this->input->post('fecha_nacimiento');
        $username =  $this->input->post('username');
        $password =  hash('sha256',$this->input->post('password'));
        $newsletter = $this->input->post('newsletter');

        if ($this->form_validation->run() == FALSE)
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];

            $this->load->view('commons/header',$data);
            $this->load->view('crearproyecto');
            $this->load->view('commons/footer');
        }
        else
        {
            print ("llego hasta aca");

            $p = new Proyecto();

            $p->setEmprendedor($nombre,$apellido,$telefono,$mail,$fechaNacimiento,$password,$username,$newsletter);

            if($p->insertEmprendedor())
            {
                redirect('exito');
            }
        }
    }

}