<?php

/*
 * Defines directory separator.
 */
define('DS', DIRECTORY_SEPARATOR);

/*
 * Defines root directory of the project (absolute path).
 */
define('ROOT_DIR', dirname(__DIR__) . DS);

/*
 * Defines app directory of the project (absolute path).
 */
define('APP_DIR', ROOT_DIR . 'app' . DS);

/*
 * Defines values directory of the project (absolute path),
 * used to make application translation.
 */
define('VALUES_DIR', ROOT_DIR . 'public' . DS . 'values' . DS);

/*
 * Defines URL parts.
 */
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));

/*
 * Defines base URL of the project (like http://localhost/water).
 */
define('BASE_URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/*
 * Defines URL for public folder.
 */
define('PUBLIC_URL', BASE_URL . 'public' . DS);

/*
 * Loads user configuration file.
 */
require APP_DIR . 'config' . DS . 'config.php';

/*
 * Configures error's reporting (php.ini).
 */
error_reporting(E_ALL);
ini_set('display_errors', DEBUG_MODE);

/*
 * Defines session's lifetime (php.ini).
 */
ini_set('session.gc_maxlifetime', SESSION_MAX_LIFETIME);
ini_set('session.gc_probability', 1); // Ex: probability / divisor = 1 (100%)
ini_set('session.gc_divisor', 1);

/*
 * Configures mail server to send emails (php.ini).
 */
ini_set('SMTP', MAIL_SMTP_HOST);
ini_set('smtp_port', MAIL_SMTP_PORT);

/*
 * Loads autoload class file.
 */
require APP_DIR . 'autoload.php';

/*
 * Starts the application.
 */
$app = new core\App();