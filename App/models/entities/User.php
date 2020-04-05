<?php

namespace App\models\entities;

use App\models\entities\Entity;
require 'App/models/entities/Entity.php';

class User extends Entity
{
    /**
     * private accessible only into this class
     * @var  int $u_id
     * @var string $u_nickname
     * @var string $u_datetime
     * @var string $u_email
     * @var string $u_password
     * @var string $u_role
     * @var string $u_grade
     * @var string $u_number_speech number posts and comments
     */
    public $u_id;
    public $u_nickname;
    public $u_datetime;
    public $u_email;
    public $u_password;
    public $u_role;
    public $u_grade;
    public $u_number_speech;
}