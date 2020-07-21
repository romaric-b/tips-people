<?php

namespace controllers;

//use Models\Post;

class Post extends Controller
{
	protected $model; //accessible dans la class même et la parente
    
	protected $modelName = '\models\Post'; //=  // MOI JE VEUX : new PostManager(); // //dans le tuto la class enfant ex: PostController prend "\Models\Article" (le chemin de class c'est chiant...)

	protected $modelJoindedName = '\models\Comment';
	
	public function insert()
    {
		//Pour le test 
		//TODO utiliser un service de session
		$_SESSION['logedUser'] = 2;

		//TODO créer un service 
		$date = new \DateTime();
		
		$dateStr = $date->format('Y-m-d H:i:s');
		//$dateStr = $date->format('d-m-y H:i'); 
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$post = new \models\entities\Post(
			[
				'p_title' => $_POST['p_title'],
				'p_extract' => $_POST['p_extract'],
				'p_content' => $_POST['p_content'],
				'p_vote' => '0',
				'p_author_fk' => $_SESSION['logedUser'],
				'p_datetime' => $dateStr,
				'p_reporting' => 'Non signalé',
				'p_category' => 'Présentation',
				'p_status' => 'Non lu'
			]
		);
		
		$this->model->create($post);
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

        \Renderer::render('post/index', compact('pageTitle', 'posts', 'description', 'author', 'cssFile'));
    }

    public function show()
    {
		//Montrer un article
		$post = $this->model->findWithHisAuthor($_GET['id']);
		$comments = $this->modelJoinded->findWithHisAuthor($_GET['id']);
		//TODO refactoriser la jointure dans le parent
		$_SESSION['p_id'] = $post->p_id;

		//var_dump($post);

		//var_dump($item);
		$pageTitle = $post->p_title; //head page (SEO)
		//var_dump($pageTitle);
		
		$description = $post->p_extract; //head page (SEO)

		$author = $post->p_author_name;

		$cssFile = "/public/css/post/index.css";
		
		//Utiliser compact comme un array
        \Renderer::render('post/post', compact('pageTitle', 'description', 'post', 'comments', 'author', 'cssFile'));
	}

	public function dashboard()
	{
		//Montrer un article
		$posts = $this->model->findAllWithTheirAuthor("p_id = ?", "");
		//TODO refactoriser la jointure dans le parent

		//var_dump($post);

		//var_dump($item);
		$pageTitle = "Tableau de bord des articles"; //head page (SEO)
		//var_dump($pageTitle);
		
		$description = "Administration et modération des articles"; //head page (SEO)

		$author = "Invest People";

		$cssFile = "/public/css/dashboard.css";
		
		//Utiliser compact comme un array
        \Renderer::render('post/dashboard', compact('pageTitle', 'description', 'posts', 'author', 'cssFile'));
	}

    public function delete()
    {
        //supprimer un article

        //Ne pas oublier les étapes avant XD

        \Http::redirect('index.php?controller=post&task=');
    }
}
