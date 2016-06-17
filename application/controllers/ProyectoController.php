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
        /*
        $r = new Rubro();
        $data['rubros'] = $r->getRubros();
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $this->load->view('commons/header', $data);
        $this->load->view('crearproyecto',$data);
        $this->load->view('commons/footer');
        */
    }

    public function crearProyecto()
    {
        $this->form_validation->set_rules('nombre', 'inputNombre', 'trim|required', array('required' => 'No ingreso título del proyecto'));
        $this->form_validation->set_rules('descripcion', 'inputDescripcion', 'trim|required',array('required' => 'No ingreso descripción'));

        $p = new Proyecto();

        $p->setNombre($_POST["nombre"]);
        $p->setDescripcion($_POST["descripcion"]);
        $p->setIdRubroProyecto($_POST["comboRubros"]);

        if ($this->form_validation->run() == FALSE)
        {
            $r = new Rubro();
            $data['rubros'] = $r->getRubros();
            $data['username'] = $this->session->userdata['logged_in']['username'];
            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/crear_proyecto',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];
            $e = new Emprendedor();
            $id = $e->getIdEmprendedor($data['username']);
            $p->setIdUsuarioEmprendedor($id[0]->ID_usuario);
            $data['userid'] = $id[0]->ID_usuario;

            $date = date('Y-m-d');

            $p->setFechaAlta($date);
            $p->setFechaUltimaModificacion($date);

            $date = strtotime("+30 days", strtotime($date));
            $date = date("Y-m-d", $date);
            $p->setFechaBaja($date);

            if($p->insertProyecto())
            {
                $proyecto = new Proyecto();
                $resultado = $proyecto->getInfoBasicaProyectoByNombre($_POST["nombre"],$id[0]->ID_usuario);

                redirect('video/'.$resultado->ID_proyecto);
            }
        }
    }

    public function subirVideo()
    {
        $this->form_validation->set_rules('video', 'inputVideo', 'trim|required', array('required' => 'No ingresó url del video'));

        $url = new MultimediaProyecto();
        $url->setTipo('youtube');
        $url->setPath($_POST["video"]);
        $url->setIdProyecto($this->uri->segment(3));

        if ($this->form_validation->run() == FALSE)
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];
            $id = $this->uri->segment(3);

            $proyecto = new Proyecto();
            $resultado = $proyecto->getProyectoBasicoById($id);

            if(!$resultado) {
                // Tirar error que no existe ese proyecto
            }

            $data['proyecto'] = $resultado;
            $this->load->view('commons/header',$data);
            $this->load->view('emprendedor/subir_video',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            /*
            //ver validacion, funciona mal
            $youtube_url = $_POST["video"];

            if (preg_match("/^((http\:\/\/){0,}(www\.){0,}(youtube\.com){1}|(youtu\.be){1}(\/watch\?v\=[^\s]){1})$/", $youtube_url) == 1)
            {
                echo "Valid";
            }
            else
            {
                echo "Invalid";
            }
            */

            $path = substr($_POST["video"],32);  // https://www.youtube.com/watch?v=Ibv2ZoLgcyg
            $url->setPath($path);

            if($url->insertMultimedia())
            {
                $id = $this->uri->segment(3);

                redirect('imagenes/'.$id);
            }
        }
    }

    public function guardarImgBD($upload_path)
    {
        $url = new MultimediaProyecto();
        $url->setTipo('imagen');

        //$date = strtotime(date('Y-m-d'));
        //$path = $upload_path.$date;

        /*$filename = basename($name_file);
        $new = md5($filename);

        if (move_uploaded_file($name_file, $upload_path.$new))
        {
            // other code
        }
        */

        $url->setPath($upload_path);
        $url->setIdProyecto($this->uri->segment(3));

        if($url->insertMultimedia())
        {
            $id = $this->uri->segment(3);

            redirect('imagenes/'.$id);
        }
    }

    public function guardarPdfBD($upload_path)
    {
        $url = new MultimediaProyecto();
        $url->setTipo('pdf');

        $url->setPath($upload_path);
        $url->setIdProyecto($this->uri->segment(3));

        if($url->insertMultimedia())
        {
            $id = $this->uri->segment(3);
            $msg = 'El_archivo_se_ha_subido_correctamente';

            redirect('archivo/'.$id.'/'.$msg);
        }
    }

    public function do_upload_img()
    {
        $config = array(
            'upload_path' => "/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload())
        {
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success',$data);

            $upload_path = "/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/";
            $this->guardarImgBD($upload_path);
        }
    }

    public function do_upload_pdf()
    {
        $config = array(
            'upload_path' => "/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/",
            'allowed_types' => "pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload())
        {
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success',$data);

            $upload_path = "/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/";
            $this->guardarPdfBD($upload_path);
        }
    }

    public function file_view()
    {
        $this->load->view('file_view', array('error' => ' ' ));
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