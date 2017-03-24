<?php

class Proyecto extends CI_Model
{
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

    public function updateProjectDescription ($id,$description)
    {
        $data = array(
            'descripcion' => $description
        );

        $this->db->where('ID_proyecto', $id);
        if($this->db->update('proyecto', $data))
        {
            return true;
        }
        return false;
    }

    public function updateProjectVideo ($id,$video)
    {
        $data = array(
            'path' => $video
        );

        $this->db->where('ID_proyecto',$id);
        $this->db->where('tipo','youtube');
        if($this->db->update('multimedia_proyectos',$data))
        {
            return true;
        }
        return false;
    }

    public function updateProjectName ($id,$name)
    {
        $data = array(
            'nombre' => $name
        );

        $this->db->where('ID_proyecto', $id);
        if($this->db->update('proyecto', $data))
        {
            return true;
        }
        return false;
    }

    public function getAllProyectos (){
        $this->db->select('ID_proyecto, ID_usuario_emprendedor, nombre, descripcion, cant_veces_pago, fecha_baja, ID_rubro_proyecto');
        $this->db->where('ID_estado', 3);
        $query = $this->db->get('proyecto');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    public function getProyectoByIdBasico ($id) {
        $this->db->select('ID_proyecto, ID_usuario_emprendedor, nombre');
        $this->db->where('ID_proyecto', $id);
        $query = $this->db->get('proyecto');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }
    
    public function renovarProyecto ($idProyecto)
    {
        $this->db->select('ID_estado');
        $this->db->where('ID_proyecto',$idProyecto);
        $query = $this->db->get('proyecto');
        $result = $query->row();

        if($result->ID_estado == 4)
        {
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');

            $date = date('Y-m-d');
            $fechaBaja = strtotime("+30 days", strtotime($date));
            $fechaBajaInsert = date("Y-m-d", $fechaBaja);

            $this->db->set('ID_estado', 1);
            $this->db->set('fecha_ultima_modificacion', $result);
            $this->db->set('fecha_baja', $fechaBajaInsert);
            $this->db->where('ID_proyecto',$idProyecto);
            $this->db->update('proyecto');

            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function activarProyecto($idProyecto)
    {
        $this->db->select('ID_estado');
        $this->db->where('ID_proyecto',$idProyecto);
        $query = $this->db->get('proyecto');
        $result = $query->row();

        if($result->ID_estado == 1)
        {
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');

            $this->db->set('ID_estado', 3);
            $this->db->set('fecha_ultima_modificacion', $result);
            $this->db->where('ID_proyecto',$idProyecto);
            $this->db->update('proyecto');

            return true;
        }
        else
        {
            return false;
        }
    }

    public function finalizarProyecto($idProyecto)
    {
        $this->db->select('ID_estado');
        $this->db->where('ID_proyecto',$idProyecto);
        $query = $this->db->get('proyecto');
        $result = $query->row();

        if($result->ID_estado == 3)
        {
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');

            $this->db->set('ID_estado', 5);
            $this->db->set('fecha_ultima_modificacion', $result);
            $this->db->set('fecha_baja', $result);
            $this->db->where('ID_proyecto',$idProyecto);
            $this->db->update('proyecto');

            return true;
        }
        else
        {
            return false;
        }
    }

    public function clausurarProyecto($idProyecto)
    {
        $this->db->select('ID_estado');
        $this->db->where('ID_proyecto',$idProyecto);
        $query = $this->db->get('proyecto');
        $result = $query->row();

        if($result->ID_estado == 3)
        {
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');

            $this->db->set('ID_estado', 4);
            $this->db->set('fecha_ultima_modificacion', $result);
            $this->db->where('ID_proyecto',$idProyecto);
            $this->db->update('proyecto');

            return true;
        }
        else
        {
            return false;
        }
    }

    public function borrarProyecto($idProyecto)
    {
        $this->db->select('ID_estado');
        $this->db->where('ID_proyecto',$idProyecto);
        $query = $this->db->get('proyecto');
        $result = $query->row();

        if($result->ID_estado == 5)
        {
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');

            $this->db->set('ID_estado', 6);
            $this->db->set('fecha_ultima_modificacion', $result);
            $this->db->where('ID_proyecto',$idProyecto);
            $this->db->update('proyecto');

            return true;
        }
        else
        {
            return false;
        }
    }

    public function rechazarProyecto($idProyecto)
    {
        $this->db->select('ID_estado');
        $this->db->where('ID_proyecto',$idProyecto);
        $query = $this->db->get('proyecto');
        $result = $query->row();

        if($result->ID_estado == 1)
        {
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');

            $this->db->set('ID_estado', 2);
            $this->db->set('fecha_ultima_modificacion', $result);
            $this->db->where('ID_proyecto',$idProyecto);
            $this->db->update('proyecto');

            return true;
        }
        else
        {
            return false;
        }
    }

    function getProyectosPorFecha ($fecha_desde, $fecha_hasta)
    {
        $this->db->select('ID_proyecto, fecha_alta');
        $this->db->where('fecha_alta >=', $fecha_desde);
        $this->db->where('fecha_alta <=', $fecha_hasta);
        $this->db->order_by('fecha_alta', 'asc');
        $query = $this->db->get('usuario');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    function getInfoBasicaProyectoByNombre ($nombre, $idUsuario)
    {
        $this->db->select('ID_proyecto, nombre, descripcion');
        $this->db->from('proyecto');
        $this->db->where('nombre',$nombre);
        $this->db->where('ID_usuario_emprendedor',$idUsuario);
        $query = $this->db->get()->row();

        if($query)
        {
            return $query;
        }

        return false;
    }

    function getProyectoBasicoById ($id)
    {
        $this->db->select('ID_proyecto, nombre, descripcion');
        $this->db->from('proyecto');
        $this->db->where('ID_proyecto',$id);
        $query = $this->db->get()->row();

        if($query)
        {
            return $query;
        }

        return false;
    }

    function getPDFNameById ($id)
    {
        $this->db->select('mp.path');
        $this->db->from('multimedia_proyectos as mp');
        $this->db->where('mp.ID_proyecto',$id);
        $this->db->where('mp.tipo','pdf');

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }



    function getProyectoById ($id)
    {
        $this->db->select('p.ID_proyecto, p.nombre as nombre, p.descripcion as descripcion, p.cant_visitas, p.cant_veces_pago, p.fecha_alta, p.fecha_baja, r.nombre as rubro, m.path as youtube, p.ID_estado as ID_estado');
        $this->db->from('proyecto as p');
        $this->db->join('rubro as r', 'p.ID_rubro_proyecto = r.ID_rubro');
        $this->db->join('multimedia_proyectos as m', 'p.ID_proyecto = m.ID_proyecto');
        $this->db->where('p.ID_proyecto',$id);
        $this->db->where('m.tipo','youtube');
        $query = $this->db->get()->row();

        if($query)
        {
            return $query;
        }
        else
        {
            $this->db->select('p.ID_proyecto, p.nombre as nombre, p.descripcion as descripcion, p.cant_visitas, p.cant_veces_pago, p.fecha_alta, p.fecha_baja, r.nombre as rubro');
            $this->db->from('proyecto as p');
            $this->db->join('rubro as r', 'p.ID_rubro_proyecto = r.ID_rubro');
            $this->db->where('p.ID_proyecto',$id);
            $query = $this->db->get()->row();

            if($query)
            {
                return $query;
            }
        }

        return false;
    }

    function getProyectoByIdBis ($id)
    {
        $this->db->select('ID_proyecto, ID_usuario_emprendedor');
        $this->db->where('ID_proyecto', $id);
        $query = $this->db->get('proyecto');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    public function getProyectosFinalizados ()
    {
        $this->db->select('ID_proyecto, fecha_baja');
        $this->db->where('ID_estado', 5);
        $query = $this->db->get('proyecto');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    function getPDFbyIdProyecto ($id)
    {
        $this->db->select('path as pdf');
        $this->db->from('multimedia_proyectos');
        $this->db->where('ID_proyecto',$id);
        $this->db->where('tipo','pdf');
        $query = $this->db->get()->row();

        if($query)
        {
            return $query;
        }

        return false;
    }

    function getVideoByIdProyecto ($id)
    {
        $this->db->select('path as video');
        $this->db->from('multimedia_proyectos');
        $this->db->where('ID_proyecto',$id);
        $this->db->where('tipo','youtube');
        $query = $this->db->get()->row();

        if($query)
        {
            return $query;
        }

        return false;
    }

    function getImgsByIdProyecto ($id)
    {
        $this->db->select('path');
        $this->db->from('multimedia_proyectos');
        $this->db->where('ID_proyecto',$id);
        $this->db->where('tipo','imagen');
        $query = $this->db->get();

        if($query)
        {
            return $query->result();
        }

        return false;
    }

    public function getProyectosByUserId ($id)
    {
        $this->db->select('ID_proyecto, proyecto.nombre as nombre, proyecto.descripcion as descripcion, e.nombre as estado, cant_visitas, cant_veces_pago');
        $this->db->from('proyecto');
        $this->db->join('estados_proyecto as e', 'proyecto.ID_estado = e.ID_estado');
        $this->db->where('ID_usuario_emprendedor',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    public function getProyectosByRubro ($id_rubro, $estado)
    {
        // es importante que la cant_visitas sea el primer atributo en el get,
        // porque es el que se usa para ordenar en el controlador
        $this->db->select('p.cant_visitas as cant_visitas, p.ID_proyecto as ID_proyecto, p.nombre as nombre, p.descripcion as descripcion, p.ID_estado as ID_estado, m.path as previs');
        $this->db->from('proyecto as p');
        $this->db->join('multimedia_proyectos as m', 'p.ID_proyecto = m.ID_proyecto');
        $this->db->where('p.ID_estado',$estado);
        $this->db->where('p.ID_rubro_proyecto', $id_rubro);
        $this->db->where('m.tipo','previsualizacion');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    public function getProyectosPagosByUserId ($id)
    {
        $this->db->select('p.ID_proyecto as ID_proyecto, p.nombre as nombre, p.descripcion as descripcion, r.nombre as rubro, pa.fecha as fecha_pago, u.nombre as nombre_emprendedor, u.apellido as apellido_emprendedor, u.telefono as tel_emprendedor, u.mail as mail_emprendedor, u.user_name as username_emprendedor');
        $this->db->from('pago as pa');
        $this->db->join('proyecto as p', 'pa.ID_proyecto_pagado = p.ID_proyecto');
        $this->db->join('rubro as r', 'p.ID_rubro_proyecto = r.ID_rubro');
        $this->db->join('usuario as u', 'p.ID_usuario_emprendedor = u.ID_usuario');
        $this->db->where('pa.ID_usuario_inversor', $id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    function getProyectos ($estado, $limit,$start)
    {
        $this->db->select('p.ID_proyecto as ID_proyecto, p.nombre as nombre, p.descripcion as descripcion, p.ID_estado as ID_estado, m.path as previs');
        $this->db->from('proyecto as p');
        $this->db->join('multimedia_proyectos as m', 'p.ID_proyecto = m.ID_proyecto');
        $this->db->where('p.ID_estado',$estado);
        $this->db->where('m.tipo','previsualizacion');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    function getAllProyectosAdmin ()
    {
        $this->db->select('proyecto.ID_proyecto, proyecto.nombre as proy_nombre, usuario.ID_usuario as user_id, usuario.nombre, usuario.apellido, estados_proyecto.nombre as nombre_estad, proyecto.fecha_alta');
        $this->db->from('proyecto');
        $this->db->join('usuario', 'proyecto.ID_usuario_emprendedor = usuario.ID_usuario');
        $this->db->join('estados_proyecto', 'proyecto.ID_estado = estados_proyecto.ID_estado');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    function getProyectosAdmin ($limit, $start)
    {
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

    public function getTopCinco ($tipo)
    {
        $this->db->select('p.ID_proyecto, p.nombre as nombre, p.descripcion as descripcion, p.cant_visitas, p.cant_veces_pago, p.fecha_alta, p.fecha_baja, r.nombre as rubro, m.path as youtube');
        $this->db->from('proyecto as p');
        $this->db->join('rubro as r', 'p.ID_rubro_proyecto = r.ID_rubro');
        $this->db->join('multimedia_proyectos as m', 'p.ID_proyecto = m.ID_proyecto');
        $this->db->where('p.ID_estado',3);
        $this->db->where('m.tipo','previsualizacion');
        $this->db->order_by('cant_veces_pago', $tipo);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    public function getTopCincoDown ()
    {
        $this->db->select('p.ID_proyecto, p.nombre as nombre, p.descripcion as descripcion, p.cant_visitas, p.cant_veces_pago, p.fecha_alta, p.fecha_baja, r.nombre as rubro, m.path as youtube');
        $this->db->from('proyecto as p');
        $this->db->join('rubro as r', 'p.ID_rubro_proyecto = r.ID_rubro');
        $this->db->join('multimedia_proyectos as m', 'p.ID_proyecto = m.ID_proyecto');
        $this->db->where('p.ID_estado',3);
        $this->db->where('m.tipo','previsualizacion');
        $this->db->order_by('fecha_alta', 'desc');
        $this->db->order_by('cant_visitas', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    function sumarVisitas ($id, $cant)
    {
        $this->db->select('cant_visitas');
        $this->db->where('ID_proyecto',$id);
        $query = $this->db->get('proyecto');
        $result = $query->row();

        if($result)
        {
            $this->db->set('cant_visitas',$cant);
            $this->db->where('ID_proyecto',$id);
            $this->db->update('proyecto');

            return true;
        }
        else
        {
            return false;
        }
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

}
