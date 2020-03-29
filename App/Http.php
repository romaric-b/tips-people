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
}