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
		var_dump('dans http redirect');
        header("Location: " . $url);
        //exit();
	}

	/* public static function addSession(?string $attributs = '', ?object $user) //TODO a débuguer
	{
		$attributsArray = explode(", ", $attributs);
		var_dump($attributsArray);
				
		$_SESSION = [];

		foreach($attributsArray as $attribut)
		{
			$_SESSION[$attribut] = $user[$attribut];
		}
		var_dump($_SESSION);
	} */

	/**
	 * Tableau de données utilisateur à détruire
	 * exemple une déconnexion, j'oublie l'id de l'internaute
	 *
	 * @param array $data
	 * @return void
	 */
	public static function killSession(array $data)
	{
		$_SESSION = array();
        session_destroy();
	}
	
	//Redirections, session, paramètres en get ou post
}
