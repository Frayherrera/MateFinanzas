<?php

namespace App\Models;

use CodeIgniter\Model;

class mEstudiante extends Model
{
    function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function insertarEstudiante($aDatosInsertar=[]){
        try {
            $builder = $this->db->table('usuario');
            $builder->set($aDatosInsertar);
            $builder->insert($aDatosInsertar);
            return $this->db->affectedRows();
        } catch (\Throwable $th) {
            return -1;
        }
    }

    public function logueo($sUsuario, $sClave){
        try {
            $builder = $this->db->table('usuario');
            $builder->where('correo', $sUsuario);
            $builder->where('clave', $sClave);
            $builder->where('estado', 1);
            $builder->select('id, nombre, apellido, documento, idRol,telefono, correo');
            $aResult = $builder->get()->getResultArray();
            return $aResult;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function obtenerUsuario($idUsuario){
        try {
            $builder = $this->db->table('usuario');
            $builder->where('id', $idUsuario);
            $builder->select('id, nombre, apellido, documento, idRol,telefono, correo');
            $aResult = $builder->get()->getResultArray();
            return $aResult;
        } catch (\Throwable $th) {
            return [];
        }
    }
    public function obtenerTemas(){
        try {
            $builder = $this->db->table('tema');
            $builder->where('estado', 1);
            $builder->select('id, descripcion, titulo');
            $aResult = $builder->get()->getResultArray();
            return $aResult;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function obtenerModulos($idTema){
        try {
            $builder = $this->db->table('modulo');
            $builder->where('estado', 1);
            $builder->where('idTema', $idTema);
            $builder->select('id, descripcion, titulo, video');
            $aResult = $builder->get()->getResultArray();
            return $aResult;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function obtenerPreguntas($idTema){
        try {
            $builder = $this->db->table('pregunta');
            $builder->where('idTema', $idTema);
            $builder->select('id, titulo');
            $aResult = $builder->get()->getResultArray();
            return $aResult;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function obtenerOpciones($idPregunta){
        try {
            $builder = $this->db->table('opcion');
            $builder->where('idPregunta', $idPregunta);
            $builder->select('id, descripcion, correcta');
            $aResult = $builder->get()->getResultArray();
            return $aResult;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function insertarRespuestas($idUsuario, $idPregunta, $idOpcion,$idTema){
        try {
            $builder = $this->db->table('respuesta');
            $builder->set([
                'idUsuario' => $idUsuario,
                'idPregunta' => $idPregunta,
                'idOpcion' => $idOpcion,
                'idTema' => $idTema
            ]);
            $builder->insert();
            return $this->db->affectedRows();
        } catch (\Throwable $th) {
            return -1;
        }
    }

    public function cargarRespuestas($idUsuario, $idTema){
        try {
            $builder = $this->db->table('respuesta');
            $builder->where('idUsuario', $idUsuario);
            $builder->where('idTema', $idTema);
            $builder->select('idPregunta, idOpcion as "seleccionado"');
            $aResult = $builder->get()->getResultArray();
            return $aResult;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function actualizarUsuario($idUsuario, $aDatosActualizar){
        try {
            $builder = $this->db->table('usuario');
            $builder->where('id', $idUsuario);
            $builder->set($aDatosActualizar);
            $builder->update();
            return $this->db->affectedRows();
        } catch (\Throwable $th) {
            return -1;
        }

    }


}