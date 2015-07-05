<?php

/*
 * --------------------------------------------------------------------------
 * MODO DE DEPURAÇÃO
 * --------------------------------------------------------------------------
 *
 * Você pode ativar ou desativar o modo de depuração.
 * É altamente aconselhável desativar em ambiente de produção.
 * 0 ou false = Desativado
 * 1 ou true = Ativado
 *
 */
define('DEBUG_MODE', 0);

/*
 * --------------------------------------------------------------------------
 * SESSÃO
 * --------------------------------------------------------------------------
 *
 * Você pode definir o tempo máximo que a aplicação deve aguardar pela
 * ação do usuário que se encontra inativo, antes da sessão expirar.
 *
 */
define('SESSION_MAX_LIFETIME', '7200');

/*
 * ---------------------------------------------------------------------------
 * CONTROLADOR
 * --------------------------------------------------------------------------
 *
 * Você deve definir o controlador padrão para ser executado caso nenhum
 * controlador tenha sido informado na url.
 *
 */
define('CONTROLLER_INDEX', 'Home');

/*
 * --------------------------------------------------------------------------
 * IDIOMA E TRADUÇÃO
 * --------------------------------------------------------------------------
 *
 * Você pode definir o idioma da aplicação, como 'en' para inglês ou
 * 'pt-br' para o português do Brasil.
 * Para mais informações consulte o atributo "lang" usado na meta tag
 * do cabeçalho HTML e siga os mesmos padrões de nomenclatura.
 *
 * Para fazer a tradução da aplicação para diferentes idiomas, defina
 * o arquivo "strings.xml" em "public/values".
 *
 * Veja o exemplo dado com o framework. =)
 *
 */
define('APP_LANGUAGE', 'pt-br');

/*
 * --------------------------------------------------------------------------
 * CRIPTOGRAFIA
 * --------------------------------------------------------------------------
 *
 * Para usar a sessão ou fazer autenticação do usuário você deve definir
 * uma chave para sua aplicação criptografar os dados.
 *
 * Atenção: Se já estiver usando a aplicação de exemplo e alterar esta chave,
 * você deve redefinir a senha de todos os usuários cadastrados. Talvez você
 * tenha que registrar um novo usuário para conseguir efetuar o login e
 * redefinir os demais.
 *
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
 * E-MAIL
 * --------------------------------------------------------------------------
 *
 * Se quiser enviar e-mails usando a classe "Mail" você deve definir as
 * informações abaixo.
 *
 * Atenção: Caso sua aplicação esteja em seu servidor local, o envio
 * de e-mails não irá funcionar se este não estiver configurado como um
 * servidor SMTP.
 *
 * Talvez você tenha que testar as funcionalidades da classe "Mail"
 * através de um serviço de hospedagem.
 *
 */

define('MAIL_IS_HTML'   , true);
define('MAIL_CHARSET'   , 'iso-8859-1');
define('MAIL_FROM'      , ''); // user@domain.com
define('MAIL_SMTP_HOST' , ''); // ssl://smtp.gmail.com
define('MAIL_SMTP_PORT' , 25); // 465
