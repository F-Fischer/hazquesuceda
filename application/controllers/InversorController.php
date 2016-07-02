<?php

class InversorController extends CI_Controller
{
    private $portfolio;
    /**
     *
     */
    function __construct ()
    {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->model('Inversor');
        $this->load->model('Rubro');
        $this->load->model('MultimediaProyecto');
        $this->load->model('ErrorPropio');
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];

            $this->load->library('pagination');
            $proyecto = new Proyecto();
            $dataCantidad = $proyecto->record_count();
            $elementosPorPaginas = 9;
            $config['base_url'] = base_url('inversor');
            $config['total_rows'] = $dataCantidad;
            $config['per_page'] = $elementosPorPaginas;
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            //ve proyectos activos
            $data['portfolio'] = $proyecto->getProyectos('3', $config['per_page'],$page);

            $this->load->view('commons/header', $data);
            $this->load->view('inversor/verproyectos_inversor',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function miCuenta()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $inversor = new Inversor();
        $datosMiCuenta = $inversor->getUsuario($data['username']);

        if(!$datosMiCuenta)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
            $datosMiCuenta[0]->contrasena = $inversor->encrypt_decrypt('decrypt',$datosMiCuenta[0]->contrasena);
            $data['micuenta'] = $datosMiCuenta;

            $this->load->view('commons/header', $data);
            $this->load->view('inversor/micuenta_inversor',$data);
            $this->load->view('commons/footer');
        }
    }

    public function proyectosPagos ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $inversor = new Inversor();
        $result = $inversor->getIdByUsername($data['username']);
        $proyecto = new Proyecto();
        $proyectos = $proyecto->getProyectosPagosByUserId($result->ID_usuario);

        if(!$proyectos)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
            $i = 0;
            foreach ($proyectos as $p)
            {
                $pdf = $proyecto->getPDFbyIdProyecto($p->ID_proyecto);

                if ($pdf)
                {
                    $proyectos[$i]->pdf = $pdf;
                }
                else
                {
                    $proyectos[$i]->pdf = null;
                }

                $video = $proyecto->getVideoByIdProyecto($p->ID_proyecto);

                if ($video)
                {
                    $proyectos[$i]->video = $video;
                }
                else
                {
                    $proyectos[$i]->video = null;
                }

                $i++;
            }

            $data['proyectos'] = $proyectos;
            $this->load->view('commons/header', $data);
            $this->load->view('inversor/proyectospagos',$data);
            $this->load->view('commons/footer');
        }
    }

    public function editarNombre()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $nombre = $this->input->post('nuevo_nombre');

        $inversor = new Inversor();

        if($inversor->editarDataUsuario($data['username'], 'nombre', $nombre))
        {
            $this->miCuenta();
        }
        else
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
    }

    public function editarApellido()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $apellido = $this->input->post('nuevo_apellido');

        $inversor = new Inversor();

        if($inversor->editarDataUsuario($data['username'], 'apellido', $apellido))
        {
            $this->miCuenta();
        }
        else
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
    }

    public function editarContrasena()
    {
        $this->form_validation->set_rules('nueva_cont_2', 'Password', 'trim|required|min_length[6]', array('min_length[6]' => 'La contraseña debe tener mas de 6 caracteres',
            'required' => 'Debe ingresar una contraseña'));

        $data['username'] = $this->session->userdata['logged_in']['username'];
        $actual = $this->input->post('nueva_cont_1');
        $nueva = $this->input->post('nueva_cont_2');

        $inversor = new Inversor();

        if ($this->form_validation->run() == FALSE)
        {
            $this->miCuenta();
        }
        else
        {
            if($inversor->editarContrasena($data['username'], $actual, $nueva))
            {
                $this->miCuenta();
            }
            else
            {
                $error = new ErrorPropio();
                $error->Error_bd();
            }
        }

    }

    public function editarTelefono()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $tel = $this->input->post('nuevo_telefono');

        $inversor = new Inversor();

        if($inversor->editarDataUsuario($data['username'], 'telefono', $tel))
        {
            $this->miCuenta();
        }
        else
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
    }

    public function editarMail()
    {
        $this->form_validation->set_rules('nuevo_mail', 'E-Mail', 'trim|required|valid_email|callback_validate_email', array('required' => 'Debe ingresar una cuenta de e-mail valida',
            'valid_email' => 'Debe ingresar un mail válido',
            'validate_email' => 'Ya existe un usuario con esa dirección de mail'));

        $data['username'] = $this->session->userdata['logged_in']['username'];
        $mail = $this->input->post('nuevo_mail');

        $inversor = new Inversor();

        if ($this->form_validation->run() == FALSE)
        {
            $this->miCuenta();
        }
        else
        {
            if($inversor->editarDataEmprendedor($data['username'], 'mail', $mail))
            {
                $this->miCuenta();
            }
            else
            {
                $error = new ErrorPropio();
                $error->Error_bd();
            }
        }

    }

    public function validate_email($email)
    {
        $this->load->model('usuario');
        $usuario = new Usuario();

        if($usuario->validate_email($email))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }
}