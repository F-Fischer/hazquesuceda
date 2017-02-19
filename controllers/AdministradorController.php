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
}