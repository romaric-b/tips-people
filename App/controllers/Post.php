<?php

namespace controllers;

class Post extends Controller
{
	protected $model; //accessible dans la class même et la parente
    
	protected $modelName = '\models\Post'; //=  // MOI JE VEUX : new PostManager(); // //dans le tuto la class enfant ex: PostController prend "\Models\Article" (le chemin de class c'est chiant...)

	protected $modelJoindedName = '\models\Comment';
	
	public function insert()
    {
		$idUser = $_SESSION['u_nickname'];
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$post = new \models\entities\Post(
			[
				'p_title' => $_POST['p_title'],
				'p_extract' => $_POST['p_extract'],
				'p_content' => $_POST['p_content'],
				'p_vote' => '0',
				'p_author_fk' => $idUser,
				'p_reporting' => 'Non signalé',
				'p_category' => 'Présentation',
				'p_status' => 'Non lu'
			]
		);
		
		$this->model->create($post);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 	   	
		   //TODO ajax 
		\Http::redirect("index.php?controller=post&task=index");
	}

	public function update()
	{
		$idUser = $_SESSION['u_nickname'];
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$udaptedPost = new \models\entities\Post(
			[
				'p_title' => $_POST['p_title'],
				'p_extract' => $_POST['p_extract'],
				'p_content' => $_POST['p_content'],
				'p_vote' => '0',
				'p_author_fk' => $_SESSION['logedUser'],
				'p_reporting' => 'Non signalé',
				'p_category' => 'Présentation',
				'p_status' => 'Non lu'
			]
		);
		
		$this->model->update($idUser, $udaptedPost);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 	   	
		   //TODO ajax sur cette url 
		\Http::redirect("index.php?controller=post&task=index");
	}

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

		var_dump($posts);

        \Renderer::render('post/index', compact('pageTitle', 'posts', 'description', 'author', 'cssFile'));
    }

    public function show()
    { 
		var_dump($_GET['id']);
		//Montrer un article
		$post = $this->model->findWithHisAuthor($_GET['id']);
		$comments = $this->modelJoinded->findWithHisAuthor($_GET['id']);
		//TODO refactoriser la jointure dans le parent
		$_SESSION['p_id'] = $post->p_id;

		//utilisateur actuellement connecté, pour comparaison utlérieur
		//$loggedUser = $_SESSION['u_nickname'];
		var_dump($post);
		//var_dump($item);
		$pageTitle = $post->p_title; //head page (SEO)
		
		
		$description = $post->p_extract; //head page (SEO)

		$author = $post->p_author_name;

		//Enregistré en session l'auteur ça me servira plus tard pour le droit de modification de l'article, même chose pour les commentaires
		$_SESSION['p_author'] = $post->p_author_name;
		
		$cssFile = "/public/css/post/index.css";
		
		//Utiliser compact comme un array
        \Renderer::render('post/post', compact('pageTitle', 'description', 'post', 'comments', 'author', 'cssFile'));
	}
}
