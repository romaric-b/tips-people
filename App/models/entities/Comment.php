<?php



class Comment
{
    /**
     * @var int $comment_id
     * @var string enum('Non signalé' || 'Signalé' || 'Modéré') $comment_status
     * @var datetime $comment_date
     * @var string $comment_content
     * @var int $comment_post_id foreign key
     * @var int $comment_user_id foreign key
     * @var string $comment_read enum('lu' || 'non lu')
     * @var int $comment_vote
     */
    private $comment_id;
    private $comment_status;
    private $comment_status_fr;
    private $comment_date;
    private $comment_date_fr;
    private $comment_content;
    private $comment_post_id; //foreign key
    private $comment_post_title;
    private $comment_user_id; //foreign key
    private $author;
    private $comment_read;
    private $comment_read_fr;
    private $comment_vote;
    public $msg;
    //test

}