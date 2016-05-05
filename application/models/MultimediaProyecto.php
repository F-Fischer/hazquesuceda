<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 11/2/2015
 * Time: 12:20 PM
 */
class MultimediaProyecto extends CI_Model
{
    private $idProyecto;
    private $tipo;
    private $path;

    public function setMultimedia($idProyecto,$tipo,$path)
    {
        $this->setIdProyecto($idProyecto);
        $this->setTipo($tipo);
        $this->setPath($path);
    }

    public function insertMultimedia()
    {
        $data = array(
            'ID_proyecto' => $this->getIdProyecto(),
            'tipo' => $this->getTipo(),
            'path' => $this->getPath()
        );

        if($this->db->insert('multimedia_proyectos',$data))
        {
            return true;
        }

        return false;
    }

    public function getIdProyecto()
    {
        return $this->idProyecto;
    }

    public function setIdProyecto($idProyecto)
    {
        $this->idProyecto = $idProyecto;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }
}