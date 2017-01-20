<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 19/1/17
 * Time: 12:51 AM
 */
class HabilitarUsuario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
    }

    public function index(){
        $data['username'] = null;
        $username = ($this->uri->segment(2));

        $usuario = new Usuario();

        if($usuario->editarDataUsuario($username, 'habilitado', 1)) {
            $data['username'] = $username;
            $data['rol'] = $usuario->devolverIdRol($username);

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
        else {
            redirect('404');
        }
    }
}