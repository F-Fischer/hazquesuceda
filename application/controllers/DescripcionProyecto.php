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
    }

    public function index()
    {
        $this->load->view('commons/header');
        $this->load->view('proyecto');
        $this->load->view('commons/footer');
    }

}