<?php


namespace models;

//A SAVOIR : Avoir la database à la racine n'est pas con non plus pour avoir la main rapidement dessus et laisser la partie
//dynamique ensemble dans l'APP
class Database
{
    private static $instance = null; //pour éviter d'appeler pdo à chaque requête

    /**
     * @return PDO connexion to database
     */
    public static function getPDO(): \PDO
    {
        if(self::$instance === null) //si c'est nul, je n'ai pas encore d'instance de PDO donc il en crée un
        {
            self::$instance = new \PDO('mysql:host=localhost;dbname=tips_people;charset=utf8', 'root', '',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        }
        //s'il existe déjà un pdo $instance est déjà défini

        //Dans les 2 cas on retourne l'instance on appelle ça "LE PATTERN DU SINGLETON"
        return self::$instance;
    }
}
