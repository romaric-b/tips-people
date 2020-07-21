<?php


namespace controllers;


//use Models\Comment;

class Comment extends Controller
{
    protected $model; //accessible dans la class même et la parente
    protected $modelName = '\models\Comment'; //= new CommentManager();
	protected $modelJoindedName = '\models\User';
	/* protected $entity;
	protected $entityName = '\models\entities\Comment'; finalement non car constructeur intégré aux ()*/


	public function showViewInsert()
	{
		
	}

    public function insert()
    {
		//Pour le test 
		//TODO utiliser un service de session
		$_SESSION['logedUser'] = 2;

		//TODO créer un service 
		$date = new \DateTime();
		
		$dateStr = $date->format('Y-m-d H:i:s');
		//$dateStr = $date->format('d-m-y H:i'); 
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le commentaire je l'ai, idem pour l'utilisateur qui commente
		$comment = new \models\entities\Comment(
			[
				'c_title' => $_POST['c_title'],
				'c_content' => $_POST['c_content'],
				'c_vote' => '0',
				'c_post_fk' => $_GET['id'], //Sera plutôt dans la tambouille Http - App
				'c_author_fk' => $_SESSION['logedUser'],
				'c_datetime' => $dateStr,
				'c_reporting' => 'Non signalé',
				'c_status' => 'Non lu'
			]
		);
		
		$this->model->create($comment);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 	   	
		   //TODO ajax
		//\Http::redirect("index.php?controller=post&task=index");
	}
	
	public function dashboard()
	{
		//Montrer un article
		$comments = $this->model->findAllWithTheirAuthor("c_id = ?", "");
		//TODO refactoriser la jointure dans le parent

		//var_dump($post);

		//var_dump($item);
		$pageTitle = "Tableau de bord des commentaires"; //head page (SEO)
		//var_dump($pageTitle);
		
		$description = "Administration et modération des commentaires"; //head page (SEO)

		$author = "Invest People";

		$cssFile = "/public/css/dashboard.css";
		
		//Utiliser compact comme un array
        \Renderer::render('comment/dashboard', compact('pageTitle', 'description', 'comments', 'author', 'cssFile'));
	}

    public function delete()
    {

       // \Http::redirect(); //TODO a remplir
    }
}
