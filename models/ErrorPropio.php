<?php
/**
 * Created by PhpStorm.
 * User: carola
 * Date: 27/6/16
 * Time: 10:23 PM
 */
class ErrorPropio extends CI_Model
{
    public function Error_404 ()
    {
        $this->load->view('404','refresh');
    }

    public function Error_bd ()
    {
        $this->load->view('BD_error','refresh');
    }
}