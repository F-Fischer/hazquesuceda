<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 10/22/2015
 * Time: 9:58 AM
 */
class Usuario extends CI_Model
{
    private $id;
    private $nombre;
    private $apellido;
    private $telefono;
    private $mail;
    private $idRol;
    private $fechaNacimiento;
    private $contrasena;
    private $userName;
    private $newsLetter;


    public function devolverIdRol($variable)
    {
        $consulta = $this->db->get_where('usuario',array('usuario'=>$variable));
        $row = $consulta->row(1);
        $idRol = $row->idRol;

        return $idRol;
    }

    public function devolverHabilitado($variable)
    {
        $consulta = $this->db->get_where('usuario',array('usuario'=>$variable));
        $row = $consulta->row(1);
        $habilitado = $row->habilitado;

        return $habilitado;
    }

    public function devolverId($variable)
    {
        $consulta = $this->db->get_where('usuario',array('usuario'=>$variable));
        $row = $consulta->row(1);
        $id = $row->id;

        return $id;
    }

    function login($username, $password)
    {
        $this -> db -> select('ID_usuario, user_name, contrasena');
        $this -> db -> from('hazquesuceda.usuario');
        $this -> db -> where('user_name', "$username");

        $this -> db -> where('contrasena',hash('sha256',$password));

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }


    public function validate_username($username)
    {
        $this->db->where('user_name',$username);
        $query = $this->db->get('usuario');

        if($query->num_rows() > 0)
        {
            return true;
        }

        return false;
    }

    public function validate_email($email)
    {
        $this->db->where('mail',$email);
        $query = $this->db->get('usuario');

        if($query->num_rows() > 0)
        {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * @param mixed $idRol
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return mixed
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * @param mixed $contrasena
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getNewsLetter()
    {
        return $this->newsLetter;
    }

    /**
     * @param mixed $newsLetter
     */
    public function setNewsLetter($newsLetter)
    {
        $this->newsLetter = $newsLetter;
    }



}