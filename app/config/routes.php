<?php

/*
 * Você DEVE definir o nome que será usado
 * na url para acessar o controlador.
 */
$route->controller('home', 'Home');
$route->controller('login', 'Login');
$route->controller('register', 'Register');
$route->controller('user', 'UserController');

/*
 * Você pode definir URLs mais amigáveis para acessar
 * um método do controlador usando $route->controllerMethod().
 */
$route->controllerMethod('logout', 'UserController@logout'); // controller@method