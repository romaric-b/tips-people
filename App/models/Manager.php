<?php

namespace Models;

abstract class Manager //Abastract empeche cette class d'être directement instanciée car elle est faite pour être utilisée par ces enfants
{
    protected $pdo;
    protected $table; //table est définie dans les classes enfantes, et protected permet de relier l'information entre les 2

    public function __construct()
    {
        $this->pdo = \Database::getPDO(); //On défini dans un autre fichier le login, mdp base de pdo afin de laisser ce fichier réutilisable
    }

    /**************************************************************************************************
     *
     *                                          CREATE
     *
     *************************************************************************************************/

    public function create()
    {

    }

    /**************************************************************************************************
     *
     *                                          READ
     *
     *************************************************************************************************/

    /**
     * return an item asked thanks to its ID
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        //Requete préparées sécurité ?
        $query->execute(['id => $id']);
        $item = $query->fetch();
        return $item;
    }

    /***
     * @param string|null $order
     * @return array
     */
    public function findAll(?string $order = ""): array
    {
        $sql = "SELECT * FROM {$this->table}";
        //Requete préparées sécurité ?
        if($order)
        {
            $sql .= " ORDER BY " . $order; //je concatène à la var requête sql  pour rajouter à la fin l'ordre
        }

        $results = $this->pdo->query($sql);

        //Je fouille le résultat pour en extraire les données réelles
        $items = $results->fetchAll();

        return $items;
    }

    /**************************************************************************************************
     *
     *                                          UPDATE
     *
     *************************************************************************************************/

    public function update()
    {

    }


    /**************************************************************************************************
     *
     *                                          DELETE
     *
     *************************************************************************************************/

    /**
     * Delete an item in database thanks to its ID
     * @param int $id
     * @return void TODO à supprimer une fois retenu : void comme type retourné signifie que la valeur retournée est inutile. void dans une liste de paramètre signifie que la fonction n'accepte aucun paramètre. À partir de PHP 7.1 void est accepté comme type de retour d'une fonction
     */
    public function delete(int $id):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        //Requete préparées sécurité ?
        $query->execute(['id' => $id]);
    }
}