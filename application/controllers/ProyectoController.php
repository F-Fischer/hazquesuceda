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
<<<<<<< HEAD
        $this->load->model('usuario');
=======
        $this->load->library('session');

>>>>>>> 8e169eb19a2444c2b33aaf07a6ed3da64d40a29a
    }

    public function index()
    {
        /*$this->load->view('commons/header', $data);
        $this->load->view('crearproyecto',$data);
        $this->load->view('commons/footer');*/
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
            $r = new Rubro();
            $data['jaja'] = $this->session->userdata['logged_in']['username'];
            $data['error'] = array('error' => ' ' );
            $data['rubros'] = $r->getRubros();

            $this->load->view('commons/header',$data);
            $this->load->view('crearproyecto',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            var_dump("llego hasta aca");

            $p = new Proyecto();

            var_dump($idUsuarioEmprendedor);

            $p->setIdUsuarioEmprendedor($idUsuarioEmprendedor);
            $p->setIdRubroProyecto($idRubro);
            $p->setNombre($nombre);
            $p->setDescripcion($descripcion);
            $p->setFechaAlta($fechaAlta);
            $p->setFechaBaja($fechaBaja);

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

    public function descripcionProyecto()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        $id = $this->uri->segment(2);
        // Hacer validaciones del campo
        // Tirar error si es nulo o no numerico

        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoById($id);
        if(!$resultado) {
            // Tirar error que no existe ese proyecto
        }

        $data['proyecto'] = $resultado;

        $this->load->view('commons/header',$data);
        $this->load->view('proyecto',$data);
        $this->load->view('commons/footer');
    }

}