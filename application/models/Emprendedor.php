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

    public function setEmprendedor($nombre,$apellido,$telefono,$mail,$fechaNacimiento,$password,$userName,$newsletter)
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

    public function insertEmprendedor()
    {
        $data = array(
            'nombre' => $this->getNombre(),
            'apellido' => $this->getApellido(),
            'telefono' => $this->getTelefono(),
            'mail' => $this->getMail(),
            'fecha_nacimiento' => $this->getFechaNacimiento(),
            'ID_rol' => $this->getIdRol(),
            'contrasena' => $this->getContrasena(),
            'fecha_alta' => $this->getFechaNacimiento(),
            'fecha_baja' => $this->getFechaNacimiento(),
            'habilitado' => 0,
            'user_name' => $this->getUserName(),
            'recibir_newsletter' => $this->getNewsLetter()
        );

        if($this->db->insert('usuario',$data))
        {
            return true;
        }

        return false;

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