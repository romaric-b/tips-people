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
		if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0)
        {
            $_GET['page'] = intval($_GET['page']); //return an entier value
            $currentPage = $_GET['page'];
        }
        else
        {
            $currentPage = 1;
		}
		$itemPerpage = 5;
		$start = ($currentPage - 1)*$itemPerpage;

		if($this->modelName === '\models\User')
		{
			$totalItems = count($this->model->findAll());
			$items = $this->model->countItems($start, $itemPerpage, 'u_datetime');
			
			$pageTitle = "Gestion des membres";
			$description = "Administration et modération des membres";
			$path = 'user/dashboard';
			
		}
		elseif($this->modelName === '\models\Post')
		{
			$totalItems = count($this->model->findAllWithTheirAuthor());
			$items = $this->model->countItems($start, $itemPerpage, "p_datetime");
			
			$pageTitle = "Gestion des articles";
			$description = "Administration et modération des articles";
			$path = 'post/dashboard';
			
		}
		elseif($this->modelName === '\models\Comment')
		{
			$totalItems = count($this->model->findAllWithTheirAuthor('c_id = ?', ""));
			$items = $this->model->countItemsDashboard($start, $itemPerpage, "c_datetime");
			
			$pageTitle = "Gestion des commentaires";
			$description = "Administration et modération des commentaires";
			$path = 'comment/dashboard';
			
		}

		$totalPages = ceil($totalItems/$itemPerpage);

		\Renderer::render($path, compact('pageTitle', 'description', 'items', 'totalPages'));
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
