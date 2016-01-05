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
        $stop  = false;

        switch ($code)
        {
            case E_ERROR:
            case E_USER_ERROR:
                $this->title = 'Fatal Error';
                $stop = true;
                break;

            case E_PARSE:
                $this->title = 'Parse Error';
                $stop = true;
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

        $this->clearPrevious();

        Session::set('app_error_title', $this->title);
        Session::set('app_error_code', $code);
        Session::set('app_error_message', $message);
        Session::set('app_error_filename', $filename);
        Session::set('app_error_line', $line);
        Session::set('app_error_stop', $stop);

        $this->avoidTooManyRedirects($debug, $stop);
    }

    public function waterShutdownHandler()
    {
        $e = error_get_last();
        if (count($e) == 0 or (isset($e['type']) and $e['type'] == '')) {
            return false;
        }
        $this->waterErrorHandler($e['type'], $e['message'], $e['file'], $e['line']);
        return true;
    }

    public function waterExceptionHandler($e)
    {
        $title = ($this->title) ? $this->title : 'Exception';

        $this->clearPrevious();

        Session::set('app_error_title', $title);
        Session::set('app_error_code', $e->getCode());
        Session::set('app_error_message', $e->getMessage());
        Session::set('app_error_filename', $e->getFile());
        Session::set('app_error_line', $e->getLine());

        $this->avoidTooManyRedirects(true, true);
    }

    private function avoidTooManyRedirects($debug, $stop)
    {
        $code = Session::get('app_error_code');
        $message = Session::get('app_error_message');
        $filename = Session::get('app_error_filename');
        $line = Session::get('app_error_line');

        $noRedirect = 0;

        $noRedirect += (strrpos($filename, 'public' . DS . 'index.php')) ? 1 : 0;
        $noRedirect += (strrpos($filename, 'config' . DS . 'config.php')) ? 1 : 0;
        $noRedirect += (strrpos($filename, 'config' . DS . 'routes.php')) ? 1 : 0;
        $noRedirect += (strrpos($filename, 'water'  . DS . 'core')) ? 1 : 0;

        if(!$noRedirect) {
            // Warning or Notice
            if (($debug and !$stop)) {
                throw new \ErrorException($message, $code, 0, $filename, $line);
            // Fatal Error or Parse Error
            } else if ($stop) {
                Redirect::to(Url::base('debug'));
            }
        } else {
            // On bootstrap or core files
            if ($debug or $stop) {
                $d = new Debug();
                $d->index();
                exit();
            }
        }
    }

    private function clearPrevious()
    {
        Session::forget('app_error_title');
        Session::forget('app_error_code');
        Session::forget('app_error_message');
        Session::forget('app_error_filename');
        Session::forget('app_error_line');
        Session::forget('app_error_stop');
    }
}