<?php

/*
 * Você DEVE definir o nome que será usado
 * na url para acessar o controlador.
 */
$router->controller('home', 'Home');
$router->controller('login', 'Login');
$router->controller('register', 'Register');
$router->controller('user', 'UserController');

/*
 * Você pode definir URLs mais amigáveis para acessar
 * um método do controlador usando $route->controllerMethod().
 */
$router->controllerMethod('logout', 'UserController@logout'); // controller@method