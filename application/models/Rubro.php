<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 23/10/15
 * Time: 0:52
 */
class Rubro extends CI_Model
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

    public function getRubros (){

        $this->db->select('ID_rubro, nombre');
        $query = $this->db->get('rubro');

        if ($query->num_rows() > 0){
            return $query->result();
        }

        return false;
    }

}