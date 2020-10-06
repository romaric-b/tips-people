<?php

namespace models;

use Models\Manager;

class User extends Manager
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "user";
	protected $sqlFields = "u_nickname,  u_datetime, u_email, u_password, u_role, u_number_speech";
	protected $readingFields = "u_id, u_nickname, DATE_FORMAT(u_datetime, '%d/%m/%Y à %Hh%imin')AS u_datetime, u_email, u_password, u_role, u_number_speech";
	protected $values = ":u_id, :u_nickname, NOW(), :u_email, :u_password, :u_role, :u_number_speech";
	protected $set = "u_nickname = :u_nickname, u_datetime = NOW(), u_email = :u_email, u_password = :u_password, u_role = :u_role, u_number_speech = :u_number_speech";

	//Functions are still existing by parent class Manager
}
