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
        $this->load->model('proyecto');
        $this->load->model('multimediaproyecto');
        $this->load->model('rubro');
        $this->load->library('session');

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
        $p = new Proyecto();

        $p.setNombre($_POST["nombre"]);
        $p.setDescripcion($_POST["descripcion"]);
        $p.setRubro($_POST["comboRubros"]);
    }

    public function descripcionProyecto()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $this->load->view('commons/header',$data);
        $this->load->view('proyecto',$data);
        $this->load->view('commons/footer');
    }

}