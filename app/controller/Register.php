<?php namespace controller;

use core\base\Controller;
use core\base\View;

class Register extends Controller {

    public function index()
    {
        View::load('user/register');
    }
}