<?php
/**
 * Created by PhpStorm.
 * User: carola
 * Date: 26/6/16
 * Time: 11:08 PM
 */

class Error extends CI_Controller
{
    public function index()
    {
        $this->load->view('404');
    }
}