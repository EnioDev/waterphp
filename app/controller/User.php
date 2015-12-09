<?php namespace controller;

use core\base\Controller;
use core\base\View;
use core\utils\Auth;
use core\utils\Encryption;
use core\utils\Redirect;
use core\utils\Request;
use core\utils\Session;
use core\utils\String;
use core\utils\Url;
use model\User as UserModel;

class User extends Controller
{
    private $errors;
    private $message;

    private $name;
    private $email;
    private $password;

    function __construct()
    {
        // Define o modelo que será usado no controlador.
        parent::__construct('User');

        $this->errors = [];
        $this->message = '';

        // Verifica se o submit foi feito do formulário de registro.
        $register = (Request::get('submit') == String::values()->user->buttons->register) ? true : false;

        // Se o usuário não estiver autenticado.
        if (!Auth::user()) {
            // E não está registrando um novo usuário.
            if (!$register) {
                // Então redireciona para a página de login.
                // Obs.: Isto evita que alguém acesse a aplicação ou execute qualquer
                // método do controlador digitando a url sem estar autenticado.
                Redirect::to(Url::route('login'));
                exit;
            }
        }
    }

    private function users()
    {
        // Seleciona todos os usuários e ordena por nome em ordem crescente.
        $users = $this->model()->all('name', 'asc');
        return $users;
    }

    public function index()
    {
        $this->message = String::values()->user->messages->welcome . ' ' . Auth::user()->name . '!';

        $data = [
            'users' => $this->users(),
            'message' => $this->message
        ];
        View::load('user/index', $data);
    }

    public function cancel()
    {
        $data = ['users' => $this->users()];
        View::load('user/index', $data);
    }

    public function store()
    {
        $input = Request::all();

        if ($input)
        {
            // Filtra os dados recebidos do formulário.
            $this->name = ucwords(strtolower(strip_tags(trim($input['name']))));
            $this->email = strtolower(strip_tags(trim($input['email'])));
            $this->password = trim($input['password']);

            // Chama a função que faz a validação dos dados.
            if ($this->validator())
            {
                $data = [
                    'fields' => [
                        UserModel::COLUMN_NAME,
                        UserModel::COLUMN_EMAIL,
                        UserModel::COLUMN_PASSWD
                    ],
                    'values' => [
                        $this->name,
                        $this->email,
                        Encryption::encode($this->password)
                    ]
                ];

                // Verifica se está atualizando um usuário existente...
                if ($input['submit'] == String::values()->user->buttons->update)
                {
                    $id = $input['id'];
                    $user = $this->model()->find($id);

                    if ($user)
                    {
                        $response = $this->model()->update($id, $data);
                        if ($response) {
                            $this->message = String::values()->user->messages->update;
                        } else {
                            array_push($this->errors, String::values()->user->errors->update);
                        }
                    }
                // ... Caso contrário insere o novo usuário.
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

        // Verifica se a função foi chamada pelo formulário de registro.
        $register = ($input['submit'] == String::values()->user->buttons->register) ? true : false;

        // Então define a visão.
        $view = ($register) ? 'user/register' : 'user/index';

        $data = [
            'users' => $this->users(),
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
        View::load('user/index', ['users' => $this->users(), 'user' => $user]);
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
        View::load('user/index', ['users' => $this->users(), 'errors' => $this->errors]);
    }

    private function validator()
    {
        // Campo Nome
        if (!filter_var($this->name, FILTER_SANITIZE_STRING)) {
            array_push($this->errors, String::values()->user->errors->name_filter);
        }
        if (strlen($this->name) < 5 or strlen($this->name) > 50) {
            array_push($this->errors, String::values()->user->errors->name_length);
        }

        // Campo E-mail
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, String::values()->user->errors->email_filter);
        }

        // Campo Senha
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