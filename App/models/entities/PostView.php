<?php 

namespace models\entities;

class PostView extends Entity
{
	//comment
	public $c_id;
	public $c_post_title;
	public $c_post_fk; //foreign key
	public $c_author_name;
	public $c_author_fk; //foreign key
	public $c_reporting;
    public $c_datetime;
	public $c_title;	
	public $c_content;
	public $c_status;
	public $c_vote;
	//post
	public $p_id;
	public $p_author_fk;
	public $p_author_name;
	public $p_title;
	public $p_extract;
	public $p_content;
	public $p_datetime;
	public $p_vote;
    public $p_status;
    public $p_reporting;
	public $p_category;
	//user
    public $u_nickname;
    public $u_role;
    public $u_number_speech;
}
