<?php

use App\controllers\PostController;
use App\models\entities\User;
use App\models\entities\Entity;

require 'vendor/autoload.php';
require 'App/models/entities/User.php';

//\Application::process();



$user = new User([
    'nickname' => 'toto',
    'email' => 'bobodu93@gmail.com'
    //'nickname' => 'toto',
    //'email' => 'bobodu93@gmail.com'
]);
$user->test();
var_dump($user);