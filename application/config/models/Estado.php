<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 4/11/15
 * Time: 2:34 AM
 */
class Estado extends CI_Model
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

    public function getEstados (){

        $query = $this->db->select('ID_estado, nombre');
        $this->db->from('estados_proyecto');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }
}