<?php namespace controller;

use core\base\Controller;

class Home extends Controller {

    public function index()
    {
        $this->view('home/welcome');
    }
}