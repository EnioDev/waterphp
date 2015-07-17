<?php namespace core\error;

use core\utils\Session;
use core\utils\View;
use core\base\Controller;

class Debug extends Controller
{
    private $data = [];

    public function __construct()
    {
        $this->data = [
            'title' => Session::get('app_error_title'),
            'code' => Session::get('app_error_code'),
            'message' => Session::get('app_error_message'),
            'filename' => Session::get('app_error_filename'),
            'line' => Session::get('app_error_line')
        ];
        if (Session::get('app_error_exit')) {
            Session::stop();
        }
    }

    public function index()
    {
        View::load(DEBUG_VIEW, $this->data);
    }
}