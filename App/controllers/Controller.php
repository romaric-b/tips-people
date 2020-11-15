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
	}

	/**
	 * Create a comment or a post
	 *
	 * @return void
	 */
	/* public function insert()
	{
		//TODO a virer à la fin si inutile
	} */

	/**
	 * Read all items
	 *
	 * @return void
	 */
	public function dashboard()
	{
		if($this->modelName === '\models\User')
		{
			$items = $this->model->findAll();
			$pageTitle = "Gestion des membres";
			$description = "Administration et modération des membres";
			$path = 'user/dashboard';
		}
		elseif($this->modelName === '\models\Post')
		{
			$items = $this->model->findAllWithTheirAuthor();
			
			$pageTitle = "Gestion des articles";
			$description = "Administration et modération des articles";
			$path = 'post/dashboard';
		}
		elseif($this->modelName === '\models\Comment')
		{
			$items = $this->model->findAllWithTheirAuthor('c_id = ?', "");

			$pageTitle = "Gestion des commentaires";
			$description = "Administration et modération des commentaires";
			$path = 'comment/dashboard';
		}

		\Renderer::render($path, compact('pageTitle', 'description', 'items'));
	}
	
	/**
	 * Delete an item of platform
	 *
	 * @return void
	 */
	public function delete()
    {
		if($this->modelName === '\models\User')
		{
			$this->model->delete('u_id', $_GET['id']);

			$information = "Ce membre est banni";
		}
		elseif($this->modelName === '\models\Post')
		{
			$this->model->delete('p_id', $_GET['id']);

			$information = "Cet article est supprimé";
		}
		elseif($this->modelName === '\models\Comment')
		{
			$this->model->delete('c_id', $_GET['id']);

			$information = "Ce commentaire est supprimé";
		}

		$pageTitle = "Demande prise en compte";
		$description = "Suppression de la base effectuée";		

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
    }
}
