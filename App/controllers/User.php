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

				\Renderer::render('message/error', compact('pageTitle', 'message', 'author', 'description'));
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
						'u_role' => 'Membre'
					]
				);

				$this->model->create($user);
			
				/* $pageTitle = "Bienvenue";			

				$description = "Bienvenue sur Tips People, la communauté francophone d'investisseurs.";

				$author = "Invest People";

				\Renderer::render('user/register', compact('pageTitle', 'description' ,'nickname', 'author')); */
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

			\Renderer::render('message/error', compact('pageTitle', 'message', 'author', 'description'));
		}
		elseif($nickname != null && $password != null && !empty($matchedUser))
		{
			if(password_verify($loggingUser->u_password, $matchedUser['u_password']));
			{
				//$hashPass = password_hash($loggingUser->u_password, PASSWORD_DEFAULT);

				//3: Enregistrement en session des données utilisateurs utiles à la navigation
				//\Http::addSession('u_nickname, u_role', $matchedUser);

				$_SESSION['u_nickname'] = $matchedUser['u_nickname'];
				$_SESSION['u_id'] = $matchedUser['u_id'];
				$_SESSION['u_role'] = $matchedUser['u_role'];
				$_SESSION['u_email'] = $matchedUser['u_email'];
				$_SESSION['u_datetime'] = $matchedUser['u_datetime'];

				//TODO à refacto

				$pageTitle = "Bon retour";
		
				$description = "Bienvenue sur Tips People, la communauté francophone d'investisseurs.";

				$author = "Invest People";

				$nickname = $_SESSION['u_nickname'];

				\Renderer::render('user/logged', compact('pageTitle', 'description' ,'nickname', 'author'));
			}
		}
	}

	public function viewProfile()
	{
		$pageTitle = "Profile";
		
		$description = "Informations du votre profile";

		$author = "Invest People";

		\Renderer::render('user/profile', compact('pageTitle', 'description', 'author'));
	}

	public function disconnect()
	{
		\Http::killSession();

		$pageTitle = "Déconexion";
		
		$description = "Déconnexion effectuée avec succès";

		\Renderer::render('user/profile', compact('pageTitle', 'description', 'author'));
	}

	public function upgradeMember()
	{
		$upgradedMember = new \models\entities\User(
			[
				'u_id' => $_POST['u_id_upgrade'],
				'u_role' => 'Modérateur'
			]
		);

		$this->model->updateRole('u_id', $upgradedMember);

		$pageTitle = "Demande prise en compte";
		$description = "Promotion membre";
		$information = "Ce membre est maintenant modérateur";

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
	}

	public function downgradeMember()
	{
		$downgradedMember = new \models\entities\User(
			[
				'u_id' => $_POST['u_id_downgrade'],
				'u_role' => 'Membre'
			]
		);

		$this->model->updateRole('u_id', $downgradedMember);

		$pageTitle = "Demande prise en compte";
		$description = "Changement rôle";
		$information = "Ce modérateur est de nouveau membre";

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
	}
}
