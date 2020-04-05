<?php

use App\models\entities\Entity;
//require 'App/models/entities/Entity.php';

class Post extends Entity
{

    /**
     *  private accessible only into this class
     * public accessible into and outdoor class
     * @var $p_id int id of post
     * @var $p_author_fk int post author (foreign key)
     * @var $p_title string var(150)
     * @var $p_extract string
     * @var $p_content string
     * @var $p_datetime string
     * @var $p_vote int
     * @var $p_status string enum('Brouillon', 'Publié', 'Modifié', 'Supprimé')
     * @var $p_reporting string enum('Signalé', 'Non signalé', 'Modéré')
     * @var $p_category string  enum('Présentation','Analyse Fondamentale','Stratégie d''investissement','Ressources, lexique, tutoriels','Trading','Divers')
     */
    public $p_id;
    public $p_author_fk;
    public $p_title;
    public $p_extract;
    public $p_content;
    public $p_datetime;
    public $p_vote;
    public $p_status;
    public $p_reporting;
    public $p_category;

}