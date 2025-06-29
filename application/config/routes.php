<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'auth/login';
$route['login/process'] = 'auth/login/process_login';
$route['logout'] = 'auth/Login/logout';

$route['regist'] = 'auth/register';
$route['regist/process'] = 'auth/register/process';
$route['regist/verify'] = 'auth/register/verify';

// admin
$route['dashboard'] = 'admin/dashboard';

$route['menu'] = 'admin/menu';
$route['menu/get_data'] = 'admin/menu/get_data';
$route['menu/store'] = 'admin/menu/store';

$route['order'] = 'admin/pesanan';
$route['order/get_data'] = 'admin/pesanan/get_data';
$route['customer/checkout/callback'] = 'customer/checkout/callback';

// customer
$route['cart'] = 'customer/cart';
$route['cart/store'] = 'customer/cart/store';
$route['cart/update'] = 'customer/cart/updateQty';

$route['detail_pesanan'] = 'customer/detail_pesanan';
$route['detail_pesanan/get_data'] = 'customer/detail_pesanan/get_data';


