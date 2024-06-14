<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Estudiante::Login');
$routes->get('/Login', 'Estudiante::Login');

//Estudiante vistas
$routes->get('/RegistroEstudiante', 'Estudiante::Registro');
$routes->get('/Inicio', 'Estudiante::Inicio');



$routes->post('/Estudiante/Registrando', 'Estudiante::Registrando');
$routes->post('/Logueo', 'Estudiante::Logueo');
$routes->get('/CerrarSesion', 'Estudiante::cerrarSesion');
$routes->get('/obtenerTemas', 'Estudiante::obtenerTemas');
$routes->get('/obtenerModulos', 'Estudiante::obtenerModulos');
$routes->get('/obtenerPreguntas', 'Estudiante::obtenerPreguntas');
$routes->post('/enviarRespuestas', 'Estudiante::enviarRespuestas');
$routes->post('/validarRespuestas', 'Estudiante::validarRespuestas');
$routes->get('/datosUsuario', 'Estudiante::datosUsuario');
$routes->post('/actualizarUsuario', 'Estudiante::actualizarUsuario');