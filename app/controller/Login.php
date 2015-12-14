<?php namespace controller;

use core\base\Controller;
use core\base\View;
use core\utils\Auth;
use core\utils\Encryption;
use core\utils\Redirect;
use core\utils\Request;
use core\utils\Lang;
use core\utils\Url;

class Login extends Controller {

    public function index()
    {
        $input = Request::all();

        if (isset($input['email']) and isset($input['password']))
        {
            $values = [
                $input['email'],
                Encryption::encode($input['password'])
            ];

            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";

            $model = $this->loadModel('User');
            $user = $model->query($sql, $values);

            if ($user) {
                Auth::make($user);
                Redirect::to(Url::route('user'));
            } else {
                View::load('user/login', ['error' => Lang::strings()->error->login]);
            }
        } else {
            View::load('user/login');
        }
    }
}
