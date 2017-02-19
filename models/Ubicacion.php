<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 2/9/2017
 * Time: 6:06 PM
 */
class Ubicacion extends CI_Model
{

    public function getProvincias ()
    {
        $this->db->select('id,provincia');
        $query = $this->db->get('provincias');


        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;

    }

    public function getLocalidades ()
    {
        $this->db->select('id,id_provincia,localidad');
        $query = $this->db->get('localidades');


        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }

}