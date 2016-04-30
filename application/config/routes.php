<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "front";
$route['404_override'] = '';


$route['control'] = 'dashboard';
$route['control/logout'] = 'dashboard/logout';
$route['migrate/(:num)'] = 'migrate/index/$';
$route['control/sucursales/(:num)'] = 'control/sucursales/index/$';
$route['control/categorias/(:num)'] = 'control/categorias/index/$';
$route['control/tipos_transacciones/(:num)'] = 'control/tipos_transacciones/index/$';
$route['control/propiedades/(:num)'] = 'control/propiedades/index/$';



$route['propiedad'] = 'front/propiedad';
$route['propiedad/(:num)'] = 'front/propiedad';
$route['propiedades'] = 'front/propiedades';
$route['propiedades/(:num)'] = 'front/propiedades/$';
$route['busqueda'] = 'front/busqueda';
$route['busqueda/(:num)'] = 'front/busqueda';
$route['busqueda-codigo'] = 'front/busqueda_por_codigo';
$route['contacto'] = 'front/contacto';
$route['contacto-envio'] = 'front/envio_contacto';
$route['form_a_completar'] = 'front/form_a_completar';
$route['arma_envia'] = 'front/arma_envia';