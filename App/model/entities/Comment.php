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

    public function __construct(array $datas = array())
    {
        if (!empty($datas))
        {
            $this->hydrate($datas);
        }
    }

    /**
     * @param array $datas setted to my entity's parameters
     */
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///         SETTERS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param mixed $comment_id
     */
    public function setCommentId($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    /**
     * @param mixed $comment_status
     */
    public function setCommentStatus($comment_status)
    {
        $this->comment_status = $comment_status;
    }

    /**
     * @param mixed $comment_date
     */
    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    /**
     * @param mixed $comment_content
     */
    public function setCommentContent($comment_content)
    {
        if(isset($comment_content) && !empty($comment_content) && is_string($comment_content) && strlen($comment_content) <= 500)
        {
            $this->comment_content = $comment_content;
        }
        else
        {
            $this->msg = 'Le format ou la longueur de votre commentaire n\'est pas correct';
            return;
        }
    }

    /**
     * @param mixed $comment_post_id
     */
    public function setCommentPostId($comment_post_id)
    {
        $this->comment_post_id = $comment_post_id;
    }

    /**
     * @param mixed $comment_user_id
     */
    public function setCommentUserId($comment_user_id)
    {
        $this->comment_user_id = $comment_user_id;
    }

    /**
     * @param $author
     */
    public function setAuthor($author)
    {
        if(is_string($author))
        {
            $this->author=$author;
        }
    }

    /** Peut être inutile
     * @param $comment_post_title
     */
    public function setPostTitle($comment_post_title)
    {
        if(is_string($comment_post_title))
        {
            $this->author=$comment_post_title;
        }
    }

    /**
     * @param mixed $comment_read
     */
    public function setCommentRead($comment_read)
    {
        $this->comment_read = $comment_read;
    }

    /**
     * @param mixed $comment_vote
     */
    public function setCommentVote($comment_vote)
    {
        $this->comment_vote = $comment_vote;
    }



    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //      GETTERS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * @return mixed
     */
    public function getCommentStatus()
    {
        return $this->comment_status;
    }

//    public function getCommentStatusFr() inutile car enum en français sur le p5
//    {
//        if($this->comment_status == 'unsignaled')
//        {
//            return $this->comment_status_fr = 'Non signalé';
//        }
//        elseif($this->comment_status == 'signaled')
//        {
//            return $this->comment_status_fr = 'Signalé';
//        }
//        elseif($this->comment_status == 'moderated')
//        {
//            return $this->comment_status_fr = 'Modéré';
//        }
//    }

    /**
     * @return mixed date fr
     */
    public function getCommentDate()
    {
        return $this->comment_date_fr;
    }

    /**
     * @return mixed
     */
    public function getCommentContent()
    {
        return $this->comment_content;
    }

    /**
     * @return mixed
     */
    public function getCommentPostId()
    {
        return $this->comment_post_id;
    }

    /**
     * @return mixed
     */
    public function getCommentUserId()
    {
        return $this->comment_user_id;
    }

    /**
     * @return mixed author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed comment_post_title
     */
    public function getPostTitle()
    {
        return $this->comment_post_title;
    }

    public function getMessage()
    {
        return $this->msg;
    }

    /**
     * @return mixed
     */
    public function getCommentRead()
    {
        return $this->comment_read;
    }

//    public function getCommentReadFr() inutile car enum en français sur le p5
//    {
//        if($this->comment_read == 'read')
//        {
//            return $this->comment_read_fr = 'Lu';
//        }
//        elseif($this->comment_read == 'not read')
//        {
//            return $this->comment_read_fr = 'Non lu';
//        }
//    }

    /**
     * @return mixed
     */
    public function getCommentVote()
    {
        return $this->comment_vote;
    }
}