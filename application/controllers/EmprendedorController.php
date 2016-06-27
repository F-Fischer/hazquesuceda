<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 4/20/2016
 * Time: 10:43 AM
 */
class EmprendedorController extends CI_Controller
{
    private $portfolio;
    /**
     *
     */
    function __construct () {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->model('Emprendedor');
        $this->load->model('Rubro');
        $this->load->model('MultimediaProyecto');
        $this->load->library('pagination');
        $this->load->library('session');
    }
    public function index(){
        if($this->session->userdata('logged_in'))
        {
            //$session_data = $this->session->userdata('logged_in');
            $data['username'] = $this->session->userdata['logged_in']['username'];

            $this->load->library('pagination');
            $proyecto = new Proyecto();
            $dataCantidad = $proyecto->record_count();
            $elementosPorPaginas = 9;
            $config['base_url'] = base_url('emprendedor');
            $config['total_rows'] = $dataCantidad;
            $config['per_page'] = $elementosPorPaginas;
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data['portfolio'] = $proyecto->getProyectos($config['per_page'],$page);

            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/verproyectos_emprendedor',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    public function MiCuenta()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $emprendedor = new Emprendedor();
        $datosMiCuenta = $emprendedor->getEmprendedor($data['username']);
        $data['micuenta'] = $datosMiCuenta;

        $this->load->view('commons/header', $data);
        $this->load->view('emprendedor/micuenta_emprendedor',$data);
        $this->load->view('commons/footer');
    }

    public function MisProyectos ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $emprendedor = new Emprendedor();
        $result = $emprendedor->getIdByUsername($data['username']);
        $proyecto = new Proyecto();

        $data['proyectos'] = $proyecto->getProyectosByUserId($result->ID_usuario);
        $this->load->view('commons/header', $data);
        $this->load->view('emprendedor/verproyectospropios',$data);
        $this->load->view('commons/footer');
    }

    public function crearProyecto ()
    {
        if($this->session->userdata('logged_in'))
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];
            $r = new Rubro();
            $data['rubros'] = $r->getRubros();

            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/crear_proyecto',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    public function subirVideoProyecto ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);

        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoBasicoById($id);

        if(!$resultado) {
            //TODO: Tirar error que no existe ese proyecto
        }

        $data['proyecto'] = $resultado;
        $this->load->view('commons/header',$data);
        $this->load->view('emprendedor/subir_video',$data);
        $this->load->view('commons/footer');
    }

    public function subirImagenProyecto ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);

        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoBasicoById($id);

        if(!$resultado) {
            //TODO: Tirar error que no existe ese proyecto
        }

        $multimedia = new MultimediaProyecto();
        $cantImg = count($multimedia->imgPorProyecto($id));

        if($cantImg >= 3)
        {
            $data['error'] = 'Se ha alcanzado la cantidad máxima de imágenes para este proyecto';
            $data['special_case'] = null;
        }
        else
        {
            $data['error'] = null;

            if($cantImg == 0)
            {
                $data['special_case'] = null;
            }

            $multimedia = $multimedia->specialCase($id);

            if($cantImg == 1 && ($multimedia[0]->path == 'image-not-available.jpg'))
            {
                var_dump('y aca');
                $data['special_case'] = 'si';
            }
            else
            {
                $data['special_case'] = null;
            }
        }

        $data['proyecto'] = $resultado;
        $data['cantimg'] = $cantImg;
        $data['warning'] = null;
        $this->load->view('commons/header', $data);
        $this->load->view('emprendedor/subir_imagen',$data);
        $this->load->view('commons/footer');
    }

    public function subirArchivoProyecto ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);

        if($this->uri->segment(3))
        {
            $msg = $this->uri->segment(3);
            $data['msg'] = $this->uri->segment(3);
        }
        else
        {
            $msg = null;
            $data['msg'] = null;
        }

        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoBasicoById($id);

        if(!$resultado) {
            //TODO: Tirar error que no existe ese proyecto
        }

        $multimedia = new MultimediaProyecto();
        $pdf = count($multimedia->pdfProyecto($this->uri->segment(2)));

        if($pdf && !$msg)
        {
            $data['error'] = 'El proyecto ya posee un pdf adjunto';
        }
        else
        {
            $data['error'] = null;
        }

        $data['proyecto'] = $resultado;
        $this->load->view('commons/header', $data);
        $this->load->view('emprendedor/subir_archivo',$data);
        $this->load->view('commons/footer');
    }

    public function proyectoSinArchivo()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);
        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoBasicoById($id);

        $data['error'] = null;
        $data['msg'] = 'El proyecto se ha subido correctamente, sin archivo adjunto.';
        $data['proyecto'] = $resultado;
        $this->load->view('commons/header', $data);
        $this->load->view('emprendedor/subir_archivo',$data);
        $this->load->view('commons/footer');
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }
}