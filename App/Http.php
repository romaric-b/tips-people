<?php


class Http
{
    //Tout ce qui concerne la requête ou la réponse http. Des redirections etc...

    /**
     * redirects the visitor to the url
     * @param string $url
     * @return void
     */
    public static function redirect(string $url):void
    {
        header("Location : $url");
        exit();
	}

	public static function addSession($id)
	{

	}

	/**
	 * Tableau de données utilisateur à détruire
	 * exemple une déconnexion, j'oublie l'id de l'internaute
	 *
	 * @param array $data
	 * @return void
	 */
	public static function killSession(array $data)
	{

	}
	
	//Redirections, session, paramètres en get ou post
}
