<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 4/11/15
 * Time: 12:09 AM
 */
class Adminproyectos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('Proyecto');
        $this->load->model('Estado');
        $this->load->library('session');
        $this->load->library('javascript');
    }

    public function index(){

        $data['username'] = $this->session->userdata['logged_in']['username'];
        $proyecto = new Proyecto();
        $estado = new Estado();

        $data['proyectos'] = $proyecto->getAllProyectosAdmin();
        $data['estados'] = $estado->getEstados();

        $this->load->view('commons/header',$data);
        $this->load->view('adminproyecto',$data);
        $this->load->view('commons/footer');
    }

    public function indexx(){

        $proyecto = new Proyecto();
        $estado = new Estado();
        $dataCantidad = $proyecto->record_count();
        $elementosPorPaginas = 10;

        $config['base_url'] = base_url('adminproyectos');
        $config['total_rows'] = $dataCantidad;
        $config['per_page'] = $elementosPorPaginas;
        $config['uri_segment'] = 2;

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data['proyectos'] = $proyecto->getProyectosAdmin($config['per_page'],$page);
        $data['estados'] = $estado->getEstados();
        $data['username'] = $this->session->userdata['logged_in']['username'];

        $this->load->view('commons/header',$data);
        $this->load->view('adminproyectos',$data);
        $this->load->view('commons/footer');
    }

}