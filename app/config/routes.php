<?php

/*
 * Você deve definir o nome que será usado
 * na url para acessar o controlador.
 */
$route->controller('home', 'Home');
$route->controller('welcome', 'Home');
$route->controller('login', 'Login');
$route->controller('register', 'Register');
$route->controller('user', 'UserController');
$route->controller('debug', 'Debug');

/*
 * Você pode definir URLs mais amigáveis para acessar
 * um método do controlador usando $route->get.
 */
$route->get('user_edit', 'UserController@edit');
$route->get('user_save', 'UserController@store');
$route->get('user_remove', 'UserController@destroy');