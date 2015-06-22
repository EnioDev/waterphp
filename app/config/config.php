<?php

/*
 * --------------------------------------------------------------------------
 * DEBUG MODE
 * --------------------------------------------------------------------------
 *
 * You can active or disable debug mode to help you with development.
 * 0 or false = Disabled
 * 1 or true = Enabled
 *
 */
define('DEBUG_MODE', 0);

/*
 * --------------------------------------------------------------------------
 * LANGUAGE
 * --------------------------------------------------------------------------
 *
 * You can set the application language, like 'en', 'pt-br'.
 * For more information see the HTML structure for the attribute "lang"
 * used in "meta tag" at HTML header.
 * If you want to use internacionalization (i18n), you need define
 * strings.xml file contents in "public/values/language" folder to make
 * application translation.
 *
 */
define('APP_LANGUAGE', 'en');

/*
 * --------------------------------------------------------------------------
 * SESSION
 * --------------------------------------------------------------------------
 *
 * You can set SESSION_MAX_LIFETIME in seconds to stop the application if
 * the user is inactive over this time.
 * If you want to stop the application even that the user is active,
 * you can set SESSION_TIMEOUT in seconds to do that.
 *
 */
define('SESSION_MAX_LIFETIME', '7200');
define('SESSION_TIMEOUT', '0');

/*
 * ---------------------------------------------------------------------------
 * CONTROLLER
 * --------------------------------------------------------------------------
 *
 * You must set the controller name to use as default route if no
 * controller name is given on the url.
 * Default is "Home" controller, but if you want to define other,
 * you are able to do that.
 *
 */
define('DEFAULT_CONTROLLER', 'Home');

/*
 * --------------------------------------------------------------------------
 * ENCRYPTION
 * --------------------------------------------------------------------------
 *
 * If you use the Encryption class, you must set an encryption key.
 *
 * PS: If you are using the "crud example", you must be logged in before
 * you change the key. Then, before you log off, you must edit the user's
 * password to encrypt again.
 *
 */
define('ENCRYPTION_KEY', 'RxRe4g50fxD33dx049xrg432pp030Tix');

/*
 * --------------------------------------------------------------------------
 * DATABASE
 * --------------------------------------------------------------------------
 *
 * Here you can define the settings needed to access your database.
 *
 * If you want to use the "crud example", please consult the installation
 * guide (install.txt) in your project root directory.
 *
 */
define('DB_DRIVE'   , 'mysql');
define('DB_HOST'    , 'localhost');
define('DB_NAME'    , 'water');
define('DB_USER'    , 'root');
define('DB_PASSWORD', 'root');
define('DB_CHARSET' , 'utf8');

/*
 * --------------------------------------------------------------------------
 * MAIL
 * --------------------------------------------------------------------------
 *
 * If you want to use the Mail class, you need define these constants:
 *
 * MAIL_IS_HTML = set true if you want to use HTML format.
 * MAIL_CHARSET = you can define the email charset (like utf-8 or iso-8859-1).
 * MAIL_FROM = the email address of the user who is sending the message.
 * MAIL_SMTP_HOST = the hostname of your email server.
 * MAIL_SMTP_PORT = the port of your email server.
 *
 * PS: This class methods will work in your "localhost" if you have a
 * email server configured.
 *
 */

define('MAIL_IS_HTML'   , true);
define('MAIL_CHARSET'   , 'iso-8859-1');
define('MAIL_FROM'      , ''); // user@domain.com
define('MAIL_SMTP_HOST' , ''); // ssl://smtp.gmail.com
define('MAIL_SMTP_PORT' , 25); // 465
