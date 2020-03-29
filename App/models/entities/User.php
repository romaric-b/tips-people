<?php

namespace App\models\entities;

use App\models\entities\Entity;
require 'App/models/entities/Entity.php';

class User extends Entity
{
    /**
     * private accessible only into this class
     * @var  $user_id
     * @var string $user_nickname
     * @var string $user_regist_date
     * @var string $user_email
     * @var string $user_password
     * @var string $user_password2
     * @var string $user_role
     * @var string $user_grade
     * @var string $user_number_speech number posts and comments
     */
    private $id;
    private $nickname;
    private $regist_date;
    private $regist_date_fr;
    private $email;
    private $password;
    private $password2;
    private $role;
    private $grade;
    private $user_number_speech;
    public $msg;

    public function test()
    {
        var_dump('User chargé');
    }

}