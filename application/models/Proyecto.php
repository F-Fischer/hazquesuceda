<?php

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 11/2/2015
 * Time: 12:20 PM
 */
class Proyecto extends CI_Model
{
    private $id;
    private $nombre;
    private $idUsuarioEmprendedor;
    private $descripcion;
    private $idRubroProyecto;
    private $idEstado;
    private $fechaAlta;
    private $fechaBaja;
    private $fechaUltimaModificacion;
    private $cantVisitas;
    private $cantVecesPago;

    public function setProyecto($idUsuarioEmprendedor,$idRubro,$nombre,$descripcion,$fechaAlta,$fechaBaja)
    {
        $this->setIdUsuarioEmprendedor($idUsuarioEmprendedor);
        $this->setIdRubroProyecto($idRubro);
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaBaja($fechaBaja);
    }

    public function insertProyecto()
    {
        $data = array(
            'nombre' => $this->getNombre(),
            'ID_usuario_emprendedor' => $this->getIdUsuarioEmprendedor(),
            'descripcion' => $this->getDescripcion(),
            'ID_rubro_proyecto' => $this->getIdRubroProyecto(),
            'ID_estado' => 1,
            'fecha_alta' => $this->getFechaAlta(),
            'fecha_baja' => $this->getFechaBaja(),
            'fecha_ultima_modificacion' => $this->getFechaAlta(),
            'cant_visitas' => 0,
            'cant_veces_pago' => 0
        );

        if($this->db->insert('proyecto',$data))
        {
            return true;
        }

        return false;
    }

    public function getIdByName($nombre,$idUsuarioEmprendedor)
    {
        $this -> db -> select('ID_proyecto');
        $this -> db -> from('hazquesuceda.proyecto');
        $this -> db -> where('nombre', "$nombre");
        $this -> db -> where('ID_usuario_emprendedor', "$idUsuarioEmprendedor");

        $query = $this->db->get();

        if($query -> num_rows() == 1)
        {
            foreach ($query->result() as $row)
            {
                return $row->ID_proyecto;
            }
        }
        else
        {
            return false;
        }
    }

    function getProyectos ($limit,$start){
        $this->db->select('ID_proyecto, nombre, descripcion, cant_veces_pago');
        $this->db->where('ID_estado',3);
        $this->db->limit($limit, $start);
        $query = $this->db->get('proyecto');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    function getProyectosAdmin ($limit, $start){
        $this->db->select('proyecto.ID_proyecto, proyecto.nombre as proy_nombre, usuario.ID_usuario as user_id, usuario.nombre, usuario.apellido, estados_proyecto.nombre as nombre_estad, proyecto.fecha_alta');
        $this->db->from('proyecto');
        $this->db->join('usuario', 'proyecto.ID_usuario_emprendedor = usuario.ID_usuario');
        $this->db->join('estados_proyecto', 'proyecto.ID_estado = estados_proyecto.ID_estado');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    function getProyectoByEstado ($idEstado, $limit, $start)
    {
        $this->db->select('proyecto.ID_proyecto, proyecto.nombre as proy_nombre, usuario.ID_usuario as user_id, usuario.nombre, usuario.apellido, estados_proyecto.nombre as nombre_estad, proyecto.fecha_alta');
        $this->db->from('proyecto');
        $this->db->join('usuario', 'proyecto.ID_usuario_emprendedor = usuario.ID_usuario');
        $this->db->join('estados_proyecto', 'proyecto.ID_estado = estados_proyecto.ID_estado');
        $this->db->where('proyecto.ID_proyecto',$idEstado);
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;

    }

    public function record_count() {
        return $this->db->count_all("proyecto");
    }



    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getIdUsuarioEmprendedor()
    {
        return $this->idUsuarioEmprendedor;
    }

    public function setIdUsuarioEmprendedor($idUsuarioEmprendedor)
    {
        $this->idUsuarioEmprendedor = $idUsuarioEmprendedor;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getIdRubroProyecto()
    {
        return $this->idRubroProyecto;
    }

    public function setIdRubroProyecto($idRubroProyecto)
    {
        $this->idRubroProyecto = $idRubroProyecto;
    }

    public function getIdEstado()
    {
        return $this->idEstado;
    }

    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }

    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    }

    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    public function getFechaUltimaModificacion()
    {
        return $this->fechaUltimaModificacion;
    }

    /**
     * @param mixed $fechaUltimaModificacion
     */
    public function setFechaUltimaModificacion($fechaUltimaModificacion)
    {
        $this->fechaUltimaModificacion = $fechaUltimaModificacion;
    }

    /**
     * @return mixed
     */
    public function getCantVisitas()
    {
        return $this->cantVisitas;
    }

    /**
     * @param mixed $cantVisitas
     */
    public function setCantVisitas($cantVisitas)
    {
        $this->cantVisitas = $cantVisitas;
    }

    /**
     * @return mixed
     */
    public function getCantVecesPago()
    {
        return $this->cantVecesPago;
    }

    /**
     * @param mixed $cantVecesPago
     */
    public function setCantVecesPago($cantVecesPago)
    {
        $this->cantVecesPago = $cantVecesPago;
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


}