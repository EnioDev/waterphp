<?php

/*
 * --------------------------------------------------------------------------
 * TRATAMENTO DE ERROS
 * --------------------------------------------------------------------------
 *
 * Você pode ativar ou desativar o modo de depuração.
 * É altamente recomendado desativar em ambiente de produção.
 * 0 ou false = Desativado
 * 1 ou true = Ativado
 */

define('DEBUG_MODE', 0);

/*
 * Você pode definir seu próprio modelo de página para depurar os erros,
 * tais como "Warning" e "Notice", caso a opção acima esteja ativada.
 * Veja o modelo dado com o framework para saber quais informações você
 * pode exibir.
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
 * Você pode definir o tempo máximo em segundos que a aplicação deve
 * aguardar pela atividade do usuário antes da sessão expirar.
 */

define('SESSION_LIFETIME', '7200'); // 7200 = 2h

/*
 * Se preferir, você pode definir o tempo máximo em segundos que a sessão
 * do usuário deve durar mesmo que ele esteja ativo.
 */
define('SESSION_TIMEOUT', '0');

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
 * Você deve definir o idioma da aplicação. Esta ação é útil para ajudar o
 * buscador a classificar seu site no idioma apropriado, orientar os
 * navegadores a exibir acentuação e caracteres especiais corretamente.
 * O idioma também é usado para fazer a tradução da aplicação. Consulte
 * a documentação para saber mais.
 *
 * Veja alguns valores possíveis:
 *
 * pt Português
 * pt-br Português do Brasil
 * en Inglês
 * en-us Inglês dos EUA
 * en-gb Inglês Britânico
 * fr Francês
 * de Alemão
 * es Espanhol
 * it Italiano
 * ru Russo
 * zh Chinês
 * ja Japonês
 */

define('APP_LANGUAGE', 'pt-br');

/*
 * --------------------------------------------------------------------------
 * CRIPTOGRAFIA
 * --------------------------------------------------------------------------
 *
 * Para usar a classe Session ou Auth você deve definir uma chave para
 * criptografar os dados, uma sequência de caracteres que será usada
 * para identificar sua aplicação.
 *
 * Atenção: Se você já estiver usando a aplicação de exemplo dada com o
 * framework e alterar esta chave, você deverá redefinir a senha de todos
 * os usuários cadastrados. Para isso será necessário registrar um novo
 * usuário e efetuar o login novamente.
 */

define('ENCRYPTION_KEY', 'your_secret_key');

/*
 * --------------------------------------------------------------------------
 * BANCO DE DADOS
 * --------------------------------------------------------------------------
 *
 * Atenção: Defina as informações abaixo corretamente, caso contrário, uma
 * exceção será lançada sempre que tentar executar uma operação de banco
 * de dados.
 *
 * Exemplo: Para fazer a conexão com o Postgresql defina o driver "pgsql".
 * Consulte os drivers disponíveis para fazer a conexão com os demais
 * bancos usando o PDO (PHP Data Objects).
 */

define('DB_DRIVER'  , 'mysql');
define('DB_HOST'    , 'localhost'); // Informe o nome do servidor ou domínio.
define('DB_PORT'    , '');          // Informe a porta configurada para conectar-se ao banco. Ex: 3306 (padrão Mysql) ou 5432 (padrão Postgresql).
define('DB_NAME'    , '');          // Informe o nome do banco de dados que você criou para usar com a aplicação.
define('DB_USER'    , '');          // Informe o usuário para fazer a conexão com o banco.
define('DB_PASSWORD', '');          // Informe a senha do usuário caso definida.

/*
 * --------------------------------------------------------------------------
 * E-MAIL
 * --------------------------------------------------------------------------
 *
 * Atenção: Para usar a classe Mail certifique-se que o PHP instalado em seu
 * servidor está corretamente configurado para enviar e-mails usando a função
 * mail do PHP.
 * Você também pode testar as funcionalidades da classe Mail através do seu
 * servidor de hospedagem, provavelmente ele estará corretamente configurado.
 */

define('MAIL_IS_HTML'   , true);
define('MAIL_CHARSET'   , 'iso-8859-1');
define('MAIL_FROM'      , ''); // user@domain.com
define('MAIL_SMTP_HOST' , ''); // ssl://smtp.gmail.com
define('MAIL_SMTP_PORT' , ''); // 465
