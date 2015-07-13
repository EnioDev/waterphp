<?php

/*
 * ==============================================================
 * DEFINE OS CAMINHOS DOS DIRETÓRIOS DA APLICAÇÃO:
 * ==============================================================
 */

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_PATH', dirname(__DIR__) . DS);

define('LIB_PATH', ROOT_PATH . 'water' . DS);

define('APP_PATH', ROOT_PATH . 'app' . DS);

define('CONFIG_PATH', APP_PATH . 'config' . DS);

define('VIEW_PATH', APP_PATH . 'view' . DS);

define('CONTROLLER_PATH', APP_PATH . 'controller' . DS);

define('PUBLIC_PATH', ROOT_PATH . 'public' . DS);

define('VALUES_PATH', PUBLIC_PATH . 'values' . DS);

define('IMAGES_PATH', PUBLIC_PATH . 'images' . DS);

/*
 * ==============================================================
 * CONFIGURA O TRATAMENTO DE ERROS DA APLICAÇÃO:
 * ==============================================================
 */

require_once(LIB_PATH . 'autoload.php');

$errorHandler = new core\error\ErrorHandler();

set_error_handler([&$errorHandler, 'waterErrorHandler']);
set_exception_handler([&$errorHandler, 'waterExceptionHandler']);
register_shutdown_function([&$errorHandler, 'waterShutdownHandler']);

/*
 * ==============================================================
 * DEFINE AS URLs USADAS NA APLICAÇÃO:
 * ==============================================================
 */

define('PROTOCOL', 'http://');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('SUB_FOLDER', str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));

/*
 * Define a URL base do projeto.
 * Ex: http://localhost/seuprojeto ou www.seuprojeto.com.
 */
define('BASE_URL', PROTOCOL . DOMAIN . SUB_FOLDER);

/*
 * Define a URL para o diretório público da aplicação.
 */
define('PUBLIC_URL', BASE_URL . 'public' . DS);

/*
 * ==============================================================
 * CONFIGURA A SESSÃO:
 * ==============================================================
 */

require_once(CONFIG_PATH . 'config.php');

ini_set('session.save_path', DS.'tmp'); // TODO: Validar no windows.
ini_set('session.gc_maxlifetime', SESSION_MAX_LIFETIME);
ini_set('session.gc_probability', 1); // Ex: probability / divisor = 1 (100%)
ini_set('session.gc_divisor', 1);

/*
 * Somente definir o valor em segundos se desejar interromper
 * a sessão mesmo que o usuário estiver ativo.
 */
define('SESSION_TIMEOUT', '0');

/*
 * ==============================================================
 * CONFIGURA O SERVIDOR SMTP:
 * ==============================================================
 */

ini_set('SMTP', MAIL_SMTP_HOST);
ini_set('smtp_port', MAIL_SMTP_PORT);

/*
 * ==============================================================
 * CARREGA AS ROTAS:
 * ==============================================================
 */

$route = new core\Route();
require_once(CONFIG_PATH . 'routes.php');

/*
 * ==============================================================
 * INICIALIZA A APLICAÇÃO:
 * ==============================================================
 */

new core\App();