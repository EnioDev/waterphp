<?php namespace controller;

use core\base\Auth;
use core\base\Redirect;
use core\base\View;
use core\base\Request;
use core\base\Controller;
use core\base\Encryption;
use core\base\String;
use model\User;

class UserController extends Controller
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
        // o modelo que será usado por este controlador.
        // Para acessá-lo basta usar $this->model().
        // Veja os exemplos nos métodos abaixo.
        parent::__construct(new User());

        // Para obter os textos do idioma configurado na aplicação,
        // use String::values() e um objeto será retornado com toda
        // a informação contida no arquivo strings.xml.
        // Consulte os arquivos em "public/values".
        $register = String::values()->user->buttons->register;

        // A classe Request permite capturar todos os dados
        // enviados via post para o controlador.
        // Veja mais exemplos nos métodos abaixo.
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

        // Use View::load para carregar uma visão.
        // Você pode passar um array com o conteúdo que deseja
        // recuperar na visão e acessá-los pelo mesmo nome de variável.
        $data = [
            'users' => $this->model()->all(),
            'message' => $this->message
        ];
        View::load('user/index', $data);
    }

    public function store()
    {
        $input = Request::all();

        if ($input)
        {
            $id = $input['id'];

            // Filtrando os dados.
            $this->name = ucwords(strtolower(strip_tags($input['name'])));
            $this->email = strtolower(strip_tags(trim($input['email'])));
            $this->password = trim($input['password']);

            // Chama a função do controlador que valida os dados acima.
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

                // Verifica se o usuário foi cadastrado anteriormente.
                $user = null;
                if ($input['submit'] == String::values()->user->buttons->update)
                {
                    $user = $this->model()->find($id);
                }

                // Se o usuário foi encontrado, então atualiza os dados no banco.
                if ($user) {
                    $response = $this->model()->update($id, $data);
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

        // Verifica se a função está sendo chamada do formulário de
        // registro ou da página de usuários cadastrados.
        $view = ($this->register) ? 'user/register' : 'user/index';

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
        // Valida o campo nome.
        if (!filter_var($this->name, FILTER_SANITIZE_STRING)) {
            array_push($this->errors, String::values()->user->errors->name_string);
        }
        if (strlen($this->name) < 5 or strlen($this->name) > 50) {
            array_push($this->errors, String::values()->user->errors->name_length);
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