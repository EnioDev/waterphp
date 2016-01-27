<?php

/*
 * --------------------------------------------------------------------------
 * TRATAMENTO DE ERROS
 * --------------------------------------------------------------------------
 *
 * Você pode ativar ou desativar o modo de depuração.
 *
 * É altamente recomendado desativar em ambiente de produção, porém quando
 * estiver desenvolvendo matenha ativado este modo para visualizar qualquer
 * alerta de erro.
 * .
 * Atenção: Erros fatais ou erros de sintaxe que impedem a execução do
 * programa serão exibidos mesmo que este modo esteja desativado.
 *
 * 0 ou false = Desativado
 * 1 ou true = Ativado
 */

define('DEBUG_MODE', 0);

/*
 * Você pode criar seu próprio modelo de página para depurar os erros,
 * tais como "Warning" e "Notice", caso a opção acima esteja ativada.
 * Veja o template usado na aplicação de exemplo para saber quais
 * informações você pode exibir na visão.
 *
 * Atenção: Mesmo que você substitua a visão abaixo por outra, não
 * apague os arquivos da pasta template.
 */

define('DEBUG_VIEW', 'template/debug');

/*
 * Você pode definir seu próprio modelo de página de erro 404, da mesma
 * forma que foi citado acima.
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

define('SESSION_LIFETIME', 7200); // 7200 = 2h

/*
 * ---------------------------------------------------------------------------
 * CONTROLADOR
 * --------------------------------------------------------------------------
 *
 * Você deve definir um controlador padrão para ser executado caso nenhum
 * controlador tenha sido informado na url do projeto.
 */

define('CONTROLLER_INDEX', 'Home');

/*
 * --------------------------------------------------------------------------
 * IDIOMA
 * --------------------------------------------------------------------------
 *
 * Você deve definir o idioma padrão da aplicação. Esta ação é útil para
 * ajudar o buscador a classificar seu site no idioma apropriado, orientar
 * os navegadores a exibir acentuação e caracteres especiais corretamente.
 *
 * Atenção: O idioma também é usado para fazer a tradução da aplicação.
 * Consulte a classe Lang na documentação para saber mais.
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
 *
 */

define('DEFAULT_LANGUAGE', 'pt-br');

/*
 * --------------------------------------------------------------------------
 * CRIPTOGRAFIA
 * --------------------------------------------------------------------------
 *
 * Para usar a classe Session ou Auth você deve definir uma chave para
 * criptografar os dados, uma sequência de caracteres que será usada
 * para identificar sua aplicação.
 *
 * Atenção: Se você já estiver usando a aplicação de exemplo com o framework
 * e alterar esta chave, você deverá redefinir a senha de todos os usuários
 * cadastrados. Para isso será necessário registrar um novo usuário e
 * efetuar o login novamente.
 */

define('ENCRYPTION_KEY', 'your_secret_key');

/*
 * --------------------------------------------------------------------------
 * BANCO DE DADOS
 * --------------------------------------------------------------------------
 *
 * Você deve definir as informações abaixo para fazer a conexão com o banco
 * de dados da sua aplicação.
 *
 * Atenção: Defina as informações corretamente, caso contrário, uma exceção
 * será lançada sempre que tentar executar uma operação de banco de dados
 * ou se estiver usando a aplicação de exemplo com o framework.
 *
 * Consulte os drivers disponíveis na documentação do PHP para fazer a
 * conexão com os diversos bancos de dados usando o PDO (PHP Data Objects).
 * Exemplo: use 'mysql' para Mysql ou 'pgsql' para Postgresql.
 */

define('DB_DRIVER'  , ''); // Informe o driver desejado para conectar-se ao banco.
define('DB_HOST'    , ''); // Informe o nome do servidor ou domínio. Ex: localhost.
define('DB_PORT'    , ''); // Informe a porta para conectar-se ao banco. Ex: 3306 (Mysql) ou 5432 (Postgresql).
define('DB_NAME'    , ''); // Informe o nome do banco que você criou para usar com a aplicação.
define('DB_USER'    , ''); // Informe o usuário para fazer a conexão com o banco.
define('DB_PASSWORD', ''); // Informe a senha do usuário definido acima.

/*
 * --------------------------------------------------------------------------
 * E-MAIL
 * --------------------------------------------------------------------------
 *
 * Defina as informações abaixo para enviar e-mails através da sua aplicação.
 *
 * Atenção: Certifique-se que o PHP instalado em seu servidor (local ou
 * remoto, como o seu servidor de hospedagem) está configurado corretamente
 * para enviar e-mails usando a função mail do PHP.
 */

define('MAIL_IS_HTML'   , true);
define('MAIL_CHARSET'   , ''); // utf-8
define('MAIL_FROM'      , ''); // user@domain.com
define('MAIL_SMTP_HOST' , ''); // smtp.domain.com
define('MAIL_SMTP_PORT' , ''); // 465
