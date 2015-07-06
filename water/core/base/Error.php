<?php namespace core\base;

final class Error
{
    private $title = null;
    
    public function waterErrorHandler($code, $message, $filename, $line)
    {
        $debug = ini_get('display_errors');
        $stop = false;
        $exception = false;

        switch ($code)
        {
            case E_ERROR:
            case E_USER_ERROR:
                $this->title = 'Fatal Error';
                $debug = true;
                $stop = true;
                break;

            case E_PARSE:
                $this->title = 'Parse Error';
                $debug = true;
                break;

            case E_WARNING:
            case E_USER_WARNING:
                $this->title = 'Warning';
                $exception = true;
                break;

            case E_NOTICE:
            case E_USER_NOTICE:
                $this->title = 'Notice';
                $exception = true;
                break;

            default:
                $this->title = 'Unknowing Error';
        }

        $_SESSION['app_error_title'] = $this->title;
        $_SESSION['app_error_code'] = $code;
        $_SESSION['app_error_message'] = $message;
        $_SESSION['app_error_filename'] = $filename;
        $_SESSION['app_error_line'] = $line;
        $_SESSION['app_error_fatal'] = $stop;

        if ($debug and $exception) {
            throw new \ErrorException($message, $code, 0, $filename, $line);
        } else if ($debug) {
            Redirect::to(BASE_URL . 'debug');
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
        $_SESSION['app_error_title'] = ($this->title) ? $this->title : 'Exception';
        $_SESSION['app_error_code'] = $e->getCode();
        $_SESSION['app_error_message'] = $e->getMessage();
        $_SESSION['app_error_filename'] = $e->getFile();
        $_SESSION['app_error_line'] = $e->getLine();

        Redirect::to(BASE_URL . 'debug');
    }
}