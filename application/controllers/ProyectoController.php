<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 11/2/2015
 * Time: 12:41 PM
 */
class ProyectoController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->helper(array('form', 'url'));

        $this->load->model('proyecto');
        $this->load->model('multimediaproyecto');
        $this->load->model('rubro');
        $this->load->model('usuario');
    }

    public function index()
    {
        $r = new Rubro();

        $data['rubros'] = $r->getRubros();
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $data['error'] = ' ';

        $this->load->view('commons/header', $data);
        $this->load->view('crearproyecto',$data);
        $this->load->view('commons/footer');

    }

    public function crearProyecto()
    {
        $this->form_validation->set_rules('nombre','Nombre', 'trim|required', array('required' => 'No ingreso nombre'));

        $u = new Usuario();
        $now = new DateTime();


        $idUsuarioEmprendedor = $u->getIdByUsername($username = $this->session->userdata['logged_in']['username']);
        $idRubro = $this->input->post('comboRubros');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $fechaAlta = $now->format('Y-m-d');
        $fechaBaja = date('Y-m-d', strtotime($fechaAlta. ' + 30 days'));

        if ($this->form_validation->run() == FALSE)
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];
            $data['error'] = array('error' => ' ' );

            $this->load->view('commons/header',$data);
            $this->load->view('crearproyecto',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            var_dump("llego hasta aca");

            $p = new Proyecto();

            $p->setProyecto($idUsuarioEmprendedor,$idRubro,$nombre,$descripcion,$fechaAlta,$fechaBaja);

            if($p->insertProyecto())
            {
                $mp1 = new MultimediaProyecto();
                //$mp2 = new MultimediaProyecto();
                //$mp3 = new MultimediaProyecto();

                $idProyecto = $p->getIdByName($nombre,$idUsuarioEmprendedor);
                $tipo = "imagen";
                $path1 = "/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/".$this->input->post('imagen1');
                //$path2 = "/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/".$this->input->post('imagen2');
                //$path3 = "/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/".$this->input->post('imagen3');

                $mp1->setMultimedia($idProyecto,$tipo,$path1);
                //$mp2->setMultimedia($idProyecto,$tipo,$path2);
                //$mp3->setMultimedia($idProyecto,$tipo,$path3);

                if($mp1->insertMultimedia() /*&& $mp2->insertMultimedia() && $mp3->insertMultimedia()*/)
                {
                    redirect('exito');
                }

            }
        }
    }

}