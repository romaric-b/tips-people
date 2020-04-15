<?php

namespace models;

use Models\Manager;

class UserManager extends Manager
{
    //Define properties declared in Manager pour my Post Manager
    protected $table = "comment";

    //Functions are still existing by parent class Manager
}
