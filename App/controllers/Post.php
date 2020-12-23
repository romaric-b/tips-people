<?php

namespace controllers;

class Post extends Controller
{
	protected $model; //accessible dans la class même et la parente
    
	protected $modelName = '\models\Post'; //=  // MOI JE VEUX : new PostManager(); // //dans le tuto la class enfant ex: PostController prend "\Models\Article" (le chemin de class c'est chiant...)

	protected $modelJoindedName = '\models\Comment';
	
	public function insert()
    {
		$idUser = $_SESSION['u_id'];
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$post = new \models\entities\Post(
			[
				'p_title' => $_POST['p_title'],
				'p_extract' => $_POST['p_extract'],
				'p_content' => $_POST['p_content'],
				'p_author_fk' => $idUser,
				'p_reporting' => 'Non signalé',
				'p_category' => 'Présentation',
				'p_status' => 'Non lu'
			]
		);
		
		//côté front
		//$jsonPost = json_encode($post, JSON_UNESCAPED_UNICODE);

		//côté serveur
		$this->model->create($post);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 	   	
		   //TODO ajax 
		//\Http::redirect("index.php?controller=post&task=index");
	}

	public function update()
	{
		$idUser = $_SESSION['u_id'];
		$idPost = $_SESSION['p_id'];
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$udaptedPost = new \models\entities\Post(
			[
				'p_id' => $idPost,
				'p_title' => $_POST['p_title'],
				'p_extract' => $_POST['p_extract'],
				'p_content' => $_POST['p_content'],
				'p_author_fk' => $idUser,
				'p_reporting' => 'Non signalé',
				'p_category' => 'Présentation',
				'p_status' => 'Non lu'
			]
		);
		
		$this->model->update('p_id', $udaptedPost);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 
		   
		//\Http::redirect("index.php?controller=post&task=index");
		\Http::redirect("index.php?controller=post&task=show&id=" . $idPost . "");
	}

	//afficher les articles VERSION SYNCHRONE
    public function index()
    {
		$totalComments = count($this->model->findAllWithTheirAuthor("p_datetime DESC"));
		$itemPerpage = 5;
		$totalPages = ceil($totalComments/$itemPerpage); //ceil around superior number
		
		if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0)
        {
            $_GET['page'] = intval($_GET['page']); //return an entier value
            $currentPage = $_GET['page'];
        }
        else
        {
            $currentPage = 1;
		}
		$start = ($currentPage - 1)*$itemPerpage;
        $posts = $this->model->countItems($start, $itemPerpage, "p_datetime");
		
		$pageTitle = "Articles";
		
		$description = "Liste des articles";

		$author = "Invest People";

        \Renderer::render('post/index', compact('pageTitle', 'posts', 'description', 'author', 'totalPages')); 
	}
	
	public function ajaxIndex()
    {
        //récupéré les articles		
		$posts = $this->model->findAllWithTheirAuthor("p_datetime DESC");
		//VERSION ASYNCHRONE
		//pour ne pas se retrouver avec des caractère au mauvais format (genre iso au lieu d' utf-8)
		echo json_encode($posts, JSON_UNESCAPED_UNICODE);
    }

    public function show()
    { 
		//$_GET['id'] will be define minimum one time (for page 1) so $_SESSION['p_id_actual'] too
		//$_SESSION['p_id_actual'] = $_GET['id'];

		//If we are on index view posts and want to see one of them, we've got 'id'
		/* if(isset($_GET['id']))
		{
			$idToGo = $_GET['id'];
		}
		//If
		elseif(!isset($_GET['id']))
		{
			$idToGo = $_SESSION['p_id_actual'];
		} */
		//Montrer un article
		$post = $this->model->findWithHisAuthor($_GET['id']);
		//$comments = $this->modelJoinded->findWithHisAuthor($_GET['id']);
		$totalComments = count($this->modelJoinded->findWithHisAuthor($_GET['id']));
		$itemPerpage = 5;
		$totalPages = ceil($totalComments/$itemPerpage); //ceil around superior number
		
		if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0)
        {
            $_GET['page'] = intval($_GET['page']); //return an entier value
            $currentPage = $_GET['page'];
        }
        else
        {
            $currentPage = 1;
		}
		$start = ($currentPage - 1)*$itemPerpage;
        $comments = $this->modelJoinded->countItems($start, $itemPerpage, $_GET['id']);

		//TODO refactoriser la jointure dans le parent
		$_SESSION['p_id'] = $post->p_id;

		//utilisateur actuellement connecté, pour comparaison utlérieur
		//$loggedUser = $_SESSION['u_nickname'];		
		$pageTitle = $post->p_title; //head page (SEO)
		
		
		$description = $post->p_extract; //head page (SEO)

		$author = $post->p_author_name;

		//Enregistré en session l'auteur ça me servira plus tard pour le droit de modification de l'article, même chose pour les commentaires
		$_SESSION['p_author'] = $post->p_author_name;
				
		//Utiliser compact comme un array
        \Renderer::render('post/post', compact('pageTitle', 'description', 'post', 'comments', 'author', 'totalPages'));
	}

	public function signalPost()
	{
		$signaledPost = new \models\entities\Post(
			[
				'p_id' => $_POST['p_id_signal'],
				'p_reporting' => 'Signalé'
			]
		);

		$this->model->updateReporting('p_id', $signaledPost);

		$pageTitle = "Demande prise en compte";
		$description = "Signalement contenu";
		$information = "Votre signalement à bien été pris en compte et sera examiné par notre équipe de modération";
		

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
	}

	public function moderatePost()
	{
		$signaledPost = new \models\entities\Post(
			[
				'p_id' => $_POST['p_id_signal'],
				'p_reporting' => 'Modéré'
			]
		);

		$this->model->updateReporting('p_id', $signaledPost);

		$pageTitle = "Demande prise en compte";
		$description = "Signalement contenu";
		$information = "Cet article est maintenant modéré";
		

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
	}
}
