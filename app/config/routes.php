<?php

/*
 * Você DEVE definir o nome que será usado
 * na url para acessar cada controlador.
 */
$router->controller('home', 'Home'); // (name, controller)
$router->controller('login', 'Login');
$router->controller('register', 'Register');
$router->controller('user', 'User');

/*
 * Você pode definir uma url mais amigável para acessar
 * um método específico do controlador usando
 * $route->controllerMethod().
 */
$router->controllerMethod('logout', 'User@logout'); // (name, controller@method)