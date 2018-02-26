<?php
namespace DroplineMVC\Controllers;

use DroplineMVC\Core\Controller;
use DroplineMVC\Core\View;

class Home extends Controller
{
    protected function index()
    {
        $model = new \DroplineMVC\Models\Home();
        View::render($this->className, $this->action, $model->index(), true);
    }
}