<?php


class Application
{
    /**
     * Pour instancier dynamiquement le bon controller et appeler la bonne tâche
     */
    public static function process() 
    {
		//Route Par defaut
        $controllerName = "Post";
        $task = "index";

        if(!empty($_GET['controller']))
        {
			$controllerName = ucfirst($_GET['controller']);			
		}
		
        if(!empty($_GET['task']))
        {
            $task = $_GET['task'];
        }
		//chemin d'instanciation
        $controllerName = "\controllers\\" . $controllerName;

		$controller = new $controllerName(); //Equivaut à new PostController()
		
		$controller->$task(); //equivaut à $postController->index()
    }
}
