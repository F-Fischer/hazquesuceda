<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 30/1/17
 * Time: 9:23 PM
 */
class Rol extends CI_Model
{
    private $nombre;
    private $descripcion;

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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getRoles (){

        $this->db->select('ID_rol, nombre');
        $query = $this->db->get('rol');

        if ($query->num_rows() > 0){
            return $query->result();
        }

        return false;
    }

}