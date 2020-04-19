<?php

namespace models;

class PostManager extends Manager
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "post";
	protected $sqlFields = "p_title, p_extract, p_content, p_datetime, p_status, p_reporting, p_category";
	protected $values = ":p_title, :p_extract, :p_content, :p_datetime, :p_status, :p_reporting, :p_category";
	protected $set = "p_title = :p_title, p_extract = :p_extract, p_content = :p_content, p_datetime = :p_datetime, p_vote = :p_vote, p_status = :p_status, p_reporting = :p_reporting, p_category = :p_category";

    //Functions are still existing by parent class Manager
}
