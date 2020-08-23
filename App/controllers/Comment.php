<?php

namespace controllers;

class Comment extends Controller
{
    protected $model; //accessible dans la class même et la parente
    protected $modelName = '\models\Comment'; //= new CommentManager();
	protected $modelJoindedName = '\models\User';
	
    public function insert()
    {
		$idUser = $_SESSION['u_nickname'];
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le commentaire je l'ai, idem pour l'utilisateur qui commente
		$comment = new \models\entities\Comment(
			[
				'c_title' => $_POST['c_title'],
				'c_content' => $_POST['c_content'],
				'c_vote' => '0',
				'c_post_fk' => $_GET['id'], //Sera plutôt dans la tambouille Http - App
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

	public function update()
	{
		$idUser = $_SESSION['u_nickname'];
		
		//rappel, a ce stade l'id de l'article dans lequel j'insère le post je l'ai, idem pour l'utilisateur qui post
		$udaptedComment = new \models\entities\Comment(
			[
				'c_title' => $_POST['c_title'],
				'c_content' => $_POST['c_content'],
				'c_vote' => '0',
				'c_post_fk' => $_GET['id'],
				'c_author_fk' => $idUser,
				'c_reporting' => 'Non signalé',
				'c_status' => 'Non lu'
			]
		);
		
		$this->model->update($idUser, $udaptedComment);
		   //\Http::redirect("index.php?controller=post&task=show&id=" . ' . $_GET['id'] . '); 	   	
		   //TODO ajax sur cette url 
		\Http::redirect("index.php?controller=post&task=index");
	}
}
