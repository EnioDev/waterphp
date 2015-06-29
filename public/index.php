<?php

/*
 * ==============================================================
 * DEFINIÇÃO DAS CONSTANTES:
 * ==============================================================
 */

/*
 * Define o separador de diretório usado pelo Sistema Operacional.
 */
define('DS', DIRECTORY_SEPARATOR);

/*
 * Define o caminho completo para o diretório raiz onde está instalado o framework.
 */
define('ROOT_PATH', dirname(__DIR__) . DS);

/*
 * Define o caminho completo para o diretório da aplicação.
 */
define('APP_PATH', ROOT_PATH . 'app' . DS);

/*
 * Define o caminho completo para o diretório que contém as views.
 */
define('VIEW_PATH', APP_PATH . 'view' . DS);

/*
 * Define o caminho completo para o diretório que contém os controladores.
 */
define('CONTROLLER_PATH', APP_PATH . 'controller' . DS);

/*
 * Define o caminho completo para o diretório que contém os arquivos usados para tradução.
 */
define('VALUES_PATH', ROOT_PATH . 'public' . DS . 'values' . DS);

/*
 * Define as partes que compõem a URL.
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

# DEBUG:
# echo ROOT_PATH . '<br>';
# echo APP_PATH . '<br>';
# echo VIEW_PATH . '<br>';
# echo VALUES_PATH . '<br>';
# echo BASE_URL . '<br>';
# echo PUBLIC_URL . '<br>';

/*
 * ==============================================================
 * CONFIGURAÇÃO DA APLICAÇÃO:
 * ==============================================================
 */

/*
 * Carrega o arquivo de configuração da aplicação (definido pelo usuário).
 */
require_once APP_PATH . 'config' . DS . 'config.php';

/*
 * Inclui o arquivo para carregar as classes automaticamente.
 */
require_once APP_PATH . 'autoload.php';

/*
 * Configura o tempo para expirar a sessão do usuário.
 */
// TODO: Validar no windows.
ini_set('session.save_path', DS.'tmp');
ini_set('session.gc_maxlifetime', SESSION_MAX_LIFETIME);
ini_set('session.gc_probability', 1); // Ex: probability / divisor = 1 (100%)
ini_set('session.gc_divisor', 1);

/*
 * Configura o nome e a porta do servidor de envio de emails.
 */
ini_set('SMTP', MAIL_SMTP_HOST);
ini_set('smtp_port', MAIL_SMTP_PORT);

/*
 * Configura o modo de exibição de erros.
 */
error_reporting(E_ALL);
ini_set('display_errors', DEBUG_MODE);

/*
 * Define os "handlers" para tratar os erros e as exceções.
 */
$error = new core\base\Error();

set_error_handler([&$error, 'waterErrorHandler']);
set_exception_handler([&$error, 'waterExceptionHandler']);
register_shutdown_function([&$error, 'waterShutdownHandler']);

/*
 * ==============================================================
 * INICIALIZA A APLICAÇÃO:
 * ==============================================================
 */

new core\App();