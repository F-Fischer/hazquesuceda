<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 10/22/2015
 * Time: 11:41 AM
 */
include('Usuario.php');
class Inversor extends Usuario
{
    function __construct()
    {
        parent::__construct();
        $this->setIdRol(3);
    }

    public function setInversor($nombre,$apellido,$telefono,$mail,$fechaNacimiento,$password,$userName,$newsletter)
    {
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setTelefono($telefono);
        $this->setMail($mail);
        $this->setFechaNacimiento($fechaNacimiento);
        $this->setContrasena($password);
        $this->setUserName($userName);
        $this->setNewsLetter($newsletter);
    }

    public function getIdByUsername($username)
    {
        $this->db->select('ID_usuario');
        $this->db->where('user_name',$username);
        $query = $this->db->get('usuario');

        if($query->num_rows() > 0)
        {
            return $query->row();
        }

        return false;
    }

}