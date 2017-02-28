<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 5/30/2016
 * Time: 6:34 PM
 */
class AdministradorController extends CI_Controller
{
    function __construct ()
    {
        parent::__construct();
        $this->load->model('Proyecto');
        $this->load->model('Emprendedor');
        $this->load->model('Usuario');
        $this->load->model('Rubro');
        $this->load->model('Rol');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $p = new Proyecto();
        $data['proyectos'] = $p->getAllProyectosAdmin();

        $this->load->view('commons/header', $data);
        $this->load->view('administrador/basico_administrador',$data);
        $this->load->view('commons/footer');
    }
    
    public function users()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $u = new Usuario();
        $data['users'] = $u->getAllUsers();

        $this->load->view('commons/header', $data);
        $this->load->view('administrador/admin_usuarios',$data);
        $this->load->view('commons/footer');

    }
    
    public function aceptarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');
        $proyecto = new Proyecto();

        if($proyecto->activarProyecto($idProyecto))
        {
            $p = $proyecto->getProyectoByIdBasico($idProyecto);

            $usuario = new Usuario();
            $u = $usuario->getUsuarioById($p[0]->ID_usuario_emprendedor);

            $this->send_email_proyecto_activo($u[0]->mail, $p[0]->nombre);
            echo 'Proyecto activo';
        }
        else
        {
            echo 'Este proyecto no puede ser activado';
        }
    }

    public function clausurarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');

        $p = new Proyecto();
        if($p->clausurarProyecto($idProyecto))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function rechazarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');

        $p = new Proyecto();
        if($p->rechazarProyecto($idProyecto))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function send_email_proyecto_activo ($email, $nombre) {
        $to = $email;
        $subject = "Tu proyecto en Haz que suceda!";

        $message = "
                    <html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <div class=\"jumbotron\">
                              <h1>Felicitaciones!</h1>
                              <p>
                                  Nuestro administrador a aprobado tu proyecto <strong>" . $nombre. " </strong>.
                                  Nuestros inversores ya pueden verlo.
                              </p>
                              <label>¡Exitos a ti y a tu proyecto!</label>
                              <p>
                                  Gracias por confiar en nosotros.
                              </p>
                              <p>
                                  El equipo de Haz que suceda!
                              </p>
                            </div>
                        </body>
                    </html>
                    ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <soporte@hazquesuceda.org>' . "\r\n";

        mail($to,$subject,$message,$headers);
    }

    public function statistics ()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        //TOP 5 MAS PAGADOS
        $p = new Proyecto();
        $proyectos = $p->getTopCinco('asc');
        $data['top_asc'] = $proyectos;

        //TOP 5 MENOS PAGADOS
        $proyectos = $p->getTopCinco('desc');
        $data['top_desc'] = $proyectos;

        // PROYECTOS
        $r = new Rubro();
        $rubros = $r->getRubros();
        $array_proyectos[0] = array('Rubro','Cantidad');

        $i = 1;
        foreach ($rubros as $rubro)
        {
            $p = new Proyecto();
            $proyectos = $p->getProyectosByRubro($rubro->ID_rubro, 3);
            $cant = count($proyectos);

            $array_proyectos[$i] = array(($rubro->nombre), (int) $cant);
            $i++;
        }

        $data['array_proyectos'] = $array_proyectos;

        // USUARIOS
        $u = new Usuario();
        $array_usuarios[0] = array('Tipo','Cantidad');
        $r = new Rol();
        $roles = $r->getRoles();

        $i = 1;
        foreach ($roles as $rol)
        {
            $usuarios = $u->getUsuariosPorRol($i);
            $cant = count($usuarios);

            $array_usuarios[$i] = array(($rol->nombre), (int) $cant);
            $i++;
        }

        $data['array_usuarios'] = $array_usuarios;

        $this->load->view('commons/header', $data);
        $this->load->view('administrador/admin_graficas',$data);
        $this->load->view('commons/footer');
    }

    public function reportesCustom()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        $array_usuarios_fecha[0] = array('Fecha','Usuarios');
        $data['array_usuarios_fecha'] = $array_usuarios_fecha;
        $data['error'] = null;

        $array_proyectos_fecha[0] = array('Fecha','Proyectos');
        $data['array_proyectos_fecha'] = $array_proyectos_fecha;
//        $data['error'] = null;

        $this->load->view('commons/header', $data);
        $this->load->view('administrador/admin_reportes_custom',$data);
        $this->load->view('commons/footer');
    }

    public function usuariosPorFecha ()
    {
        $fechaDesde = $this->input->post('fecha_desde_u');
        $fechaHasta = $this->input->post('fecha_hasta_u');

        $array_usuarios_fecha[0] = array('Fecha','Usuarios');
        $meses = array();
        $cantidades = array();

        $u = new Usuario();
        $usuarios = $u->getUsuariosPorFecha($fechaDesde, $fechaHasta);

        foreach ($usuarios as $usuario)
        {
            $mes = date("m",strtotime($usuario->fecha_alta));
            $ano = date("y",strtotime($usuario->fecha_alta));
            $fecha = $mes.'-'.$ano;

            if (in_array($fecha, $meses))
            {
                for($i = 0; $i < count($meses); $i ++)
                {
                    if($fecha == $meses[$i])
                    {
                        $cantidades[$i] = $cantidades[$i] + 1;
                    }
                }
            }
            else
            {
                array_push($meses, $fecha);
                array_push($cantidades, 1);
            }
        }

        $i = 0;
        foreach($meses as $mes)
        {
            array_push($array_usuarios_fecha, array($mes, $cantidades[$i]));
            $i++;
        }

        $data = array(
            'respuesta' => json_encode($array_usuarios_fecha)
        );

        echo json_encode($data);
    }

    public function proyectosPorFecha ()
    {
        $fechaDesde = $this->input->post('fecha_desde_p');
        $fechaHasta = $this->input->post('fecha_hasta_p');

        $array_proyectos_fecha[0] = array('Fecha','Usuarios');
        $array_proyectos_fecha[1] = array($fechaDesde, 5);
        $array_proyectos_fecha[2] = array($fechaHasta, 9);

        $data = array(
            'respuesta' => json_encode($array_proyectos_fecha)
        );

        echo json_encode($data);
    }

    public function newsletterEmprendedor()
    {
        $this->form_validation->set_rules('titulo', 'inputTitulo', 'trim|required', array('required' => 'No ingreso título del artículo'));
        $this->form_validation->set_rules('descripcion', 'inputDescripcion', 'trim|required',array('required' => 'No ingreso contenido'));

        if ($this->form_validation->run() == FALSE)
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_newsletter_empr',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            $data['username'] = $this->session->userdata['logged_in']['username'];

            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];

            $usuario = new Usuario();
            $usuarios = $usuario->getUsuariosPorRol(2);

            // para cada usuario emprendedor
            foreach ($usuarios as $u)
            {
                if ($u->recibir_newsletter == 1)
                {
                    $this->send_newsletter_emprendedor($u->mail, $titulo, $descripcion);
                }
            }

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_newsletter_empr',$data);
            $this->load->view('commons/footer');
        }
    }

    public function send_newsletter_emprendedor ($email, $titulo, $descripcion) {
        $to = $email;
        $subject = "newsletter";

        $message = "
                    <html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <div class=\"jumbotron\">
                              <h1>Tu newsletter de Haz que suceda!</h1>
                              <p>
                                  Nos interesa tu proyecto, por eso te traemos un par de sugerencias
                                  para que aumentes la cantidad de visitas.
                              </p>
                              <br>
                              <h1>". $titulo ."</h1>
                              <p> ". $descripcion ."</p>
                            </div>
                        </body>
                    </html>
                    ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <soporte@hazquesuceda.org>' . "\r\n";

        mail($to,$subject,$message,$headers);
    }
}
