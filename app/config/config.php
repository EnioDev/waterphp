<?php

/*
 * --------------------------------------------------------------------------
 * DEBUG MODE
 * --------------------------------------------------------------------------
 *
 * Você pode ativar ou desativar o modo de depuração. É aconselhável
 * desativar em ambiente de produção.
 * 0 ou false = Desativado
 * 1 ou true = Ativado
 *
 */
define('DEBUG_MODE', 1);

/*
 * --------------------------------------------------------------------------
 * LANGUAGE
 * --------------------------------------------------------------------------
 *
 * Você pode definir o idioma da aplicação, como 'en' ou 'pt-br'.
 * Para mais informações consulte o atributo "lang" usado na meta tag do
 * cabeçalho HTML e siga os mesmos padrões de nomenclatura.
 *
 * Para fazer a internacionalização da aplicação, defina o arquivo
 * "strings.xml" dentro da pasta com os respectivos idiomas em
 * "public/values". Veja o exemplo dado com o framework. =)
 *
 */
define('APP_LANGUAGE', 'en');

/*
 * --------------------------------------------------------------------------
 * SESSION
 * --------------------------------------------------------------------------
 *
 * Você pode definir SESSION_MAX_LIFETIME em segundos para interromper a
 * sessão do usuário caso ele esteja inativo.
 * Você pode definir SESSION_TIMEOUT em segundos para interromper a
 * sessão do usuário mesmo que ele esteja ativo.
 *
 */
define('SESSION_MAX_LIFETIME', '7200');
define('SESSION_TIMEOUT', '0');

/*
 * ---------------------------------------------------------------------------
 * CONTROLLER
 * --------------------------------------------------------------------------
 *
 * Você deve definir o controlador padrão para ser executado caso nenhum
 * controlador tenha sido informado na url.
 *
 */
define('DEFAULT_CONTROLLER', 'Home');

/*
 * --------------------------------------------------------------------------
 * ENCRYPTION
 * --------------------------------------------------------------------------
 *
 * Se você deseja usar a classe de criptografia para criptografar dados como
 * senhas por exemplo, você deve definir uma chave contendo os caracteres
 * desejados.
 *
 * Obs: Se estiver usando a aplicação de exemplo e alterar esta chave, você
 * deve redefinir a senha de todos os usuários cadastrados. Talvez você tenha
 * que registrar um novo usuário para conseguir efetuar o login e redefinir
 * os demais.
 *
 */
define('ENCRYPTION_KEY', 'your_secret_key');

/*
 * --------------------------------------------------------------------------
 * DATABASE CONNECTION
 * --------------------------------------------------------------------------
 *
 * Aqui você pode definir as configurações para conexão com seu banco.
 *
 * Obs: Para usar a aplicação de exemplo, consulte o arquivo "install.txt"
 * na raiz do projeto.
 *
 */
define('DB_DRIVER'  , 'mysql');
define('DB_HOST'    , 'localhost');
define('DB_PORT'    , '5432');
define('DB_NAME'    , 'water');
define('DB_USER'    , 'root');
define('DB_PASSWORD', 'root');
define('DB_CHARSET' , 'utf8');

/*
 * --------------------------------------------------------------------------
 * MAIL
 * --------------------------------------------------------------------------
 *
 * Aqui você pode definir as configurações para conexão com um servidor
 * de envio de emails.
 *
 * Obs: O envio de emails através do servidor local (localhost) não irá
 * funcionar se este não estiver configurado como um servidor SMTP.
 * Talvez você tenha que testar as funcionalidades da classe "Mail"
 * através de um serviço de hospedagem.
 *
 */

define('MAIL_IS_HTML'   , true);
define('MAIL_CHARSET'   , 'iso-8859-1');
define('MAIL_FROM'      , ''); // user@domain.com
define('MAIL_SMTP_HOST' , ''); // ssl://smtp.gmail.com
define('MAIL_SMTP_PORT' , 25); // 465
