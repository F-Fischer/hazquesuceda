<?php

class ProyectoController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('proyecto');
        $this->load->model('emprendedor');
        $this->load->model('multimediaproyecto');
        $this->load->model('rubro');
        $this->load->library('session');
    }
    public function index()
    {
        $r = new Rubro();
        $data['rubros'] = $r->getRubros();
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $this->load->view('commons/header', $data);
        $this->load->view('crearproyecto',$data);
        $this->load->view('commons/footer');
    }

    public function crearProyecto()
    {
        $p = new Proyecto();

        $p->setNombre($_POST["nombre"]);
        $p->setDescripcion($_POST["descripcion"]);
        $p->setIdRubroProyecto($_POST["comboRubros"]);

        $data['username'] = $this->session->userdata['logged_in']['username'];
        var_dump($data['username']);
        $e = new Emprendedor();
        $id = $e->getIdEmprendedor($data['username']);
        $p->setIdUsuarioEmprendedor($id[0]->ID_usuario);

        $date = date('Y-m-d');
        var_dump($date);

        $p->setFechaAlta($date);
        $p->setFechaUltimaModificacion($date);

        $date = strtotime("+30 days", strtotime($date));
        $date = date("Y-m-d", $date);
        $p->setFechaBaja($date);
        var_dump($date);

        $p->insertProyecto();
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