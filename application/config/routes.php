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

/* STUDENTS */
$route['students'] = 'students';
$route['students/create/(:num)/(:num)'] = 'students/create/$1/$2';
$route['students/create/(:num)/(:any)'] = 'students/create/$1'; // Returns to students/create if not num
$route['students/archive'] = 'students/archive';
$route['students/(:num)'] = 'students/view/$1';

/* EVENTS */
$route['events/create'] = 'events/create';
$route['events/archive'] = 'events/archive';
$route['events/add/(:any)'] = 'events/add/$1';
$route['events/close/(:any)'] = 'events/close/$1';
$route['events/(:any)'] = 'events/view/$1';
$route['events'] = 'events';

/* NEWSLETTER */
$route['newsletter'] = 'newsletter';
$route['newsletters'] = 'newsletter'; // Just in case someone pluralizes it
$route['newsletter/add'] = 'newsletter/add';
$route['newsletter/(:num)'] = 'newsletter/view/$1';

/* RESET */
$route['reset/year'] = 'reset/year';
$route['reset/semester'] = 'reset/semester';
$route['reset'] = 'reset';

/* DOWNLOADS */
$route['downloads'] = 'downloads';
$route['downloads/(:any)'] = 'downloads/$1';

/* STANDALONE OR CUSTOM PAGES */
$route['rollcall'] = 'rollcall';
$route['leaderboard'] = 'pages/leaderboard';
$route['banquet'] = 'pages/banquet';
$route['contact'] = 'pages/view/contact';

/* DEFAULT ROUTING */
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
