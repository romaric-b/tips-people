<?php


use App\models\entities\Entity;

class Comment extends Entity //ok
{
    /**
     * @var $c_id int id of comment
     * @var $c_post_fk int post id
     * @var $c_author_fk int user comment's author
     * @var $c_reporting string - enum('Signalé', 'Non signalé', 'Modéré')
     * @var $c_status string -enum('Lu', 'Non lu')
     * @var $c_datetime string datetime TODO formater date soit dans model soit via la class de controles
     * @var $c_title string title of comment varchar(150)
     * @var $c_content string text content of comment
     * @var $c_vote int number of votes for this comment
     */
    public $c_id;
    public $c_post_fk; //foreign key
    public $c_author_fk; //foreign key
    public $c_reporting;
    public $c_status;
    public $c_datetime;
    public $c_title;
    public $c_content;
    public $c_vote;

}