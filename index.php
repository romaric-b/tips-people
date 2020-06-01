<?php

//Test entitées ok
//Test des managers


//require 'App/models/entities/Comment.php';

use models\CommentManager;
use models\entities\Comment;
use models\PostManager;
use models\UserManager;

require_once('App/autoload.php');
//\Application::process();

//var_dump($comment);
/* $comment = new models\entities\Comment([
    'c_id' => '1',
    'c_post_fk' => '5',
    'c_author_fk' => '8',
    'c_reporting' => 'Non signalé',
    'c_status' => 'Non lu',
    'c_datetime' => '05/04/2020',
    'c_title' => 'Titre commentaire',
    'c_content' => 'Contenu de mon commentaire, jeeej.',
    'c_vote' => '20'
]); */


//TODO à la création du compte je n'oublie pas d'utiliser un service pour formater la date
// et je la passe après l'instanciation de mon objet comme suit : $post->$p_datetime = $dateFr;
//initialiser le vote à 0



// Définition date 
/* $now = new DateTime();
$now->format('d/m/Y', 'H:i:s');
var_dump($now); */
/* echo strftime('%A %d %B %Y %I:%M:%S'). '<br>';
$now = setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']); */

//DATE pour n'importe quelle entité

/* $date = new DateTime();
$dateFr = $date->format('d-m-y H:i'); */

//Test POST
/* $post = new models\entities\Post([
	'p_author_fk' => '1',
    'p_title' => 'Titre com',
    'p_extract' => 'extrait',
	'p_content' => 'contenu jeeeej',
    'p_status' => 'Brouillon',
    'p_reporting' => 'Signalé',
    'p_category' => 'Présentation'
]); */
/* $post->p_datetime = $dateFr;
$post->p_vote = 0; */
//$post->p_author_fk = 1;
/* var_dump($post); */
//TODO Test du manager à faire avec adaptations pour les variables
/* $postManager = new PostManager();
$postManager->create($post); */

/* $comment = new models\entities\Comment([
    'c_post_fk' => '2',
    'c_author_fk' => '7',
    'c_reporting' => 'Non signalé',
    'c_status' => 'Non lu',
    'c_title' => 'Titre commentaire',
    'c_content' => 'Contenu de mon commentaire, jeeej.'
]); 

$comment->c_datetime = $dateFr;
$comment->c_vote = 2; */
//$commentManager = new CommentManager();
/* $commentManager->create($comment); */


/* $comments = $commentManager->findWithOthers();
var_dump($comments); */

//Test USER
/* $user = new models\entities\User([
	'u_id' => '1',
    'u_nickname' => 'NewKevin82',
    'u_email' => 'keke@gmail.com',
    'u_password' => '1234',
    'u_role' => 'Membre',
    'u_grade' => 'Nouveau',
    'u_number_speech' => '1'
]);

$user->u_datetime = $dateFr;
$userManager = new UserManager();

$id = $user->u_id;
var_dump($id);

$userManager->update($id, $user); */
//var_dump($comment->c_status);
//echo date_format($date, 'Y-m-d');

//echo 'Date courante: ' . date('d-m-y H:i:s') . "\n";





//TODO controlers + interface ou class static de contrôles d'attributs

