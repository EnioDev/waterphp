<?php namespace core\base;

final class Error
{
    public function waterErrorHandler($code, $message, $filename, $line)
    {
        $debug = ini_get('display_errors');
        $stop = false;

        switch ($code)
        {
            case E_ERROR:
            case E_USER_ERROR:
                $title = 'Fatal Error';
                $debug = true;
                $stop = true;
                break;

            case E_PARSE:
                $title = 'Parse Error';
                $debug = true;
                $stop = true;
                break;

            case E_WARNING:
            case E_USER_WARNING:
                $title = 'Warning';
                break;

            case E_NOTICE:
            case E_USER_NOTICE:
                $title = 'Notice';
                break;

            default:
                $title = 'Unknowing Error';
        }

        $_SESSION['app_error_title'] = $title;
        $_SESSION['app_error_code'] = $code;
        $_SESSION['app_error_message'] = $message;
        $_SESSION['app_error_filename'] = $filename;
        $_SESSION['app_error_line'] = $line;
        $_SESSION['app_error_stop'] = $stop;

        if ($debug) {
            Redirect::to(BASE_URL . 'debug/error');
        }

        return true;
    }

    public function waterShutdownHandler()
    {
        $e = error_get_last();
        if (count($e) == 0 or $e['type'] == '') {
            return false;
        }
        return $this->waterErrorHandler($e['type'], $e['message'], $e['file'], $e['line']);
    }

    public function waterExceptionHandler($e)
    {
        $_SESSION['app_error_title'] = 'Exception';
        $_SESSION['app_error_code'] = $e->getCode();
        $_SESSION['app_error_message'] = $e->getMessage();
        $_SESSION['app_error_filename'] = $e->getFile();
        $_SESSION['app_error_line'] = $e->getLine();

        Redirect::to(BASE_URL . 'debug/error');
    }
}