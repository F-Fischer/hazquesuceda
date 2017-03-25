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
        $this->load->model('RubroInteres');
        $this->load->model('Rol');
        $this->load->model('Provincia');
        $this->load->model('ErrorPropio');
        $this->load->model('Permisos');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function validateUrl()
    {
        $username = $this->session->userdata['logged_in']['username'];
        $data['username'] = $username;
        $url = $this->uri->segment(1);

        $u = new Usuario();
        $usuario = $u->getRolByUsername($username);
        $rol = $usuario[0]->ID_rol;

        $p = new Permisos();
        $permiso = $p->getPermiso($rol, $url);

        if($permiso)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function index()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        if($this->validateUrl())
        {
            $p = new Proyecto();
            $data['proyectos'] = $p->getAllProyectosAdmin();

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/basico_administrador',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
    }
    
    public function users()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        if($this->validateUrl())
        {
            $u = new Usuario();
            $data['users'] = $u->getAllUsers();

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_usuarios',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
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
            
            $data = array (
                'success' => true,
                'message' => 'Proyecto activo'
            );

        }
        else
        {
            $data = array (
                'success' => false,
                'message' => 'Este proyecto no puede ser activado'
            );
            
        }
        
        echo json_encode($data);
    }

    public function clausurarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');

        $p = new Proyecto();
        if($p->clausurarProyecto($idProyecto))
        {
            $data = array (
                'success' => true,
                'message' => 'El proyecto ha sido clausurado'
            );
        }
        else
        {
            $data = array (
                'success' => false,
                'message' => 'Este proyecto no puede ser clausurado'
            );
        }
        
        echo json_encode($data);
    }

    public function rechazarProyecto()
    {
        $idProyecto = $this->input->get('idProyecto');

        $p = new Proyecto();
        if($p->rechazarProyecto($idProyecto))
        {
            $data = array (
                'success' => true,
                'message' => 'El proyecto ha sido rechazado'
            );
        }
        else
        {
            $data = array (
                'success' => false,
                'message' => 'Este proyecto no puede ser rechazado'
            );
        }

        echo json_encode($data);
    }

    public function inhabilitarUsuario () 
    {
        $idUsuario = $this->input->get('idUsuario'); 
        $u = new Usuario();
        
        if($u->inhabilitarUsuario($idUsuario))
        {
            $data = array(
                'status' => true,
                'message' => 'Se inhabilito usuario'
            );
        }
        else
        {
            $data = array(
                'status' => false,
                'message' => 'El usuario '.$idUsuario.' no puede ser inhabilitado'
            );
        }

        echo json_encode($data);
        if($data["status"])
        {
            $user = $u->getUsuarioById($idUsuario);
            $this->send_email_usuario_inhabilitado($user[0]->mail);
        }
    }

    public function send_email_usuario_inhabilitado ($email) {
        $to = $email;
        $subject = "Su cuenta de haz que suceda!";

        $message = "
                    <html>
                        <head>
                            <title>HTML email</title>
                        </head>
                        <body>
                            <div class=\"jumbotron\">
                              <h1>Que pena!</h1>
                              <p>
                                  Hemos detectuado un problema con su cuenta. La misma 
                                  ha sido inhabilitada por no cumplir con los requisitos de HQS.
                              </p>
                              <label>Por favor contáctese con nosotros!</label>
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

        if($this->validateUrl())
        {
            $u = new Usuario();

            //TOP 5 MAS PAGADOS
            $p = new Proyecto();
            $proyectos = $p->getTopCinco('asc');
            $data['top_asc'] = $proyectos;

            //TOP 5 MENOS PAGADOS
            $proyectos = $p->getTopCincoDown();
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

            // POPULARIDAD DE RUBROS
            $r = new Rubro();
            $rubros = $r->getRubros();
            $array_popularidad[0] = array();

            $i = 1;
            foreach ($rubros as $rubro)
            {
                $ri = new RubroInteres();
                $interes = $ri->getRubroInteres($rubro->ID_rubro);

                if($interes)
                {
                    $cant = count($interes);
                }
                else
                {
                    $cant = 0;
                }

                $array_popularidad[$i] = array(($rubro->nombre), (int) $cant, "color: #33ccff");
                $i++;
            }

            $data['array_popularidad'] = $array_popularidad;

            // PROVINCIAS
            $pro = new Provincia();
            $provincias = $pro->getProvincias();

            $array_provincias[0] = array('Provincia', 'Usuarios registrados');

            $i = 1;
            foreach ($provincias as $provincia)
            {
                $usuarios = $u->getUsuariosPorProvincia($provincia->ID_provincia);

                if($usuarios)
                {
                    $cant = count($usuarios);
                }
                else
                {
                    $cant = 0;
                }

                $array_provincias[$i] = array(($provincia->nombre), (int) $cant);
                $i++;
            }

            $data['array_provincias'] = $array_provincias;

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_graficas',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
    }

    public function reportesCustom()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];

        if($this->validateUrl())
        {
            $array_usuarios_fecha[0] = array('Fecha','Usuarios');
            $data['array_usuarios_fecha'] = $array_usuarios_fecha;

            $this->load->view('commons/header', $data);
            $this->load->view('administrador/admin_reportes_custom',$data);
            $this->load->view('commons/footer');
        }
        else
        {
            echo 'sin permisos';
        }
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
