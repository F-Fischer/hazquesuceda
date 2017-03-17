<?php

class Permisos extends CI_Model
{
    private $url;
    private $idPermiso;
    private $idRol;

    public function getPermiso($idRol, $url)
    {
        $this->db->select('ID_rol, url');
        $this->db->where('ID_rol', $idRol);
        $this->db->where('url', $url);
        $query = $this->db->get('permisos');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

}