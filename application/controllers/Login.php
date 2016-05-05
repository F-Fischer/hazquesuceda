<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 23/10/15
 * Time: 2:01
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario', '', TRUE);
        $this->load->library('session');
    }

    public function index()
    {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            $this->load->view('login');
        }
        else
        {
            //Go to private area
            //redirect('portfolio');
            redirect('emprendedor');

        }
    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');

        //query the database
        $result = $this->Usuario->login($username, $password);

        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $this->input->post('username')
                );

                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Usuario o contraseña incorrecto.');
            return false;
        }
    }
}