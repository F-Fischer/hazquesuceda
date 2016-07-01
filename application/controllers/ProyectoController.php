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
        else
        {
            /*
            //TODO: ver validacion, funciona mal
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
        $id = $this->uri->segment(3);
        $url = new MultimediaProyecto();
        $cantImg = count($url->imgPorProyecto($id));
        $url->setPath($upload_path);
        $url->setIdProyecto($id);

        if($cantImg==null)
        {
            $url->setTipo('previsualizacion');

            if($url->insertMultimedia())
            {
                $url->setTipo('imagen');
            }
        }
        else
        {
            $url->setTipo('imagen');
        }

        if($url->insertMultimedia())
        {
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
        $base_upload_path = '/uploads/';
        $date = strtotime(date('Y-m-d H:i:s'));
        $path = $base_upload_path.$date;

        $filename = basename($path);
        $new = hash("sha256",$filename);
        $bd_upload_path = $new.'.jpg';

        $config = array(
            'upload_path' => './uploads',
            'file_name' => $new.'.jpg',
            'file_type' => "jpg",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => FALSE
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload())
        {
            $this->guardarImgBD($bd_upload_path);
        }
        else
        {
            $this->failImagenProyecto();
        }
    }

    public function no_img_upload()
    {
        if($this->guardarImgBD('image-not-available.jpg'))
        {
            $data['special_case'] = 'si';
        }
        else
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
    }

    public function failImagenProyecto ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(3);

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

            $data['error'] = null;
            $data['warning'] = 'La imagen no pudo subirse, verifique que sea formato .jpg.';
            $data['proyecto'] = $resultado;
            $data['cantimg'] = $cantImg;
            $this->load->view('commons/header', $data);
            $this->load->view('emprendedor/subir_imagen',$data);
            $this->load->view('commons/footer');
        }
    }

    public function do_upload_pdf()
    {
        $base_upload_path = base_url().'assets/uploads/';
        $date = strtotime(date('Y-m-d H:i:s'));
        $path = $base_upload_path.$date;

        $filename = basename($path);
        $new = hash("sha256",$filename);
        $bd_upload_path = $new.'.pdf';

        $config = array(
            'upload_path' => './uploads',
            'file_name' => $new.'.pdf',
            'file_type' => "pdf",
            'allowed_types' => "pdf",
            'overwrite' => FALSE,
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload())
        {
            $this->guardarPdfBD($bd_upload_path);
        }
    }

    public function descripcionProyecto()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $id = $this->uri->segment(2);

        if (!$id || !is_numeric($id))
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }

        $proyecto = new Proyecto();
        $proyecto->getProyectoById($id);
        $resultado = $proyecto->getProyectoById($id);

        if (!$resultado)
        {
            $error = new ErrorPropio();
            $error->Error_bd();
        }
        else
        {
            //sumo una visita! :)
            $nuevasVisitas = intval($resultado->cant_visitas) + 1;
            $proyecto->sumarVisitas($id, $nuevasVisitas);

            $dt1 = $resultado->fecha_baja;
            $dt1 = date('d', strtotime($dt1));
            $dt2 = date('d');

            if($dt1>$dt2)
            {
                $diasRestantes = $dt1 - $dt2;
            }
            else
            {
                $diasRestantes = 30 - ($dt2 - $dt1);
            }

            $pdf = $proyecto->getPDFbyIdProyecto($id);
            $imgs = $proyecto->getImgsByIdProyecto($id);

            $data['proyecto'] = $resultado;
            $data['dias_restantes'] = $diasRestantes;
            $data['pdf'] = $pdf;
            $data['cant_img'] = count($imgs);
            $data['imgs'] = $imgs;
            $this->load->view('commons/header', $data);
            $this->load->view('proyecto', $data);
            $this->load->view('commons/footer');
        }
    }
}