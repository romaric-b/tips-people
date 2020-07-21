<?php


namespace controllers;

//use Models\User;

class User extends Controller
{
	protected $model; //accessible dans la class même et la parente

	protected $modelName = '\models\User';

	protected $modelJoindedName = '\models\Comment';

	public function insert()
    {
		//TODO créer un service 
		$date = new \DateTime();
		
		$dateStr = $date->format('Y-m-d H:i:s');
		//$dateStr = $date->format('d-m-y H:i'); 
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$user = new \models\entities\User(
			[
				'u_nickname' => $_POST['u_nickname'],
				'u_email' => $_POST['u_email'],
				'u_password' => $_POST['u_password'],
				'u_datetime' => $dateStr,
				'u_number_speech' => 0,
				'u_role' => 'Nouveau Membre'
			]
		);
		
		$this->model->create($user);
		
		$pageTitle = "Bienvenu";

		$username = $user->u_nickname;

		$description = "Bienvenu sur Tips People, la communauté francophone d'investisseurs.";

		$author = "Invest People";

		$cssFile = "/public/css/post/index.css";

        \Renderer::render('user/register', compact('pageTitle', 'description' ,'username', 'author', 'cssFile'));
	}

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
	
	public function login()
	{
		$loggingUser = new \models\entities\User(
			[
				'u_nickname' => $_POST['u_nickname'],
				'u_password' => $_POST['u_password']
			]
		);

		$loggedNickname = $loggingUser->u_nickname;

		$matchedUser = $this->model->findWhere("u_nickname", $loggedNickname);



		if($matchedUser === 0)
		{
			return print_r('Aucun pseudo correspondant');
		}

		//TODO pour la vérif penser au mot de passe

		$pageTitle = "Bon retour";
		
		$description = "Bienvenu sur Tips People, la communauté francophone d'investisseurs.";

		$author = "Invest People";

		$cssFile = "/public/css/post/index.css";

        \Renderer::render('user/logged', compact('pageTitle', 'description' ,'loggedNickname', 'author', 'cssFile'));

	}

    public function delete()
    {
        //supprimer un article

        //Ne pas oublier les étapes avant XD

        \Http::redirect('index.php');
    }
}
