<?php namespace controller;

use core\base\Controller;
use core\base\Redirect;
use core\base\Session;
use core\base\View;

class Debug extends Controller
{
    private $view;

    public function index()
    {
        $this->view = 'template/error';

        if (Session::get('app_error_message'))
        {
            $data = [
                'title' => Session::get('app_error_title'),
                'code' => Session::get('app_error_code'),
                'message' => Session::get('app_error_message'),
                'filename' => Session::get('app_error_filename'),
                'line' => Session::get('app_error_line')
            ];

            View::load($this->view, $data);

            if (Session::get('app_error_fatal')) {
                Session::stop();
            }
        } else {
            Redirect::to(BASE_URL . 'login');
        }
    }
}