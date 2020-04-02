<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['get_tasks'] = 'home/fetch_tasks';
$route['post_task'] = 'home/post_task';
$route['update_task'] = 'home/update_task';
$route['delete_task'] = 'home/delete_task';
