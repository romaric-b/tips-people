<?php

namespace controllers;

use Models\PostManager;

class PostController extends Controller
{
    protected $modelName; //=  // MOI JE VEUX : new PostManager(); // //dans le tuto la class enfant ex: PostController prend "\Models\Article" (le chemin de class c'est chiant...)

    public function index()
    {
        //montrer la liste

        //récupéré les articles
        $posts = $this->model->findAll("created_at DESC"); //TODO faudra réadapter suite à protected $modelName...

        //afficher les articles
        $pageTitle = "Accueil";

        \Renderer::render('articles/index', compact('pageTitle', 'articles'));
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
