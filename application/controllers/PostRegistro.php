<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 23/10/15
 * Time: 1:09
 */
class PostRegistro extends CI_Controller
{

    public function index(){
        $this->load->helper('form');

        $this->load->view('commons/header');
        $this->load->view('postregistro');
        $this->load->view('commons/footer');
    }

}