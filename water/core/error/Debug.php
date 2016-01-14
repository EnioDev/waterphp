<?php namespace core\error;

use core\base\Controller;
use core\base\View;
use core\utils\Session;

class Debug extends Controller
{
    private $data = [];

    public function __construct()
    {
        $file = Session::get('debug_backtrace_file');
        $line = Session::get('debug_backtrace_line');

        $this->data = [
            'title' => Session::get('app_error_title'),
            'code' => Session::get('app_error_code'),
            'message' => Session::get('app_error_message'),
            'filename' => (($file) ? $file : Session::get('app_error_filename')),
            'line' => (($line) ? $line : Session::get('app_error_line'))
        ];

        if (Session::get('app_error_stop')) {
            Session::stop();
        }
    }

    public function index()
    {
        Session::forget('debug_backtrace_file');
        Session::forget('debug_backtrace_line');

        if (defined(DEBUG_VIEW)) {
            View::load(DEBUG_VIEW, $this->data);
        } else {
            // TODO: Create a default error template to use when it is not defined by user.
            View::load('template/debug', $this->data);
        }
    }
}