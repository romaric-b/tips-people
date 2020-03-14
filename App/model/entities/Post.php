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
    ///         SETTERS : affecter une valeur à une propriété d'objet private
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    /**
     * @param mixed $post_author
     */
    public function setPostAuthor($post_author)
    {
        $this->post_author = $post_author;
    }

    /**
     * @param mixed $post_vote //TODO incrémentation soit sql soit php
     */
    public function setPostVote($post_vote)
    {
        $this->post_vote = $post_vote;
    }

    /**
     * @param mixed $post_status
     */
    public function setPostStatus($post_status)
    {
        $this->post_status = $post_status;
    }

    /**
     * @param mixed $post_reporting
     */
    public function setPostReporting($post_reporting)
    {
        $this->post_reporting = $post_reporting;
    }

    /**
     * @param mixed $post_title
     */
    public function setPostTitle($post_title)
    {
        if(isset($post_title))
        {
            if(!empty($post_title))
            {
                if(is_string($post_title) && strlen($post_title) <= 100)
                {
                    $this->post_title = $post_title;
                }
                else
                {
                    $this->msg = 'Le titre est trop long';
                    return;
                }
            }
        }
    }

    /**
     * @param mixed $post_extract
     */
    public function setPostExtract($post_extract)
    {
        if(isset($post_extract))
        {
            if(!empty($post_extract))
            {
                if(is_string($post_extract))
                {
                    $this->post_extract = $post_extract;
                }
                else
                {
                    $this->msg = 'Erreur sur le format de cet extrait';
                    return;
                }
            }
        }
    }

    /**
     * @param mixed $post_content
     */
    public function setPostContent($post_content)
    {
        if(isset($post_content))
        {
            if(!empty($post_content))
            {
                if(is_string($post_content))
                {
                    $this->post_content = $post_content;
                }
                else
                {
                    $this->msg = 'Erreur sur le format du contenu de l\'article';
                    return;
                }
            }
        }
    }

    /**
     * @param mixed $post_category
     */
    public function setPostCategory($post_category)
    {
        $this->post_category = $post_category;
    }

    /**
     * @param mixed $post_date
     */
    public function setPostDate($post_date)
    {
        $this->post_date = $post_date;
    }

    /**
     * @param mixed $post_date_fr
     */
    public function setPostDateFr($post_date_fr)
    {
        $this->post_date_fr = $post_date_fr;
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //      GETTERS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @return mixed
     */
    public function getPostAuthor()
    {
        return $this->post_author;
    }

    /**
     * @return mixed
     */
    public function getPostVote()
    {
        return $this->post_vote;
    }

    /**
     * @return mixed
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * @return mixed
     */
    public function getPostReporting()
    {
        return $this->post_reporting;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * @return mixed
     */
    public function getPostExtract()
    {
        return $this->post_extract;
    }

    /**
     * @return mixed
     */
    public function getPostContent()
    {
        return $this->post_content;
    }

    public function getMessage()
    {
        return $this->msg;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->post_date_fr;
    }

    /**
     * @return mixed
     */
    public function getPostCategory()
    {
        return $this->post_category;
    }
}