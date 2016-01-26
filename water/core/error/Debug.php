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
        // TODO: Create a default debug template to use when it is not defined by user.
        $view = (defined('DEBUG_VIEW') ? DEBUG_VIEW : 'template/debug');
        View::load($view, $this->data);
        exit();
    }
}
