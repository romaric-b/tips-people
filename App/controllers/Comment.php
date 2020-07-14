<?php


namespace controllers;

//use Models\Comment;

class Comment extends Controller
{
    protected $model; //accessible dans la class même et la parente
    protected $modelName = '\models\Comment'; //= new CommentManager();

	protected $modelJoindedName = '\models\User';


	public function showViewInsert()
	{
		
	}

    public function insert()
    {
		//Pour le test
		$_SESSION['c_author_fk'] = 2;


		//rappel, a ce stade l'id de l'article dans lequel j'insère le commentaire je l'ai, idem pour l'utilisateur qui commente
		$comment = new Comment(
			[
				'c_content' => $_POST['c_content'],
				'c_post_fk'
			]
		);

		$this->model->create();

	   /*  \Http::redirect("index.php?controller=post&task=show&id=" . $p_id);  *///TODO a adapter
	   
	
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
