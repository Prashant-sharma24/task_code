<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// User routes
$route['register'] = 'users/register';
$route['login'] = 'users/login';
$route['dashboard'] = 'users/dashboard';
$route['profile'] = 'users/profile';
$route['update_profile'] = 'users/update_profile';
$route['search'] = 'users/search';
