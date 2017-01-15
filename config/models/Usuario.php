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
    private $userName;
    private $nombre;
    private $apellido;
    private $telefono;
    private $mail;
    private $idRol;
    private $fechaNacimiento;
    private $contrasena;
    private $newsLetter;


    public function getUsuario($user_name)
    {
        $this->db->select('user_name, nombre, apellido, mail, telefono, contrasena');
        $this->db->where('user_name',$user_name);
        $query = $this->db->get('usuario');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    public function editarDataUsuario($user_name, $data, $nuevo)
    {
        $this->db->set($data, $nuevo);
        $this->db->where('user_name',$user_name);
        $this->db->update('usuario');

        return true;
    }

    public function editarContrasena ($user_name, $actual, $nueva)
    {
        $this->db->select('contrasena');
        $this->db->where('user_name',$user_name);
        $query = $this->db->get('usuario');

        $actualBD = $query->result();
        $actualBD = $actualBD[0]->contrasena;
        $actualBD = $this->encrypt_decrypt('decrypt',$actualBD);

        if($query->num_rows()>0 && ($actualBD == $actual))
        {
            $nueva = $this->encrypt_decrypt('encrypt', $nueva);

            $this->db->set('contrasena', $nueva);
            $this->db->where('user_name',$user_name);
            $this->db->update('usuario');

            return true;
        }

        return false;
    }

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

    public function getIdByUsername($username)
    {
        $this -> db -> select('ID_usuario');
        $this -> db -> from('usuario');
        $this -> db -> where('user_name', "$username");

        $query = $this->db->get();

        if($query -> num_rows() == 1)
        {
            foreach ($query->result() as $row)
            {
                return $row->ID_usuario;
            }
        }
        else
        {
            return false;
        }
    }

    function login($username, $password)
    {
        $pass = $this->encrypt_decrypt('encrypt', $password);

        $this -> db -> select('ID_usuario, user_name, contrasena, ID_rol');
        $this -> db -> from('usuario');
        $this -> db -> where('user_name', "$username");
        $this -> db -> where('contrasena',$pass);
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

    public function getAllUsers()
    {
        $query = $this->db->get('usuario');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    public function encrypt_decrypt($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' )
        {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' )
        {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
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
        $pass = $this->encrypt_decrypt('encrypt', $contrasena);
        $this->contrasena = $pass;
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