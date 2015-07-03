<?php namespace controller;

use core\base\Auth;
use core\base\Controller;
use core\base\Encryption;
use core\base\Request;
use core\base\Redirect;
use core\base\Session;
use core\base\String;
use core\base\View;
use model\User;

class Login extends Controller {

    public function __construct()
    {
        parent::__construct(new User());
    }

    public function index()
    {
        $input = Request::all();

        if (isset($input['email']) and isset($input['password'])) {
            $args = [
                'fields' => [
                    User::COLUMN_EMAIL,
                    User::COLUMN_PASSWD
                ],
                'values' => [
                    $input['email'],
                    Encryption::encode($input['password'])
                ]
            ];

            $user = $this->model()->where($args);

            if ($user) {
                Auth::make($user);
                Redirect::to(BASE_URL . 'user');
            } else {
                View::load('user/login', ['error' => String::values()->user->login->error]);
            }
        } else {
            Session::stop();
            View::load('user/login');
        }
    }
}