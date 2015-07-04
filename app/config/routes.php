<?php

$route->controller('user', 'User');
$route->controller('home', 'Home');
$route->controller('debug', 'Debug');
$route->controller('register', 'Register');
$route->controller('login', 'Login');
$route->controller('welcome', 'Home');

$route->get('edituser', 'User@edit');