<?php

namespace models;

abstract class Manager //Abastract empeche cette class d'être directement instanciée car elle est faite pour être utilisée par ces enfants
{
    protected $pdo;
	protected $table; //table est définie dans les classes enfantes, et protected permet de relier l'information entre les 2
	//Pour create et update il faudra les colonnes sql et les values
	protected $sqlFields;
	protected $values;
	protected $set;

    public function __construct()
    {
        $this->pdo = Database::getPDO(); //On défini dans un autre fichier le login, mdp base de pdo afin de laisser ce fichier réutilisable
    }

    /**************************************************************************************************
     *
     *                                          CREATE
     *
     *************************************************************************************************/

    /**
     * @param $sqlFields sql
     * @param string|null $value values sql (exemple : NOW(), :title)
     * @param array $data array key -> value
     */
    public function create(object $entity)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table}
                ({$this->sqlFields}) 
				VALUES ({$this->values})");

			$arrayFields = explode(", ", $this->sqlFields);
		
			$datas = [];

			foreach($arrayFields as $sqlField)
			{
				$datas[$sqlField] = $entity->__get($sqlField);
			}
			
			var_dump($datas);

        $query->execute($datas);
    }
    //TODO sûrement mieux de passer un objet et que pour ce quelconque objet avec chaque get DE PROPRIETE DE l'ENTITE SI PROPRIETE DEFINIE est automatiquement appelée, mais ça implique que NOW soit fait dans l'entité

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

    public function update(?string $id = "", object $entity)
    {
        //TODO les clé du set seront les mêmes que celle du execute donc 1 entrée retournera 2 résultats dont l'un en dessous pour le set et l'autre pour l'execute
        //TODO dans le contrôleur ou ici il faudra utiliser une méthode transformant un array en string

        $query = $this->pdo->prepare(
            "UPDATE {$this->table}
			 set {$this->set} WHERE $id");
			 
			$arrayFields = explode(", ", $this->sqlFields);
		
			$datas = [];

			foreach($arrayFields as $sqlField)
			{
				$datas[$sqlField] = $entity->__get($sqlField);
			}

		$query->execute($datas);

        return $query->execute();
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
