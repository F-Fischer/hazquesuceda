<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 3/3/17
 * Time: 12:45 AM
 */
class Provincia extends CI_Model
{
    private $idProvincia;
    private $nombre;

    public function getProvincias()
    {
        $this->db->select('id as ID_provincia, provincia as nombre');
        $query = $this->db->get('provincias');

        if ($query->num_rows() > 0){
            return $query->result();
        }

        return false;
    }


    /**
     * @return mixed
     */
    public function getIdProvincia()
    {
        return $this->idProvincia;
    }

    /**
     * @param mixed $idProvinciar
     */
    public function setIdProvincia($idProvincia)
    {
        $this->idProvinciar = $idProvincia;
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

}