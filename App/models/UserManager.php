<?php

namespace models;

use Models\Manager;

class UserManager extends Manager
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "user";
	protected $sqlFields = "u_nickname, u_datetime, u_email, u_password, u_role, u_grade, u_number_speech";
	protected $values = ":u_nickname, :u_datetime, :u_email, :u_password, :u_role, :u_grade, :u_number_speech";
	protected $set = "u_nickname = :u_nickname, u_datetime = :u_datetime, u_email = :u_email, u_password = :u_password, u_role = :u_role, u_grade = :u_grade, u_number_speech = :u_number_speech";

	//Functions are still existing by parent class Manager
}
