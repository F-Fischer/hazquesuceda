<?php
/**
 * Created by PhpStorm.
 * User: carola
 * Date: 27/6/16
 * Time: 11:26 PM
 */
class Error extends CI_Controller
{
    public function index()
    {
        $this->load->view('404');
    }
}