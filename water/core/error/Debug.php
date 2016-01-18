<?php namespace core\error;

use core\base\Controller;
use core\base\View;
use core\utils\Session;

class Debug extends Controller
{
    private $data = [];

    public function __construct()
    {
        $this->data = [
            'title' => Session::get('app_error_title'),
            'code' => Session::get('app_error_code'),
            'message' => Session::get('app_error_message'),
            'file' => Session::get('app_error_file'),
            'line' => Session::get('app_error_line')
        ];

        if (Session::get('app_error_stop')) {
            Session::stop();
        }
    }

    public function index()
    {
        if (defined(DEBUG_VIEW)) {
            View::load(DEBUG_VIEW, $this->data);
        } else {
            // TODO: Create a default error template to use when it is not defined by user.
            View::load('template/debug', $this->data);
        }
    }
}
