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
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        $result = $this->form_validation->run();

        if( $result == FALSE)
        {
            $this->load->view('login');
        }
        else
        {
            $data['rol'] = $this->session->userdata['logged_in']['rol'];

            switch ($data['rol'])
            {
                case '1' : redirect('admin');
                    break;
                case '2' : redirect('emprendedor');
                    break;
                case '3' : redirect('inversor');
                    break;
                default : redirect('404');
            }
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
                    'id' => $row->ID_usuario,
                    'username' => $this->input->post('username'),
                    'rol' => $row->ID_rol
                );

                $this->session->set_userdata('logged_in', $sess_array);
            }
            return $sess_array;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Usuario o contraseña incorrecto.');
            return false;
        }
    }

}