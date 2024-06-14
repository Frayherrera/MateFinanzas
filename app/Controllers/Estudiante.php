<?php

namespace App\Controllers;
use App\Models\mEstudiante;


class Estudiante extends BaseController
{
    private $conexion;
    function __construct(){
        $this->conexion = new mEstudiante();
    }

    public function Registro()
    {
        echo view('Estudiante/cabecera', ['titulo' => 'Registro de Estudiante']);
        echo view('Estudiante/registro');
        echo view('Estudiante/piePagina');
    }

    public function Login()
    {
        echo view('Estudiante/cabecera', ['titulo' => 'Login']);
        echo view('Estudiante/login');
        echo view('Estudiante/piePagina');
    }

    public function Inicio()
    {
        //validamos que tenga la session iniciaada
        if(!session()->has('aUsuario')){
            return redirect()->to(base_url('Login'));
        }
        echo view('Estudiante/cabecera', ['titulo' => 'Inicio',"aUsuario"=>session()->get('aUsuario')]);
        echo view('Estudiante/inicio');
        echo view('Estudiante/piePagina');
    }

    public function Registrando(){
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $documento = $this->request->getPost('documento');
        $telefono = $this->request->getPost('telefono');
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('clave');

        //validamos que todos los campos estan llenos
        if($nombre == '' || $apellido == '' || $documento == '' || $telefono == '' || $correo == '' || $clave == ''){
            return json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        }

        $nResult = $this->conexion->insertarEstudiante([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'documento' => $documento,
            'telefono' => $telefono,
            'correo' => $correo,
            'clave' => $clave,
            "idRol" => 3,
            "fechaCreacion"=>date('Y-m-d H:i:s')
        ]);

        if($nResult > 0){
            return json_encode(['status' => 'ok', 'message' => 'Estudiante registrado correctamente']);
        }else{
            return json_encode(['status' => 'error', 'message' => 'Error al registrar el estudiante']);
        }
    }

    public function Logueo(){
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('clave');

        //validamos que todos los campos estan llenos
        if($correo == '' || $clave == ''){
            return json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        }

        $aResult = $this->conexion->logueo($correo, $clave);

        if(isset($aResult[0]["id"])){
            session()->set('aUsuario', $aResult[0]);
            return json_encode(['status' => 'ok', 'message' => 'Bienvenido']);
        }else{
            return json_encode(['status' => 'error', 'message' => 'Correo o clave incorrectos']);
        }
    }

    public function CerrarSesion(){
        session()->destroy();
        return redirect()->to(base_url('Login'));
    }

    public function obtenerTemas(){
        $aResult = $this->conexion->obtenerTemas();
        return json_encode($aResult);
    }

    public function obtenerModulos(){
        $idTema = $this->request->getGet('idTema');
        //validamos que tengan el idTema
        if($idTema == ''){
            return json_encode([]);
        }
        $aResult = $this->conexion->obtenerModulos($idTema);
        return json_encode($aResult);
    }

    public function obtenerPreguntas(){
        $idTema = $this->request->getGet('idTema');
        //validamos que tengan el idTema
        if($idTema == ''){
            return json_encode([]);
        }
        $aResult = $this->conexion->obtenerPreguntas($idTema);
        //recorremos las preguntas para obtener las opciones
        foreach ($aResult as $key => $value) {
            $opciones = $this->conexion->obtenerOpciones($value["id"]);
            shuffle($opciones);
            //guaramos en la session las preguntas y sus opciones
            session()->set('pregunta_'.$value["id"], $opciones);
            foreach ($opciones as $opcion) {
                $aResult[$key]["opciones"][] = ["id"=>$opcion["id"],"descripcion"=>$opcion["descripcion"]];
            }
        }
        return json_encode($aResult);
    }

    public function enviarRespuestas(){
        try {
            $aRespuestas = json_decode($this->request->getPost('respuestas'),true);
            $idTema = $this->request->getPost('idTema');
            // print_r($aRespuestas);die;
            $nCorrectas = 0;
            $nIncorrectas = 0;
            $aCorrectas = [];
            foreach ($aRespuestas as $key => $value) {
                $aOpciones = session()->get('pregunta_'.$value["idPregunta"]);
                //guardamos las respuestas
                $this->conexion->insertarRespuestas(session()->get('aUsuario')['id'],$value["idPregunta"],$value["seleccionado"],$idTema );

                foreach ($aOpciones as $opcion) {
                    if($opcion["id"] == $value["seleccionado"] && $opcion["correcta"] == 1){
                        $nCorrectas++;
                        $aCorrectas[] = [
                            "idPregunta"=>$value["idPregunta"],
                            "idOpcion"=>$value["seleccionado"]
                        ];

                    }else if($opcion["id"] == $value["seleccionado"] && $opcion["correcta"] == 0){
                        $nIncorrectas++;
                    }
                }
            }
            //devolvemos las respuestas correctas e incorrectas

            return json_encode(["pendienteRealizar"=>"no","nCorrectas"=>$nCorrectas,"nIncorrectas"=>$nIncorrectas,"aCorrectas"=>$aCorrectas]);
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th->getMessage());
        }
    }

    public function validarRespuestas(){
        try {
            $idTema = $this->request->getPost('idTema');
            $aRespuestas = $this->conexion->cargarRespuestas(session()->get('aUsuario')['id'],$idTema);

            //validamos que si tenga respuestas diligenciadas
            if(count($aRespuestas) == 0){
                return json_encode(["pendienteRealizar"=>"ok"]);
            }

            $nCorrectas = 0;
            $nIncorrectas = 0;
            $aCorrectas = [];
            foreach ($aRespuestas as $key => $value) {
                $aOpciones = session()->get('pregunta_'.$value["idPregunta"]);
                $aTempRespuesta = [
                    "idPregunta"=>$value["idPregunta"],
                    "idOpcion"=>$value["seleccionado"]
                ];

                foreach ($aOpciones as $opcion) {
                    if($opcion["id"] == $value["seleccionado"] && $opcion["correcta"] == 1){
                        $nCorrectas++;
                        $aTempRespuesta["correcta"] = 1;
                    }else if($opcion["id"] == $value["seleccionado"] && $opcion["correcta"] == 0){
                        $nIncorrectas++;
                        $aTempRespuesta["correcta"] = 0;
                    }
                }
                $aCorrectas[] = $aTempRespuesta;
            }
            //devolvemos las respuestas correctas e incorrectas

            return json_encode(["pendienteRealizar"=>"no","nCorrectas"=>$nCorrectas,"nIncorrectas"=>$nIncorrectas,"aRespuestas"=>$aCorrectas]);
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th->getMessage());
        }
    }

    public function datosUsuario(){
        return json_encode(session()->get('aUsuario'));
    }

    public function actualizarUsuario(){
        try {
            $idUsuario = session()->get('aUsuario')['id'];
            $aDatosActualizar = [
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'documento' => $this->request->getPost('documento'),
                'telefono' => $this->request->getPost('telefono')
            ];

            if($aDatosActualizar['nombre'] == '' || $aDatosActualizar['apellido'] == '' || $aDatosActualizar['documento'] == '' || $aDatosActualizar['telefono'] == ''){
                return json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
            }

            if($this->request->getPost('clave')!="" && $this->request->getPost('clave') != null&&$this->request->getPost('clave') != "undefined"){
                $aDatosActualizar['clave'] = $this->request->getPost('clave');
            }

            $nResult = $this->conexion->actualizarUsuario($idUsuario, $aDatosActualizar);

            if($nResult > 0){
                $aResult = $this->conexion->obtenerUsuario($idUsuario);
                session()->set('aUsuario', $aResult[0]);

                return json_encode(['status' => 'ok', 'message' => 'Usuario actualizado correctamente']);
            }else{
                return json_encode(['status' => 'error', 'message' => 'Error al actualizar el usuario']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th->getMessage());
        }
    }

    
}
