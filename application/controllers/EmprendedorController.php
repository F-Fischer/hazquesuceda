<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 4/20/2016
 * Time: 10:43 AM
 */
class EmprendedorController extends CI_Controller
{

    private $portfolio;

    function __construct () {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->model('Emprendedor');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index(){

        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $data['username'] = $this->session->userdata['logged_in']['username'];
            //$data['username'] = $this->session->userdata('username');

            $this->load->library('pagination');
            $proyecto = new Proyecto();
            $dataCantidad = $proyecto->record_count();
            $elementosPorPaginas = 9;

            $config['base_url'] = base_url('emprendedor');
            $config['total_rows'] = $dataCantidad;
            $config['per_page'] = $elementosPorPaginas;
            $config['uri_segment'] = 2;

            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data['portfolio'] = $proyecto->getProyectos($config['per_page'],$page);

            $this->load->view('commons/header', $data);
            $this->load->view('verproyectos_emprendedor',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    /**
     *
     */
    public function MiCuenta()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        $emprendedor = new Emprendedor();

        $datosMiCuenta = $emprendedor->getEmprendedor($data['username']);
        $data['micuenta'] = $datosMiCuenta;
        $this->load->view('commons/header', $data);
        $this->load->view('micuenta_emprendedor',$data);
        $this->load->view('commons/footer');
    }

    public function MisProyectos ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $this->load->view('commons/header', $data);
        $this->load->view('basico_emprendedor',$data);
        $this->load->view('commons/footer');
    }

    public function crearProyecto () {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $this->load->view('commons/header', $data);
        $this->load->view('basico_emprendedor',$data);
        $this->load->view('commons/footer');


        //ACA LA LOGICA PARA CREAR UN NUEVO PROYECTO
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }


}