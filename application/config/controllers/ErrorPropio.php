<?php
/**
 * Created by PhpStorm.
 * User: carola
 * Date: 26/6/16
 * Time: 11:08 PM
 */

class ErrorPropio extends CI_Controller
{
    function __construct ()
    {
        parent::__construct();

        $this->load->model('ErrorPropio');
    }

    public function Error_404 ()
    {
        $error = new ErrorPropio();
        $error->Error_404();
    }

    public function Error_bd ()
    {
        $error = new ErrorPropio();
        $error->Error_bd();
    }

}