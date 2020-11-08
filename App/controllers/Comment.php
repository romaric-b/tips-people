<?php

namespace controllers;

class Comment extends Controller
{
    protected $model; //accessible dans la class même et la parente
    protected $modelName = '\models\Comment'; //= new CommentManager();
	protected $modelJoindedName = '\models\User';
	
    public function insert()
    {
		$idUser = $_SESSION['u_id'];
		$idPost = $_SESSION['p_id'];
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le commentaire je l'ai, idem pour l'utilisateur qui commente
		$comment = new \models\entities\Comment(
			[
				'c_title' => $_POST['c_title'],
				'c_content' => $_POST['c_content'],
				'c_post_fk' => $idPost, //Sera plutôt dans la tambouille Http - App
				'c_author_fk' => $idUser,
				'c_reporting' => 'Non signalé',
				'c_status' => 'Non lu'
			]
		);
		
		$this->model->create($comment);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 	   	
		   //TODO ajax
		//\Http::redirect("index.php?controller=post&task=index");
	}

	//Utilisée en lecture ajax
	public function ajaxComment()
	{
		//var_dump($_GET['id']);
		$idPost = $_SESSION['p_id'];

		//$comments = $this->modelJoinded->findWithHisAuthor($_GET['id']);
		$comments = $this->model->findWithHisAuthor($idPost);

		echo json_encode($comments, JSON_UNESCAPED_UNICODE);
	}

	public function update()
	{
		//var_dump('dans control update');
		$idUser = $_SESSION['u_id'];
		$idPost = $_SESSION['p_id'];
		//var_dump($_GET['id']);
		//var_dump($_POST['c_id']);
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$udaptedComment = new \models\entities\Comment(
			[
				'c_id' => $_POST['c_id'],
				'c_title' => $_POST['c_title_update'],
				'c_content' => $_POST['c_content_update'],
				'c_post_fk' => $idPost,
				'c_author_fk' => $idUser,
				'c_reporting' => 'Non signalé',
				'c_status' => 'Non lu'
			]
		);

		//var_dump($udaptedComment);
		
		$this->model->update('c_id', $udaptedComment);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 	   	
		   //TODO ajax sur cette url 
		\Http::redirect("index.php?controller=post&task=show&id=" . $idPost . "");
	}

	/* public function signalComment($commentId)
	{
		$signaledComment = new \models\entities\Comment(
			[
				'c_id' => $commentId,
				'c_reporting' => 'Signalé'
			]
		);

		$this->model->update('c_id', $signaledComment);

		$pageTitle = "Demande prise en compte";
		$description = "Signalement contenu";
		$information = "Votre signalement à bien été pris en compte et sera examiné par notre équipe de modération";

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
	} */

	public function signalComment()
	{
		var_dump($_POST['c_id_signal']);

		$signaledComment = new \models\entities\Comment(
			[
				'c_id' => $_POST['c_id_signal'],
				'c_reporting' => 'Signalé'
			]
		);

		$this->model->updateReporting('c_id', $signaledComment);

		$pageTitle = "Demande prise en compte";
		$description = "Signalement contenu";
		$information = "Votre signalement à bien été pris en compte et sera examiné par notre équipe de modération";
		

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
	}

	public function moderateComment()
	{
		var_dump($_POST['c_id_signal']);

		$signaledComment = new \models\entities\Comment(
			[
				'c_id' => $_POST['c_id_signal'],
				'c_reporting' => 'Modéré'
			]
		);

		$this->model->updateReporting('c_id', $signaledComment);

		$pageTitle = "Demande prise en compte";
		$description = "Signalement contenu";
		$information = "Ce commentaire est maintenant modéré";
		

		\Renderer::render('info', compact('pageTitle', 'description', 'information'));
	}
}
