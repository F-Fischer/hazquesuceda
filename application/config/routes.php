<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'login';
$route['welcome'] = 'login';
$route['login/(:any)'] = 'login';
$route['BD_error'] = 'errorpropio/error_bd';
$route['404_override'] = 'error';
$route['translate_uri_dashes'] = FALSE;
$route['registroemprendedor'] = 'RegistroEmprendedor';
$route['registroinversor'] = 'RegistroInversor';
$route['registroinversor/registrar'] = 'RegistroInversor/Registrar';
$route['registroemprendedor/registrar'] = 'RegistroEmprendedor/Registrar';
$route['exitoemprendedor'] = 'RegistroEmprendedor/exito';
$route['exitoinversor'] = 'RegistroInversor/exito';
$route['activar/(:any)'] = 'HabilitarUsuario';
$route['portfolio'] = 'portfolio';
$route['portfolio/(:num)'] = 'portfolio';

// EMPRENDEDOR
$route['emprendedor'] = 'EmprendedorController';
$route['emprendedor/(:num)'] = 'EmprendedorController';
$route['micuentaE'] = 'EmprendedorController/miCuenta';
$route['misproyectos'] = 'EmprendedorController/misProyectos';
$route['crearproyecto'] = 'EmprendedorController/crearProyecto';
$route['video/(:num)'] = 'EmprendedorController/subirVideoProyecto';
$route['imagenes/(:num)'] = 'EmprendedorController/subirImagenProyecto';
$route['archivo/(:num)'] = 'EmprendedorController/subirArchivoProyecto';
$route['archivo/(:num)/El_archivo_se_ha_subido_correctamente'] = 'EmprendedorController/finCrearProyecto';
$route['archivo/(:num)/Proyecto_sin_archivo'] = 'EmprendedorController/finCrearProyecto';
$route['emprendedor/editarnombre'] = 'EmprendedorController/editarNombre';
$route['emprendedor/editarapellido'] = 'EmprendedorController/editarApellido';
$route['emprendedor/editarcontrasena'] = 'EmprendedorController/editarContrasena';
$route['emprendedor/editartelefono'] = 'EmprendedorController/editarTelefono';
$route['emprendedor/editarmail'] = 'EmprendedorController/editarMail';
$route['emprendedor/renovarproyecto'] = 'EmprendedorController/renovarProyecto';
$route['emprendedor/modificarproyecto'] = 'EmprendedorController/modificarProyecto';
$route['emprendedor/editarproyecto/(:num)'] = 'ProyectoController/editarProyecto';
$route['emprendedor/finalizarproyecto'] = 'EmprendedorController/finalizarProyecto';
$route['emprendedor/clausurarproyecto'] = 'EmprendedorController/clausurarProyecto';
$route['registroemprendedor/registrar'] = 'RegistroEmprendedor/Registrar';
$route['micuenta/editarnombre'] = 'EmprendedorController/editarNombre';
$route['descripcionemprendedor/(:num)'] = 'ProyectoController/descripcionProyectoEmprendedor';


//INVERSOR
$route['inversor'] = 'InversorController';
$route['inversor/(:num)'] = 'InversorController';
$route['micuentaI'] = 'InversorController/miCuenta';
$route['tarjetacontacto'] = 'InversorController/tarjetacontacto';
$route['proyectospagos'] = 'InversorController/proyectosPagos';
$route['descripcion/(:num)'] = 'ProyectoController/descripcionProyecto';
$route['inversor/editarcontrasena'] = 'InversorController/editarContrasena';
$route['inversor/editarnombre'] = 'InversorController/editarNombre';
$route['inversor/editarapellido'] = 'InversorController/editarApellido';
$route['inversor/editarcontrasena'] = 'InversorController/editarContrasena';
$route['inversor/editartelefono'] = 'InversorController/editarTelefono';
$route['inversor/editarmail'] = 'InversorController/editarMail';
$route['registroinversor/registrar'] = 'RegistroInversor/Registrar';

//ADMIN
$route['admin'] = 'AdministradorController/index';
$route['users'] = 'AdministradorController/users';
$route['statistics'] = 'AdministradorController/statistics';
$route['reports'] = 'AdministradorController/reportesCustom';
$route['newletterempr'] = 'AdministradorController/newsletterEmprendedor';
$route['admin/aceptarproyecto'] = 'AdministradorController/aceptarProyecto';
$route['admin/clausurarproyecto'] = 'AdministradorController/clausurarProyecto';
$route['admin/rechazarproyecto'] = 'AdministradorController/rechazarProyecto';
$route['admin/inhabilitarusuario'] = 'AdministradorController/inhabilitarUsuario';
$route['adminproyectos'] = 'adminproyectos';
$route['adminproyectos/(:num)'] = 'adminproyectos';

//SISTEMA
$route['clausuraautomatica'] = 'TareasAutomaticas/clausurarProyectosDelDia';
$route['recordatorio'] = 'TareasAutomaticas/recordatorioDeClausura';
$route['newsletter'] = 'TareasAutomaticas/newsletterInversor';
$route['borrarproyectos'] = 'TareasAutomaticas/borrarProyectos';
$route['pagar/(:num)/(:num)'] = 'TareasAutomaticas/informacionInversor';