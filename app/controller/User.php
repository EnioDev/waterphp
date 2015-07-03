<?php namespace controller;

use core\base\Auth;
use core\base\Redirect;
use core\base\View;
use core\base\Request;
use core\base\Controller;
use core\base\Encryption;
use core\base\String;
use model\User as UserModel;

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
        // Você pode chamar o construtor da classe Pai e definir
        // o modelo padrão para este controlador.
        // Para acessá-lo basta usar $this->model() e todos os
        // métodos do modelo estarão disponíveis.
        parent::__construct(new UserModel());

        // Para obter os textos armazenados no arquivo "strings.xml"
        // do idioma configurado na aplicação, use String::values()
        // e um objeto será retornado com o conteúdo do arquivo.
        // Consulte os arquivos em "public/values".
        $register = String::values()->user->buttons->register;

        // A classe Request permite capturar todos os dados
        // enviados via post para o controlador. Ex:
        // Request:all();
        // Request:get('input_name');
        $submit = Request::get('submit');

        $this->register = ($submit == $register) ? true : false;

        // Você pode usar Auth::user() para verificar se o
        // usuário está autenticado, caso contrário, você
        // pode redirecioná-lo para outra página.
        if (!Auth::user() and !$this->register) {
            Redirect::to(BASE_URL . 'login');
            exit;
        }

        $this->errors = [];
        $this->message = '';
    }

    public function index()
    {
        $this->message = String::values()->user->messages->welcome . ' ' . Auth::user()->name . '!';

        // Você pode usar View::load() e informar o nome do arquivo
        // (visão) que deseja carregar.
        // Você pode passar um array como segundo parâmetro com o
        // conteúdo que deseja recuperar na visão e acessá-los
        // pelo mesmo nome de variável.
        View::load('user/index', ['users' => $this->model()->all(), 'message' => $this->message]);
    }

    public function store()
    {
        $input = Request::all();

        if ($input)
        {
            // Filtrando os dados.
            $this->name = ucwords(strtolower(strip_tags($input['name'])));
            $this->email = strtolower(strip_tags(trim($input['email'])));
            $this->password = trim($input['password']);

            // Chama a função do controlador que valida os dados acima.
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

                // Verifica se o usuário já foi cadastrado.
                $user = null;
                if ($input['submit'] == String::values()->user->buttons->update) {
                    $user = $this->model()->find($input['id']);
                }

                // Se o usuário foi encontrado, então atualiza os dados no banco.
                if ($user) {
                    $response = $this->model()->update($input['id'], $data);
                    if ($response) {
                        $this->message = String::values()->user->messages->update;
                    } else {
                        array_push($this->errors, String::values()->user->errors->update);
                    }
                // Senão insere o novo usuário no banco.
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

        $view = ($this->register) ? 'user/register' : 'user/index';
        View::load($view, ['users' => $this->model()->all(), 'message' => $this->message, 'errors' => $this->errors]);
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
        // Valida o campo nome.
        if (!filter_var($this->name, FILTER_SANITIZE_STRING)) {
            array_push($this->errors, String::values()->user->errors->name_string);
        } else {
            if (strlen($this->name) < 5 or strlen($this->name) > 50) {
                array_push($this->errors, String::values()->user->errors->name_length);
            }
        }

        // Valida o campo email.
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, String::values()->user->errors->email);
        }

        // Valida o campo senha.
        if (preg_match('/[^A-Za-z0-9_]/', $this->password)) {
            array_push($this->errors, String::values()->user->errors->password_filter);
        }
        if (strlen($this->password) < 6 or strlen($this->password) > 20) {
            array_push($this->errors, String::values()->user->errors->password_length);
        }

        // Se não houver erros, retorna "true" para prosseguir o cadastro.
        return (count($this->errors) > 0) ? false : true;
    }
}