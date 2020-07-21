<?php


namespace controllers;


//use Models\CommentManager;

abstract class Controller
{
    protected $model; //accessible dans la class même et la parente
	protected $modelName; //dans le tuto la class enfant ex: PostController prend "\Models\Article" (le chemin de class c'est chiant...)
	protected $modelJoinded;
	protected $modelJoindedName;
	//Prise en charge des entités
	/* protected $entity;
	protected $entityName; */

    public function __construct()
    {
		$this->model = new $this->modelName();
		$this->modelJoinded = new $this->modelJoindedName();
		/* $this->entity = new $this->entityName(); finalement non car constructeur intégré aux ()*/
    }
}
