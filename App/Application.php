<?php


class Application
{
    /**
     * Pour instancier dynamiquement le bon controller et appeler la bonne tâche PUTAIN C EST TROP GENIAL !!!
     */
    public static function process()
    {
        $controllerName = "PostController";
        $task = "index";

        if(!empty($_GET['controller']))
        {
            $controllerName = ucfirst($_GET['controller']);
        }

        if(!empty($_GET['task']))
        {
            $task = $_GET['task'];
        }

        $controllerName = "\controllers\'" . $controllerName;
        // lui il échappe bizarrement //$controllerName = "\Controllers\\" . $controllerName;

        $controller = new $controllerName(); //Equivaut à new PostController()
        $controller->task(); //equivaut à $postController->index()
    }
}
