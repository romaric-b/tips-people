<?php

use App\controllers\PostController;
use App\models\entities\User;
use App\models\entities\Entity;

require 'vendor/autoload.php';
require 'App/models/entities/User.php';
require 'App/models/entities/Comment.php';
require 'App/models/entities/Post.php';
//\Application::process();

$comment = new Comment([
    'c_id' => '1',
    'c_post_fk' => '5',
    'c_author_fk' => '8',
    'c_reporting' => 'Non signalé',
    'c_status' => 'Non lu',
    'c_datetime' => '05/04/2020',
    'c_title' => 'Titre commentaire',
    'c_content' => 'Contenu de mon commentaire, jeeej.',
    'c_vote' => '20'
]);
var_dump($comment);

$post = new Post([
    'p_id' => '1',
    'p_author_fk' => '5',
    'p_title' => 'Titre com',
    'p_extract' => 'extrait',
    'p_content' => 'contenu jeeeej',
    'p_datetime' => '05/04/2020',
    'p_vote' => '18',
    'p_status' => 'Brouillon',
    'p_reporting' => 'Signalé',
    'p_category' => 'Présentation'
]);

var_dump($post);

$user = new User([
    'u_id' => '5',
    'u_nickname' => 'Kevin82',
    'u_datetime' => '20/02/2020',
    'u_email' => 'keke@gmail.com',
    'u_password' => '1234',
    'u_role' => 'bicraveur',
    'u_grade' => 'tollier',
    'u_number_speech' => '1'
]);

var_dump($user);

//var_dump($post->$p_id);
//var_dump($comment->c_status);

//TODO Test du manager à faire avec adaptations pour les variables
//TODO controlers + interface ou class static de contrôles d'attributs