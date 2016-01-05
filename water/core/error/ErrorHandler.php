<?php namespace core\error;

use core\utils\Redirect;
use core\utils\Session;
use core\utils\Url;

final class ErrorHandler
{
    private $debug;
    private $title;
    private $stop;

    private function setTitle($code)
    {
        $this->debug = (bool) DEBUG_MODE;
        $this->title = '';
        $this->stop = false;

        switch ($code)
        {
            case E_ERROR:
            case E_USER_ERROR:
                $this->title = 'Fatal Error';
                $this->stop = true;
                break;

            case E_PARSE:
                $this->title = 'Parse Error';
                $this->stop = true;
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
                $this->title = 'Exception';
        }
    }

    // It will catch Warnings and Notices.
    // It will also catch E_USER_ERROR.
    public function waterErrorHandler($code, $message, $filename, $line)
    {
        $this->setTitle($code);

        $this->clearPrevious();

        Session::set('app_error_title', $this->title);
        Session::set('app_error_code', $code);
        Session::set('app_error_message', $message);
        Session::set('app_error_filename', $filename);
        Session::set('app_error_line', $line);
        Session::set('app_error_stop', $this->stop);

        $this->avoidTooManyRedirects($this->debug, $this->stop);
    }

    // It will always be called at the end of any script execution.
    // It will also catch Fatal Errors and Parse Errors.
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
        $this->setTitle($e->getCode());

        $this->clearPrevious();

        Session::set('app_error_title', $this->title);
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
            if (($debug and !$stop)) {
                // If it's a Warning or Notice.
                throw new \ErrorException($message, $code, 0, $filename, $line);
            } else if ($stop) {
                // If it's a Fatal Error or Parse Error.
                // If it's a Warning or Notice called by ErrorException.
                Redirect::to(Url::base('debug'));
            }
        } else {
            // On bootstrap or core files.
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