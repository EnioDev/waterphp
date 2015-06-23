<?php

/*
 * Define o separador de diretório usado no SO.
 */
define('DS', DIRECTORY_SEPARATOR);

/*
 * Define o caminho absoluto do diretório raiz da aplicação, no qual foi instalado o framework.
 */
define('ROOT', dirname(__DIR__) . DS);

/*
 * Define o caminho absoluto do diretório que contém as classes que compõem a aplicação.
 */
define('APP', ROOT . 'app' . DS);

/*
 * Define o caminho absoluto do diretório que contém os valores usados para fazer a tradução da aplicação.
 */
define('VALUES', ROOT . 'public' . DS . 'values' . DS);

/*
 * Define as partes que compõem a URL base.
 */
define('PROTOCOL', 'http://');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('SUB_FOLDER', str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));

/*
 * Define a URL base do projeto (ex: http://localhost/water).
 */
define('BASE_URL', PROTOCOL . DOMAIN . SUB_FOLDER);

/*
 * Define a URL para acessar o diretório público da aplicação.
 */
define('PUBLIC_URL', BASE_URL . 'public' . DS);

#DEBUG:
#echo ROOT . '<br>';
#echo APP . '<br>';
#echo VALUES . '<br>';
#echo BASE_URL . '<br>';
#echo PUBLIC_URL . '<br>';

/*
 * Carrega o arquivo de configuração da aplicação.
 */
require APP . 'config' . DS . 'config.php';

/*
 * Configura a exibição de erros no php.ini.
 */
error_reporting(E_ALL);
ini_set('display_errors', DEBUG_MODE);

/*
 * Configura o tempo para expirar a sessão do usuário no php.ini.
 */
ini_set('session.save_path', DS.'tmp');
ini_set('session.gc_maxlifetime', SESSION_MAX_LIFETIME);
ini_set('session.gc_probability', 1); // Ex: probability / divisor = 1 (100%)
ini_set('session.gc_divisor', 1);

/*
 * Configura o nome e a porta do servidor de envio de email no php.ini.
 */
ini_set('SMTP', MAIL_SMTP_HOST);
ini_set('smtp_port', MAIL_SMTP_PORT);

/*
 * Inclui o arquivo usado para carregar as classes automaticamente.
 */
require APP . 'autoload.php';

/*
 * Inicializa a aplicação.
 */
$app = new core\App();