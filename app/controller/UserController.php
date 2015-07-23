<?php namespace controller;

use core\base\Controller;
use core\utils\Auth;
use core\utils\Redirect;
use core\utils\Session;
use core\utils\View;
use core\utils\Url;
use core\utils\Request;
use core\utils\Encryption;
use core\utils\String;
use model\User;

class UserController extends Controller
{
    private $errors;
    private $message;

    private $name;
    private $email;
    private $password;

    function __construct()
    {
        parent::__construct(new User());

        $this->errors = [];
        $this->message = '';

        $register = (Request::get('submit') == String::values()->user->buttons->register) ? true : false;

        if (!Auth::user() and !$register) {
            Redirect::to(Url::route('login'));
            exit;
        }
    }

    public function index()
    {
        $this->message = String::values()->user->messages->welcome . ' ' . Auth::user()->name . '!';

        $data = [
            'users' => $this->model()->all(),
            'message' => $this->message
        ];
        View::load('user/index', $data);
    }

    public function cancel()
    {
        $data = [
            'users' => $this->model()->all()
        ];
        View::load('user/index', $data);
    }

    public function store()
    {
        $input = Request::all();

        if ($input)
        {
            $this->name = ucwords(strtolower(strip_tags(trim($input['name']))));
            $this->email = strtolower(strip_tags(trim($input['email'])));
            $this->password = trim($input['password']);

            if ($this->validator())
            {
                $data = [
                    'fields' => [
                        User::COLUMN_NAME,
                        User::COLUMN_EMAIL,
                        User::COLUMN_PASSWD
                    ],
                    'values' => [
                        $this->name,
                        $this->email,
                        Encryption::encode($this->password)
                    ]
                ];

                $user = null;

                if ($input['submit'] == String::values()->user->buttons->update)
                {
                    $id = $input['id'];
                    $user = $this->model()->find($id);
                }

                if ($user)
                {
                    $response = $this->model()->update($id, $data);
                    if ($response) {
                        $this->message = String::values()->user->messages->update;
                    } else {
                        array_push($this->errors, String::values()->user->errors->update);
                    }

                } else {
                    $response = $this->model()->insert($data);
                    if ($response) {
                        $this->message = String::values()->user->messages->create;
                    } else {
                        array_push($this->errors, String::values()->user->errors->insert);
                    }
                }
            }
        }

        $register = ($input['submit'] == String::values()->user->buttons->register) ? true : false;

        $view = ($register) ? 'user/register' : 'user/index';

        $data = [
            'users' => $this->model()->all(),
            'message' => $this->message,
            'errors' => $this->errors
        ];

        View::load($view, $data);
    }

    public function edit($id = null)
    {
        $user = null;
        if ($id) {
            $user = $this->model()->find($id);
            $user->password = Encryption::decode($user->password);
        }
        View::load('user/index', ['users' => $this->model()->all(), 'user' => $user]);
    }

    public function destroy()
    {
        $input = Request::all();
        if ($input) {
            $id = $input['id'];
            if (!$this->model()->delete($id)) {
                array_push($this->errors, String::values()->user->errors->delete);
            }
        }
        View::load('user/index', ['users' => $this->model()->all(), 'errors' => $this->errors]);
    }

    private function validator()
    {
        // NAME
        if (!filter_var($this->name, FILTER_SANITIZE_STRING)) {
            array_push($this->errors, String::values()->user->errors->name_filter);
        }
        if (strlen($this->name) < 5 or strlen($this->name) > 50) {
            array_push($this->errors, String::values()->user->errors->name_length);
        }

        // EMAIL
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, String::values()->user->errors->email_filter);
        }

        // PASSWORD
        if (preg_match('/[^A-Za-z0-9_]/', $this->password)) {
            array_push($this->errors, String::values()->user->errors->password_filter);
        }
        if (strlen($this->password) < 6 or strlen($this->password) > 20) {
            array_push($this->errors, String::values()->user->errors->password_length);
        }

        return (count($this->errors) > 0) ? false : true;
    }

    public function logout()
    {
        Session::stop();
        Redirect::to(Url::route('login'));
    }
}