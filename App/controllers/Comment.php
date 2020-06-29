<?php


namespace controllers;

//use Models\Comment;

class Comment extends Controller
{
    protected $model; //accessible dans la class même et la parente
    protected $modelName = '\models\Comment'; //= new CommentManager();


    public function insert()
    {
        //insère un commentaire

       /*  \Http::redirect("index.php?controller=post&task=show&id=" . $p_id);  *///TODO a adapter
    }

    public function delete()
    {

       // \Http::redirect(); //TODO a remplir
    }
}
