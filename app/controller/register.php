<?php namespace controller;

use core\base\Controller;

class Register extends Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view('user/register');
    }
}