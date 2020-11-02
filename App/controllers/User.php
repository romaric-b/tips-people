<?php


namespace controllers;

use Http;

//use Models\User;

class User extends Controller
{
	protected $model; //accessible dans la class même et la parente

	protected $modelName = '\models\User';

	protected $modelJoindedName = '\models\Comment';

	protected $message;

	public function insert()
    {
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post

		//1 : sécurisation des entrées
		$nickname =  \Security::controlInput($_POST['u_nickname'], 30, 'text');
		$email = \Security::controlInput($_POST['u_email'], 50, 'email');

		$password1 = \Security::controlInput($_POST['u_password'], 255, 'password');
		$password2 = \Security::controlInput($_POST['u_password2'], 255, 'password');

		$password = \Security::controlMatchingPassword($password1, $password2);
		
		if($nickname == null)
		{
			$message = 'Le format de votre pseudo est incorrect';
		}		
		elseif($email == null)
		{
			$message = 'Le format de l\'adresse email est incorrect';
		}
		elseif($password == null)
		{
			$message = 'Votre mot de passe est au mauvais format ou différent du deuxième rentré, veuillez recommencer';
			
			//TODO trop rébarbatif le \Renderer::render() Créer des valeurs par défaut pour les variables sauf message
		}
		else //Registing ok
		{
			//2 : vérification si pseudo déjà utilisé
			$matchedUser = $this->model->findWhere("u_nickname", $nickname);

			if($matchedUser > 0)
			{
				$pageTitle = "Pseudo déjà utilisé"; //pratique d'accessibilité
				$message = 'Le pseudo rentré est déjà utilisé, veuillez en choisir un autre';
				$description = "Inscription invalide";
				$author = "Tips People";
				$cssFile = "/public/css/index.css";

				\Renderer::render('message/error', compact('pageTitle', 'message', 'author', 'description', 'cssFile'));
			}
			else
			{
				//TODO créer un service 
				$date = new \DateTime();
				
				$dateStr = $date->format('Y-m-d H:i:s');

				$user = new \models\entities\User(
					[
						'u_nickname' => $nickname,
						'u_email' => $email,
						'u_password' => $password,
						//'u_datetime' => $dateStr,
						'u_number_speech' => 0,
						'u_role' => 'Nouveau Membre'
					]
				);

				$this->model->create($user);
			
				$pageTitle = "Bienvenue";			

				$description = "Bienvenue sur Tips People, la communauté francophone d'investisseurs.";

				$author = "Invest People";

				$cssFile = "/public/css/post/index.css";

				\Renderer::render('user/register', compact('pageTitle', 'description' ,'nickname', 'author', 'cssFile'));
			}
		}
	}

	//PAS d"utilité immédiate à ne voir qu'un seul individu
	/* public function show()
    {
        //Montrer un article
	} */
	
	public function login()
	{
		//1 : sécurisation des entrées
		$nickname =  \Security::controlInput($_POST['u_nickname'], 30, 'text');
		$password = \Security::controlInput($_POST['u_password'], 255, 'password');

		$loggingUser = new \models\entities\User(
		[
			'u_nickname' => $nickname,
			'u_password' => $password
		]);
		//$password = \Security::controlMatchingPassword($password1, $password2);

		//2 : vérification par pseudo si un utilisateur correspond
		$matchedUser = $this->model->findWhere("u_nickname", $nickname);

		if(empty($matchedUser))
		{
			$pageTitle = "Connexion impossible"; //pratique d'accessibilité
			$message = 'Erreur de pseudo ou de mot de passe';
			$description = "Connexion impossible";
			$author = "Tips People";
			$cssFile = "/public/css/index.css";

			\Renderer::render('message/error', compact('pageTitle', 'message', 'author', 'description', 'cssFile'));
		}
		elseif($nickname != null && $password != null && !empty($matchedUser))
		{
			if(password_verify($loggingUser->u_password, $matchedUser['u_password']));
			{
				//$hashPass = password_hash($loggingUser->u_password, PASSWORD_DEFAULT);

				//3: Enregistrement en session des données utilisateurs utiles à la navigation
				//\Http::addSession('u_nickname, u_number_speech, u_role', $matchedUser);

				$_SESSION['u_nickname'] = $matchedUser['u_nickname'];
				$_SESSION['u_id'] = $matchedUser['u_id'];
				$_SESSION['u_number_speech'] = $matchedUser['u_number_speech'];
				$_SESSION['u_role'] = $matchedUser['u_role'];
				$_SESSION['u_email'] = $matchedUser['u_email'];
				$_SESSION['u_datetime'] = $matchedUser['u_datetime'];

				/* var_dump($_SESSION['u_nickname']);
				var_dump($_SESSION['u_number_speech']);
				var_dump($_SESSION['u_role']); */

				//TODO à refacto

				$pageTitle = "Bon retour";
		
				$description = "Bienvenue sur Tips People, la communauté francophone d'investisseurs.";

				$author = "Invest People";

				$nickname = $_SESSION['u_nickname'];

				$cssFile = "/public/css/post/index.css";

				\Renderer::render('user/logged', compact('pageTitle', 'description' ,'nickname', 'author', 'cssFile'));
			}
		}
	}

	public function viewProfile()
	{
		$pageTitle = "Profile";
		
		$description = "Informations du votre profile";

		$author = "Invest People";

		$cssFile = "public/post/index.css";

		\Renderer::render('user/profile', compact('pageTitle', 'description', 'author', 'cssFile'));
	}

	public function disconnect()
	{
		\Http::killSession();
	}
}
