<?php namespace core\error;

use core\utils\Redirect;
use core\utils\Session;
use core\utils\Url;

final class ErrorHandler
{
    private $title = null;

    public function waterErrorHandler($code, $message, $filename, $line)
    {
        $debug = (bool) DEBUG_MODE;
        $exit = false;

        switch ($code)
        {
            case E_ERROR:
            case E_USER_ERROR:
                $this->title = 'Fatal Error';
                $exit = true;
                break;

            case E_PARSE:
                $this->title = 'Parse Error';
                $exit = true;
                break;

            case E_WARNING:
            case E_USER_WARNING:
                $this->title = 'Warning';
                break;

            case E_NOTICE:
            case E_USER_NOTICE:
                $this->title = 'Notice';
                break;

            default:
                $this->title = 'Unknowing Error';
        }

        $this->forgetAll();

        Session::set('app_error_title', $this->title);
        Session::set('app_error_code', $code);
        Session::set('app_error_message', $message);
        Session::set('app_error_filename', $filename);
        Session::set('app_error_line', $line);
        Session::set('app_error_exit', $exit);

        if (($debug and !$exit)) {
            throw new \ErrorException($message, $code, 0, $filename, $line);
        } else if ($exit) {
            Redirect::to(Url::base('debug'));
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
        $title = ($this->title) ? $this->title : 'Exception';

        $this->forgetAll();

        Session::set('app_error_title', $title);
        Session::set('app_error_code', $e->getCode());
        Session::set('app_error_message', $e->getMessage());
        Session::set('app_error_filename', $e->getFile());
        Session::set('app_error_line', $e->getLine());

        Redirect::to(Url::base('debug'));
    }

    private function forgetAll()
    {
        Session::forget('app_error_title');
        Session::forget('app_error_code');
        Session::forget('app_error_message');
        Session::forget('app_error_filename');
        Session::forget('app_error_line');
        Session::forget('app_error_exit');
    }
}