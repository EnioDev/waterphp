<?php

/*
 * ==============================================================
 * DEFINE OS CAMINHOS DOS DIRETÓRIOS DA APLICAÇÃO:
 * ==============================================================
 */

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_PATH', dirname(__DIR__) . DS);

define('APP_PATH', ROOT_PATH . 'app' . DS);

define('CONFIG_PATH', APP_PATH . 'config' . DS);

define('VIEW_PATH', APP_PATH . 'view' . DS);

define('CONTROLLER_PATH', APP_PATH . 'controller' . DS);

define('PUBLIC_PATH', ROOT_PATH . 'public' . DS);

define('VALUES_PATH', PUBLIC_PATH . 'values' . DS);

define('IMAGES_PATH', PUBLIC_PATH . 'images' . DS);

/*
 * ==============================================================
 * DEFINE AS URLs USADAS NA APLICAÇÃO:
 * ==============================================================
 */

define('PROTOCOL', 'http://');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('SUB_FOLDER', str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));

/*
 * Define a URL base do projeto (ex: http://localhost/water).
 */
define('BASE_URL', PROTOCOL . DOMAIN . SUB_FOLDER);

/*
 * Define a URL para o diretório público da aplicação.
 */
define('PUBLIC_URL', BASE_URL . 'public' . DS);

/*
 * ==============================================================
 * CONFIGURA O TRATAMENTO DE ERROS DA APLICAÇÃO:
 * ==============================================================
 */

require_once(APP_PATH . 'autoload.php');
require_once(CONFIG_PATH . 'config.php');

error_reporting(E_ALL);
ini_set('display_errors', DEBUG_MODE);

$error = new core\base\Error();

set_error_handler([&$error, 'waterErrorHandler']);
set_exception_handler([&$error, 'waterExceptionHandler']);
register_shutdown_function([&$error, 'waterShutdownHandler']);

/*
 * ==============================================================
 * DESCOMENTE PARA "DEBUG":
 * ==============================================================
 */

# echo '<b>Paths</b>:' . '<br>';
# echo ROOT_PATH . '<br>';
# echo APP_PATH . '<br>';
# echo CONFIG_PATH . '<br>';
# echo VIEW_PATH . '<br>';
# echo CONTROLLER_PATH . '<br>';
# echo PUBLIC_PATH . '<br>';
# echo VALUES_PATH . '<br>';
# echo IMG_PATH . '<br><br>';
# echo '<b>URLs</b>:' . '<br>';
# echo BASE_URL . '<br>';
# echo PUBLIC_URL . '<br>';

/*
 * ==============================================================
 * CONFIGURA A SESSÃO:
 * ==============================================================
 */

ini_set('session.save_path', DS.'tmp'); // TODO: Validar no windows.
ini_set('session.gc_maxlifetime', SESSION_MAX_LIFETIME);
ini_set('session.gc_probability', 1); // Ex: probability / divisor = 1 (100%)
ini_set('session.gc_divisor', 1);

define('SESSION_TIMEOUT', '0');

/*
 * ==============================================================
 * CONFIGURA O ENVIO DE EMAIL:
 * ==============================================================
 */

ini_set('SMTP', MAIL_SMTP_HOST);
ini_set('smtp_port', MAIL_SMTP_PORT);

/*
 * ==============================================================
 * CARREGA AS ROTAS:
 * ==============================================================
 */

$route = new core\base\Route();
require_once(CONFIG_PATH . 'routes.php');

/*
 * ==============================================================
 * INICIALIZA A APLICAÇÃO:
 * ==============================================================
 */

new core\App();