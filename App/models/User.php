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
}
