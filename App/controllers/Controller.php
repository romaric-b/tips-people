<?php


namespace Controllers;


//use Models\CommentManager;

abstract class Controller
{
    protected $model; //accessible dans la class même et la parente
    protected $modelName; //dans le tuto la class enfant ex: PostController prend "\Models\Article" (le chemin de class c'est chiant...)

    public function __construct()
    {
        $this->model = new $this->modelName();
    }
}