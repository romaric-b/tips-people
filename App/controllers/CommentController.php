<?php


namespace Controllers;



use Models\CommentManager;

class CommentController extends Controller
{
    protected $model; //accessible dans la class même et la parente
    protected $modelName; //= new CommentManager();


    public function insert()
    {
        //insère un commentaire

        \Http::redirect("index.php?controller=post&task=show&id=" . $article_id); //TODO a adapter
    }

    public function delete()
    {

        \Http::redirect(); //TODO a remplir
    }
}