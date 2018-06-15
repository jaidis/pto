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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'portal';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['template'] = 'welcome/template';

// ******************************************************************
// RUTAS PARA LOGIN, REGISTRO Y RECUPERACION
// ******************************************************************
$route['login'] = 'authentication/login';
$route['registro'] = 'authentication/register';
$route['recuperar'] = 'authentication/recover';
$route['password'] = 'authentication/login';
$route['password/(:any)'] = 'authentication/recoverPassword';
$route['logout'] = 'authentication/logout';

// ******************************************************************
// RUTAS PARA PROVINCIAS
// ******************************************************************
$route['provincias'] = 'portal/provinces';
$route['provincia'] = 'portal/province';
$route['provincia/(:any)'] = 'portal/province/$1';

// ******************************************************************
// RUTAS PARA GASTRONOMIAS
// ******************************************************************
$route['gastronomias'] = 'gastronomy/gastronomies';
$route['gastronomias/(:num)'] = 'gastronomy/gastronomies/$1';
$route['gastronomias/(:any)'] = 'gastronomy/gastronomiesProvinces/$1';
$route['gastronomias/(:any)/(:num)'] = 'gastronomy/gastronomiesProvinces/$1/$2';
$route['gastronomias/(:any)/(:any)'] = 'gastronomy/gastronomies';

$route['gastronomia'] = 'portal';
$route['gastronomia/(:any)'] = 'gastronomy/gastronomies';
$route['gastronomia/(:num)/(:any)'] = 'gastronomy/singleGastronomy/$1/$2';
$route['gastronomia/(:any)/(:any)'] = 'gastronomy/gastronomies';

// ******************************************************************
// RUTAS PARA MONUMENTOS
// ******************************************************************
$route['monumentos'] = 'monuments/monuments';
$route['monumentos/(:num)'] = 'monuments/monuments/$1';
$route['monumentos/(:any)'] = 'monuments/monumentsProvinces/$1';
$route['monumentos/(:any)/(:num)'] = 'monuments/monumentsProvinces/$1/$2';
$route['monumentos/(:any)/(:any)'] = 'monuments/monuments';

$route['monumento'] = 'portal';
$route['monumento/(:any)'] = 'monuments/monuments';
$route['monumento/(:num)/(:any)'] = 'monuments/singleMonument/$1/$2';
$route['monumento/(:any)/(:any)'] = 'monuments/monuments';

// ******************************************************************
// RUTAS PARA NOTICIAS
// ******************************************************************
$route['noticias'] = 'news/news';
$route['noticias/(:num)'] = 'news/news/$1';
$route['noticias/(:any)'] = 'news/newsProvinces/$1';
$route['noticias/(:any)/(:num)'] = 'news/newsProvinces/$1/$2';
$route['noticias/(:any)/(:any)'] = 'news/news';

$route['noticia'] = 'portal';
$route['noticia/(:any)'] = 'news/news';
$route['noticia/(:num)/(:any)'] = 'news/singleNews/$1/$2';
$route['noticia/(:any)/(:any)'] = 'news/news';

// ******************************************************************
// RUTAS PARA CONTACTO
// ******************************************************************
$route['contacto'] = 'portal/contact';

// ******************************************************************
// RUTAS PARA ADMINISTRACION - INDEX
// ******************************************************************
$route['pto-admin'] = 'modularadmin/home/index';