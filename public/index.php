<?php

ini_set('error_reporting', E_ALL);
ini_set('display_error', 0);

/*
 * ==============================================================
 * PATHS
 * ==============================================================
 */

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_PATH', dirname(__DIR__) . DS);

define('APP_PATH', ROOT_PATH . 'app' . DS);

define('CONFIG_PATH', APP_PATH . 'config' . DS);

define('CONTROLLER_PATH', APP_PATH . 'controller' . DS);

define('MODEL_PATH', APP_PATH . 'model' . DS);

define('VIEW_PATH', APP_PATH . 'view' . DS);

define('PUBLIC_PATH', ROOT_PATH . 'public' . DS);

define('LANGUAGE_PATH', PUBLIC_PATH . 'lang' . DS);

define('IMAGE_PATH', PUBLIC_PATH . 'images' . DS);

define('LIB_PATH', ROOT_PATH . 'water' . DS);

define('CORE_PATH', LIB_PATH . 'core' . DS);

/*
 * ==============================================================
 * URL
 * ==============================================================
 */

define('PROTOCOL', 'http://');

define('DOMAIN', $_SERVER['HTTP_HOST']);

define('SUB_FOLDER', str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));

define('BASE_URL', PROTOCOL . DOMAIN . SUB_FOLDER); // Ex: http://localhost/projeto ou http://www.projeto.com

define('PUBLIC_URL', BASE_URL . 'public' . DS);

/*
 * ==============================================================
 * AUTOLOAD
 * ==============================================================
 */

require_once(LIB_PATH . 'autoload.php');

/*
 * ==============================================================
 * HELPERS
 * ==============================================================
 */

require_once(CORE_PATH . 'helpers.php');

/*
 * ==============================================================
 * ERROR HANDLER
 * ==============================================================
 */

$errorHandler = new core\error\ErrorHandler();

set_error_handler([&$errorHandler, 'waterErrorHandler']);
set_exception_handler([&$errorHandler, 'waterExceptionHandler']);
register_shutdown_function([&$errorHandler, 'waterShutdownHandler']);

/*
 * ==============================================================
 * CONFIG
 * ==============================================================
 */

require_once(CONFIG_PATH . 'config.php');

/*
 * ==============================================================
 * SESSION
 * ==============================================================
 */

$savePath = ROOT_PATH . 'storage' . DS . 'sessions';

ini_set('session.save_path', $savePath);
ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
ini_set('session.gc_probability', 1); // Ex: probability / divisor = 1 (100%)
ini_set('session.gc_divisor', 1);

/*
 * ==============================================================
 * SMTP
 * ==============================================================
 */

ini_set('SMTP', MAIL_SMTP_HOST);
ini_set('smtp_port', MAIL_SMTP_PORT);

/*
 * ==============================================================
 * ROUTES
 * ==============================================================
 */

$router = new core\routing\Router();
require_once(CONFIG_PATH . 'routes.php');

/*
 * ==============================================================
 * START
 * ==============================================================
 */

new core\App();
