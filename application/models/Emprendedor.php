<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 10/22/2015
 * Time: 11:40 AM
 */
include('Usuario.php');
class Emprendedor extends Usuario
{

    function __construct()
    {
        parent::__construct();
        $this->setIdRol(2);
    }

    public function setEmprendedor($nombre,$apellido,$telefono,$mail,$fechaNacimiento,$password,$userName,$newsletter,$provincia,$localidad)
    {
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setTelefono($telefono);
        $this->setMail($mail);
        $this->setFechaNacimiento($fechaNacimiento);
        $this->setContrasena($password);
        $this->setUserName($userName);
        $this->setNewsLetter($newsletter);
        $this->setProvincia($provincia);
        $this->setLocalidad($localidad);
    }

    public function getIdEmprendedor($username)
    {
        $this->db->select('ID_usuario');
        $this->db->where('user_name',$username);

        $query = $this->db->get('usuario');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    public function getIdByUsername ($user_name)
    {
        $this->db->select('ID_usuario');
        $this->db->where('user_name',$user_name);
        $query = $this->db->get('usuario');

        if($query->num_rows()>0)
        {
            return $query->row();
        }

        return false;

    }

}