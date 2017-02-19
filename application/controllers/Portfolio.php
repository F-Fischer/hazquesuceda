<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 3/11/15
 * Time: 1:22 AM
 */
class Portfolio extends CI_Controller
{

    private $portfolio;

    function __construct () {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index()
    {

        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $data['username'] = $this->session->userdata['logged_in']['username'];
            //$data['username'] = $this->session->userdata('username');

            $this->load->library('pagination');
            $proyecto = new Proyecto();
            $dataCantidad = $proyecto->record_count();
            $elementosPorPaginas = 9;

            $config['base_url'] = base_url('portfolio');
            $config['total_rows'] = $dataCantidad;
            $config['per_page'] = $elementosPorPaginas;
            $config['uri_segment'] = 2;

            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data['portfolio'] = $proyecto->getProyectos($config['per_page'],$page);

            $this->load->view('commons/header', $data);
            $this->load->view('portfolio',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }
}