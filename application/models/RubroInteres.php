<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 11/2/2015
 * Time: 11:32 AM
 */
class RubroInteres extends CI_Model
{
    private $idUsuario;
    private $idRubro;

    public function getIdRubro()
    {
        return $this->idRubro;
    }

    public function setIdRubro($idRubro)
    {
        $this->idRubro = $idRubro;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function insertContact (){

        $key = $this->generateKey();
        $data = array(
            'idConsulta' => $key,
            'idTemplate' => $this->idTemplate,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'mail' => $this->mail,
            'telefono' => $this->telefono,
            'rangoHorario' => $this->rangoHorario,
            'consulta' => $this->consulta
        );

        if($this->db->insert('contactos',$data))
        {
            return $key;
        }

        return false;

    }

    public function insertRubroInteres()
    {
        $data = array(
            'ID_usuario' => $this->getIdUsuario(),
            'ID_rubro' => $this->getIdRubro()
        );

        if($this->db->insert('rubro_interes',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}