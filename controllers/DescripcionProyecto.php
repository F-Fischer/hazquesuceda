<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 10/11/15
 * Time: 1:46 AM
 */
class DescripcionProyecto extends CI_Controller
{

    function __construct () {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->library('session');
    }

    public function index()
    {

        $data['username'] = $this->session->userdata['logged_in']['username'];
        $this->load->view('commons/header');
        $this->load->view('proyecto',$data);
        $this->load->view('commons/footer');
    }

}