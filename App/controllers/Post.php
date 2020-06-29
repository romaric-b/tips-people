<?php

namespace controllers;

//use Models\Post;

class Post extends Controller
{
	protected $model; //accessible dans la class même et la parente
    
	protected $modelName = '\models\Post'; //=  // MOI JE VEUX : new PostManager(); // //dans le tuto la class enfant ex: PostController prend "\Models\Article" (le chemin de class c'est chiant...)

	protected $modelJoindedName = '\models\Comment';
	

    public function index()
    {
        //montrer la liste

        //récupéré les articles
		$posts = $this->model->findAll("p_datetime DESC"); //TODO faudra réadapter suite à protected $modelName...
		
        //afficher les articles
		$pageTitle = "Articles";
		
		$description = "Liste des articles";

		$author = "Invest People";

		$cssFile = "/public/css/post/index.css";

        \Renderer::render('post/index', compact('pageTitle', 'posts', 'description', 'author', 'cssFile'));
    }

    public function show()
    {
		//Montrer un article
		$post = $this->model->findWithHisAuthor($_GET['id']);
		$comments = $this->modelJoinded->findWithHisAuthor($_GET['id']); //TODO refactoriser la jointure dans le parent

		//var_dump($post);

		//var_dump($item);
		$pageTitle = $post->p_title; //head page (SEO)
		//var_dump($pageTitle);
		
		$description = $post->p_extract; //head page (SEO)

		$author = $post->p_author_name;

		$cssFile = "/public/css/post/index.css";
		
		//Utiliser compact comme un array
        \Renderer::render('post/post', compact('pageTitle', 'description', 'post', 'comments', 'description', 'author', 'cssFile'));
	}

    public function delete()
    {
        //supprimer un article

        //Ne pas oublier les étapes avant XD

        \Http::redirect('index.php?controller=post&task=');
    }
}
