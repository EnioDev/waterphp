<?php namespace controller;

use core\base\Controller;
use core\base\Auth;
use core\base\Request;
use core\base\Session;
use core\base\Encryption;
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
                    Encryption::make($input['password'])
                ]
            ];

            $user = $this->model()->where($args);

            if ($user) {
                Auth::make($user);
                header('Location: ' . BASE_URL . 'user');
            } else {
                $this->view('user/login', ['error' => $this->strings()->user->login->error]);
            }
        } else {
            Session::stop();
            $this->view('user/login');
        }
    }
}