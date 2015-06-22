<?php namespace core\base;

// TODO: Melhorar tratamento de erro. Criar handler para tratar erros e exceções.
class Error extends Controller {

    private $title;
    private $message;
    private $template;
    private $debug;
    private $type;

    public function __construct($type = 0)
    {
        $this->title = 'Unknowing Error';
        $this->message = 'Sorry! A unknowing error occurred.';
        $this->template = 'error/default';
        $this->debug = ini_get('display_errors');
        $this->type = $type;
    }

    public function show()
    {
        $this->index();
    }

    public function index()
    {
        // Debug mode needs be set in application config file.
        if ($this->debug or !$this->type) {
            $this->view($this->template, ['title' => $this->title, 'message' => $this->message]);
            exit;
        }
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setTemplate($view)
    {
        $this->template = $view;
    }
}