<?php

//Test entitées ok
//Test des managers


//require 'App/models/entities/Comment.php';

use models\CommentManager;
use models\entities\Comment;
use models\PostManager;
use models\UserManager;

//use Application;

////////////////////////////////////////////////////////
//A garder
require_once('App/autoload.php');

try
{
	session_start();

	\Application::process();
}
catch(Exception $e)
{
	echo 'Erreur : ' .  htmlspecialchars($e);
}
