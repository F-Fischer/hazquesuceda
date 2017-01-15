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
        $this->load->library('session');
    }

    public function index()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $p = new Proyecto();
        $data['proyectos'] = $p->getAllProyectosAdmin();

        $this->load->view('commons/header', $data);
        $this->load->view('administrador/basico_administrador',$data);
        $this->load->view('commons/footer');
    }
    
    public function users()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $u = new Usuario();
        $data['users'] = $u->getAllUsers();

        $this->load->view('commons/header', $data);
        $this->load->view('administrador/admin_usuarios',$data);
        $this->load->view('commons/footer');

    }
    
    public function aceptarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');

        $p = new Proyecto();
        if($p->activarProyecto($idProyecto))
        {
            echo 'Proyecto activo';
        }
        else
        {
            echo 'Este proyecto no puede ser activado';
        }
    }

    public function clausurarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');

        $p = new Proyecto();
        if($p->clausurarProyecto($idProyecto))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function rechazarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');

        $p = new Proyecto();
        if($p->rechazarProyecto($idProyecto))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
