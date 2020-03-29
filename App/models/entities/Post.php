<?php



class Post
{

    /**
     *  private accessible only into this class
     * public accessible into and outdoor class
     * @var $post_id int id of post
     * @var $post_author int post author (foreign key)
     * @var $post_title string
     * @var $post_extract string
     * @var $post_content string
     * @var $post_date string
     * @var $post_date_fr string
     * @var $post_vote int
     * @var $post_status string (sql enum)
     * @var $post_reporting string (sql enum)
     * @var $post_category string (sql enum)
     * @var $msg string information message for properties
     */
    private $post_id;
    private $post_author;
    private $post_title;
    private $post_extract;
    private $post_content;
    private $post_date;
    private $post_date_fr;
    private $post_vote;
    private $post_status;
    private $post_reporting;
    private $post_category;
    public $msg;

}