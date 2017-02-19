<?php

/**
 * Created by PhpStorm.
 * User: carola
 * Date: 26/1/17
 * Time: 11:45 PM
 */
class Pago extends CI_Model
{
    private $idUsuarioInversor;
    private $fecha;
    private $monto;
    private $idProyectoPagado;
    private $idEstadoPago;


    public function generarPago($id_usuario_inversor, $fecha, $id_proyecto_pagado)
    {
        $this->setIdUsuarioInversor($id_usuario_inversor);
        $this->setFecha($fecha);
        $this->setMonto(1);
        $this->setIdProyectoPagado($id_proyecto_pagado);
        $this->setIdEstadoPago(1);
    }

    public function registrarPago ()
    {
        $data = array(
            'ID_usuario_inversor' => $this->getIdUsuarioInversor(),
            'fecha' => $this->getFecha(),
            'monto' => $this->getMonto(),
            'ID_proyecto_pagado' => $this->getIdProyectoPagado(),
            'ID_estado_pago' => $this->getIdEstadoPago()
        );

        if($this->db->insert('pago',$data))
        {
            return true;
        }

        return false;
    }


    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function getIdProyectoPagado()
    {
        return $this->idProyectoPagado;
    }

    public function setIdProyectoPagado($idProyectoPagado)
    {
        $this->idProyectoPagado = $idProyectoPagado;
    }

    public function getIdEstadoPago()
    {
        return $this->idEstadoPago;
    }

    public function setIdEstadoPago($idEstadoPago)
    {
        $this->idEstadoPago = $idEstadoPago;
    }

    public function getIdUsuarioInversor()
    {
        return $this->idUsuarioInversor;
    }

    public function setIdUsuarioInversor($idUsuarioInversor)
    {
        $this->idUsuarioInversor = $idUsuarioInversor;
    }

}