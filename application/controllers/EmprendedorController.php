<?php

class EmprendedorController extends CI_Controller
{
    private $portfolio;
    /**
     *
     */
    function __construct ()
    {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->model('Emprendedor');
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
            $config['base_url'] = base_url('emprendedor');
            $config['total_rows'] = $dataCantidad;
            $config['per_page'] = $elementosPorPaginas;
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            //ve proyectos finalizados
            $data['portfolio'] = $proyecto->getProyectos('5', $config['per_page'],$page);

            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/verproyectos_emprendedor',$data);
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
        $emprendedor = new Emprendedor();
        $datosMiCuenta = $emprendedor->getUsuario($data['username']);

        if(!$datosMiCuenta)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
            $datosMiCuenta[0]->contrasena = $emprendedor->encrypt_decrypt('decrypt',$datosMiCuenta[0]->contrasena);
            $data['micuenta'] = $datosMiCuenta;

            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/micuenta_emprendedor',$data);
            $this->load->view('commons/footer');
        }
    }

    public function misProyectos ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $emprendedor = new Emprendedor();
        $result = $emprendedor->getIdByUsername($data['username']);
        $proyecto = new Proyecto();
        $proyectos = $proyecto->getProyectosByUserId($result->ID_usuario);

        if(!$proyectos)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
            $data['proyectos'] = $proyectos;
            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/verproyectospropios',$data);
            $this->load->view('commons/footer');
        }
    }

    public function crearProyecto ()
    {
        if($this->session->userdata('logged_in'))
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];
            $r = new Rubro();
            $data['rubros'] = $r->getRubros();

            if(!$r->getRubros())
            {
                $error = new ErrorPropio();
                $error->Error_bd();
            }
            else
            {
                $this->load->view('commons/header', $data);
                $this->load->view('emprendedor/crear_proyecto',$data);
                $this->load->view('commons/footer');
            }
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function subirVideoProyecto ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);

        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoBasicoById($id);

        if(!$resultado)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
            $data['proyecto'] = $resultado;
            $this->load->view('commons/header',$data);
            $this->load->view('emprendedor/subir_video',$data);
            $this->load->view('commons/footer');
        }
    }

    public function subirImagenProyecto ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);

        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoBasicoById($id);

        if(!$resultado)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
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

        if(!$resultado)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
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

    }

    public function proyectoSinArchivo()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);
        $proyecto = new Proyecto();
        $resultado = $proyecto->getProyectoBasicoById($id);

        if(!$resultado)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
            $data['error'] = null;
            $data['msg'] = 'El proyecto se ha subido correctamente, sin archivo adjunto.';
            $data['proyecto'] = $resultado;
            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/subir_archivo',$data);
            $this->load->view('commons/footer');
        }

    }

    public function editarNombre()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $nombre = $this->input->post('nuevo_nombre');

        $emprendedor = new Emprendedor();

        if($emprendedor->editarDataUsuario($data['username'], 'nombre', $nombre))
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

        $emprendedor = new Emprendedor();

        if($emprendedor->editarDataUsuario($data['username'], 'apellido', $apellido))
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

        $emprendedor = new Emprendedor();

        if ($this->form_validation->run() == FALSE)
        {
            $this->miCuenta();
        }
        else
        {
            if($emprendedor->editarContrasena($data['username'], $actual, $nueva))
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

        $emprendedor = new Emprendedor();

        if($emprendedor->editarDataUsuario($data['username'], 'telefono', $tel))
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

        $emprendedor = new Emprendedor();

        if ($this->form_validation->run() == FALSE)
        {
            $this->miCuenta();
        }
        else
        {
            if($emprendedor->editarDataUsuario($data['username'], 'mail', $mail))
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