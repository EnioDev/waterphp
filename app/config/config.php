<?php

/*
 * --------------------------------------------------------------------------
 * DEPURAÇÃO DE ERROS
 * --------------------------------------------------------------------------
 *
 * Você pode ativar ou desativar o modo de depuração.
 * É altamente aconselhável desativar em ambiente de produção.
 * 0 ou false = Desativado
 * 1 ou true = Ativado
 */

define('DEBUG_MODE', 0);

/*
 * Você pode definir seu próprio modelo de página para depurar os erros,
 * tais como "warnning" e "notice", caso a opção acima esteja ativada.
 */

define('DEBUG_VIEW', 'template/debug');

/*
 * Você pode definir seu próprio modelo de página de erro 404.
 * Esta página será exibida sempre que o controlador ou método informado
 * na URL não existir.
 */

define('ERROR_404_VIEW', 'template/404');

/*
 * --------------------------------------------------------------------------
 * SESSÃO
 * --------------------------------------------------------------------------
 *
 * Você pode definir o tempo máximo em segundos para uma sessão que foi
 * inicializada expirar em caso de inatividade do usuário.
 */

define('SESSION_LIFETIME', '7200');

/*
 * ---------------------------------------------------------------------------
 * CONTROLADOR
 * --------------------------------------------------------------------------
 *
 * Você deve definir um controlador padrão para ser executado caso nenhum
 * controlador tenha sido informado na url.
 */

define('CONTROLLER_INDEX', 'Home');

/*
 * --------------------------------------------------------------------------
 * IDIOMA
 * --------------------------------------------------------------------------
 *
 * Você pode definir o idioma da aplicação, como 'en' para inglês ou 'pt-br'
 * para o português do Brasil.
 * Para mais informações consulte o atributo "lang" usado na meta tag do
 * cabeçalho HTML e siga os mesmos padrões de nomenclatura.
 *
 * Para fazer a tradução da aplicação para diferentes idiomas, defina o
 * arquivo "strings.xml" em "public/values".
 */

define('APP_LANGUAGE', 'pt-br');

/*
 * --------------------------------------------------------------------------
 * CRIPTOGRAFIA
 * --------------------------------------------------------------------------
 *
 * Para usar a classe "Session" ou "Auth" você deve definir uma chave que
 * defina sua aplicaçao e que será usada para criptografar os dados.
 *
 * Atenção: Se já estiver usando a aplicação de exemplo e alterar esta chave,
 * você deve redefinir a senha de todos os usuários cadastrados. Talvez você
 * tenha que registrar um novo usuário para conseguir efetuar o login e
 * redefinir os demais.
 */

define('ENCRYPTION_KEY', 'your_secret_key');

/*
 * --------------------------------------------------------------------------
 * BANCO DE DADOS
 * --------------------------------------------------------------------------
 *
 * Defina as configurações de conexão com o seu banco.
 *
 * Obs: Para usar a aplicação de exemplo, consulte o arquivo "install.txt"
 * na raiz do projeto e veja como criar o banco e a tabela.
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
 * E-MAIL
 * --------------------------------------------------------------------------
 *
 * Atenção: Se sua aplicaçao estiver rodando em um servidor local,
 * e o PHP não estiver configurado para enviar e-mails, talvez você
 * tenha que testar as funcionalidades da classe "Mail" através de um
 * serviço de hospedagem.
 */

define('MAIL_IS_HTML'   , true);
define('MAIL_CHARSET'   , 'iso-8859-1');
define('MAIL_FROM'      , ''); // user@domain.com
define('MAIL_SMTP_HOST' , ''); // ssl://smtp.gmail.com
define('MAIL_SMTP_PORT' , 25); // 465
