<?php namespace controller;

use core\base\Controller;
use core\base\View;

class Home extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        View::load('home/welcome');
    }
}