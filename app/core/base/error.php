<?php namespace core\base;

final class Error
{
    public function waterErrorHandler($code, $message, $filename, $line)
    {
        $debug = ini_get('display_errors');
        $image = 'images/fire.png';

        switch ($code)
        {
            case E_ERROR:
            case E_USER_ERROR:
                $title = 'Fatal Error';
                $debug = true;
                Session::stop();
                break;

            case E_PARSE:
                $title = 'Parse Error';
                $debug = true;
                Session::stop();
                break;

            case E_WARNING:
            case E_USER_WARNING:
                $title = 'Warning';
                $image = 'images/attention.png';
                break;

            case E_NOTICE:
            case E_USER_NOTICE:
                $title = 'Notice';
                $image = 'images/attention.png';
                break;

            default:
                $title = 'Unknowing Error';
        }

        $data = [
            'title'=> $title,
            'code' => $code,
            'message' => $message,
            'filename' => $filename,
            'line' => $line,
            'image' => $image
        ];

        // TODO: A view deve abrir em outra pagina quando for um erro.
        if ($debug) { View::load('template/error', $data); }

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
        $data = [
            'title' => 'Exception',
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'filename' => $e->getFile(),
            'line' => $e->getLine(),
            'image' => 'images/attention.png'
        ];

        View::load('template/error', $data);
    }
}