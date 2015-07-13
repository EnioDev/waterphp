<?php namespace controller;

use core\base\Controller;
use core\utils\View;

class Register extends Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        View::load('user/register');
    }
}