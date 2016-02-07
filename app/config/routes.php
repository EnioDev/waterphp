<?php

/*
 * --------------------------------------------------------------------------
 * CONTROLADORES
 * --------------------------------------------------------------------------
 *
 * Você DEVE definir o nome que será usado na url para acessar cada
 * controlador da sua aplicação.
 *
 * $router->controller(name, controller)
 */
$router->controller('home', 'Home');
$router->controller('login', 'Login');
$router->controller('register', 'Register');
$router->controller('user', 'User');

/*
 * --------------------------------------------------------------------------
 * MÉTODOS
 * --------------------------------------------------------------------------
 *
 * Você pode definir uma url mais amigável para acessar um método específico
 * do controlador quando desejado.
 *
 * $router->controllerMethod(name, controller@method)
 */
$router->controllerMethod('logout', 'User@logout');
$router->controllerMethod('language', 'User@changeLanguage');
