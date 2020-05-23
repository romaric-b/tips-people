<?php

namespace models;

class PostManager extends Manager //A noter au moment du test dans index le p_author_fk et p_vote passent avec ou sans '' (soit dans le tableau au moment de l'instanciation soit avec $post->p_vote = 0;) 
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "post";
	protected $sqlFields = "p_author_fk, p_title, p_extract, p_content, p_datetime, p_vote, p_status, p_reporting, p_category";
	protected $values = ":p_author_fk, :p_title, :p_extract, :p_content, :p_datetime, :p_vote, :p_status, :p_reporting, :p_category";
	protected $set = "p_title = :p_title, p_extract = :p_extract, p_content = :p_content, p_datetime = :p_datetime, p_vote = :p_vote, p_status = :p_status, p_reporting = :p_reporting, p_category = :p_category";

	//Pour les jointures
	protected $id = 'p_id';
    //Functions are still existing by parent class Manager
}
