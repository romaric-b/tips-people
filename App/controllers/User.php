<?php


namespace controllers;

//use Models\User;

class User extends Controller
{
	protected $modelName = '\models\User';

	public function index()
	{
		
        //montrer la liste

        //récupéré les articles
        $users = $this->model->findAll("created_at DESC"); //TODO faudra réadapter suite à protected $modelName...

        //afficher les articles
        $pageTitle = "Membres";

        \Renderer::render('users/index', compact('pageTitle', 'users'));
	}

	public function show()
    {
        //Montrer un article

    }

    public function delete()
    {
        //supprimer un article

        //Ne pas oublier les étapes avant XD

        \Http::redirect('index.php');
    }
}
