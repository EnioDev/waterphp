<?php

/*
 * Você deve definir o nome da rota que será
 * usado na url para acessar o controlador.
 */
$route->controller('home', 'Home');
$route->controller('login', 'Login');
$route->controller('register', 'Register');
$route->controller('user', 'UserController');

/*
 * Você pode definir URLs mais amigáveis para acessar
 * um método do controlador usando $route->get.
 */
$route->get('user_edit', 'UserController@edit');
$route->get('user_save', 'UserController@store');
$route->get('user_remove', 'UserController@destroy');