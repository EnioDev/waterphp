<?php namespace core\error;

use core\base\Session;
use core\base\View;
use core\base\Redirect;
use core\base\Controller;

class Debug extends Controller
{
    public function index()
    {
        if (Session::get('app_error_message'))
        {
            $data = [
                'title' => Session::get('app_error_title'),
                'code' => Session::get('app_error_code'),
                'message' => Session::get('app_error_message'),
                'filename' => Session::get('app_error_filename'),
                'line' => Session::get('app_error_line')
            ];

            View::load(DEBUG_VIEW, $data);

            if (Session::get('app_error_exit')) {
                Session::stop();
            }
        } else {
            Redirect::to(BASE_URL . 'login');
        }
    }
}