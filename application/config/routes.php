<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "external";
$route['404_override'] = '';

$route['index'] = "external/index";
$route['group'] = "external/group";
$route['publications'] = "external/publications";
$route['login'] = "external/login";

$route['measurements'] = "measurements/index";
$route['measurements/(:num)'] = "measurements/index/$1";

$route['submit'] = "submissions/index";
$route['submit/personal'] = "submissions/submit_personal";
$route['submit/vehicle'] = "submissions/submit_vehicle";
$route['submit/publication'] = "submissions/submit_publication";
$route['submit/chooser'] = "submissions/submit_chooser";
$route['submit/edit'] = "submissions/edit_list";
$route['submit/edit/(:num)'] = "submissions/submit_edit_vehicle/$1";
$route['submit/loading'] = "submissions/submit_loading";

$route['admin'] = "administrator/index";
$route['admin/measurements'] = "administrator/admin_measurements";
$route['admin/measurements/(:num)'] = "administrator/admin_measurements/$1";
$route['admin/publications'] = "administrator/admin_publications";
$route['admin/group'] = "administrator/admin_group";


/* End of file routes.php */
/* Location: ./application/config/routes.php */