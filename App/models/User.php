<?php

namespace models;

use Models\Manager;

class User extends Manager
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "user";
	protected $sqlFields = "u_nickname, u_datetime, u_email, u_password, u_role";
	protected $readingFields = "u_id, u_nickname, DATE_FORMAT(u_datetime, '%d/%m/%Y à %Hh%imin')AS u_datetime, u_email, u_password, u_role";
	protected $values = ":u_id, :u_nickname, NOW(), :u_email, :u_password, :u_role";
	protected $set = "u_nickname = :u_nickname, u_datetime = NOW(), u_email = :u_email, u_password = :u_password, u_role = :u_role";

	protected $updateForId = "u_id = :u_id";

	protected $setRoleField = "u_id = :u_id, u_role = :u_role";


	public function updateRole(?string $id, ?object $entity)
    {
        $query = $this->pdo->prepare(
            "UPDATE {$this->table}
			 set {$this->setRoleField} WHERE {$this->updateForId}");
			 
			$updateFields = $id . ', ' . $this->sqlFields;
			 
			$arrayFields = explode(", ", $updateFields);
			
			$datas = [];

			foreach($arrayFields as $sqlField)
			{
				if (!is_null($entity->$sqlField))
				{
					$datas[$sqlField] = $entity->$sqlField; //peut-être sans le _get()
				/* var_dump($datas[$sqlField]);
				var_dump($entity->__get($sqlField)); */
				}
			}

		$query->execute($datas);

        return $query->execute();
	}

	public function countItems($start, $itemPerpage, ?string $order) //TODO : sûrement besoin de fetchObject() vérifier aussi close req->cursor()
    {		
        $sql = "SELECT {$this->readingFields} FROM {$this->table}";
        //Requete préparées sécurité ?
        
		$sql .= " ORDER BY " . $order; //je concatène à la var requête sql  pour rajouter à la fin l'ordre

		$sql .= " DESC LIMIT " . $start . "," . $itemPerpage;
		
		//var_dump($sql);

		$results = $this->pdo->query($sql);

		//Je mets un majuscule à la table j'ai le nom d'entité
		$entity = ucfirst($this->table);

		$items = array();

		//TODO vérifier si les entités fonctionnent autrement s'inspirer des requêtes à FETCH_OBJECT
		while ($item = $results->fetchObject('models\entities\\' . $entity))
		{
			//Save result in an array
			$items[] = $item;
		}
			return $items;		
	}
}
