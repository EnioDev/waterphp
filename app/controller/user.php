<?php namespace controller;

use core\base\Auth;
use core\base\Request;
use core\base\Controller;
use core\base\Encryption;
use model\User as Model;

class User extends Controller
{
    private $errors;
    private $message;

    private $name;
    private $email;
    private $password;

    private $register;

    function __construct()
    {
        // Calls the parent construct and pass to it
        // the default model to be used in this controller.
        // Ex: $this->model().
        parent::__construct(new Model());

        $btnRegister = $this->strings()->user->buttons->register;
        $submitValue = Request::get('submit');

        $this->register = ($submitValue == $btnRegister) ? true : false;

        // You can use "Auth::user()" to verify the user
        // authentication. Then if the user is not authenticate,
        // any method will be executed and the user will be
        // redirect to login page.
        if (!Auth::user() and !$this->register) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $this->errors = [];
        $this->message = '';
    }

    public function index()
    {
        $this->message = $this->strings()->user->messages->welcome . ' ' . Auth::user()->name . '!';
        $this->view('user/index', ['message' => $this->message]);
    }

    public function store()
    {
        // You can use Request::all() to retrieve all posted data
        // or Request::get($key) to retrieve a specific data.
        // For more information see the Request class.
        $input = Request::all();

        if ($input)
        {
            $this->name = ucwords(strtolower(strip_tags($input['name'])));
            $this->email = strtolower(strip_tags(trim($input['email'])));
            $this->password = trim($input['password']);

            // Calls the user validator method.
            if ($this->validator())
            {
                $data = [
                    'fields' => [
                        Model::COLUMN_NAME,
                        Model::COLUMN_EMAIL,
                        Model::COLUMN_PASSWD
                    ],
                    'values' => [
                        $this->name,
                        $this->email,
                        Encryption::make($this->password)
                    ]
                ];

                $user = null;

                if ($input['submit'] == $this->strings()->user->buttons->update)
                {
                    $user = $this->model()->find($input['id']);
                }

                if ($user) {
                    // Updates the user.
                    $response = $this->model()->update($input['id'], $data);
                    if ($response) {
                        $this->message = $this->strings()->user->messages->update;
                    } else {
                        array_push($this->errors, $this->strings()->user->errors->update);
                    }
                } else {
                    // Creates new user.
                    $response = $this->model()->insert($data);
                    if ($response) {
                        $this->message = $this->strings()->user->messages->create;
                    } else {
                        array_push($this->errors, $this->strings()->user->errors->insert);
                    }
                }
            }
        }

        $view = ($this->register) ? 'user/register' : 'user/index';
        $this->view($view, ['message' => $this->message, 'errors' => $this->errors]);
    }

    public function edit($id = null)
    {
        if ($id) {
            $user = $this->model()->find($id);
            $user->password = Encryption::undo($user->password);
        }
        $this->view('user/index', ['user' => $user]);
    }

    public function destroy()
    {
        $input = Request::all();
        if ($input) {
            $id = $input['id'];
            if (!$this->model()->delete($id)) {
                array_push($this->errors, $this->strings()->user->errors->delete);
            }
        }
        $this->view('user/index', ['errors' => $this->errors]);
    }

    private function validator()
    {
        // Name
        if (!filter_var($this->name, FILTER_SANITIZE_STRING)) {
            array_push($this->errors, $this->strings()->user->errors->name_string);
        } else {
            if (strlen($this->name) < 5 or strlen($this->name) > 50) {
                array_push($this->errors, $this->strings()->user->errors->name_length);
            }
        }
        // Email
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, $this->strings()->user->errors->email);
        }
        // Password
        if (preg_match('/[^A-Za-z0-9_]/', $this->password)) {
            array_push($this->errors, $this->strings()->user->errors->password_filter);
        }
        if (strlen($this->password) < 6 or strlen($this->password) > 20) {
            array_push($this->errors, $this->strings()->user->errors->password_length);
        }

        return (count($this->errors) > 0) ? false : true;
    }
}