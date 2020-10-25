<?php

namespace models;
use PDO;

//use Models\Manager;

class Comment extends Manager
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "comment";
	protected $sqlFields = "c_post_fk, c_author_fk, c_reporting, c_status, c_datetime, c_title, c_content, c_vote";
	protected $readingFields = "c_post_fk, c_author_fk, c_reporting, c_status, DATE_FORMAT(c_datetime, '%d/%m/%Y à %Hh%imin') AS c_datetime, c_title, c_content, c_vote";
	protected $values = ":c_post_fk, :c_author_fk, :c_reporting, :c_status, NOW(), :c_title, :c_content, :c_vote";
	protected $set = "c_id = :c_id, c_post_fk = :c_post_fk, c_reporting = :c_reporting, c_status = :c_status, c_title = :c_title, c_content = :c_content, c_vote = :c_vote, c_datetime = NOW()";
		
	protected $tableJoined1 = "post"; //Je sais pas s'il faut pas ça dans Manager
	protected $tableJoined2 = "user";

	protected $foreign_key1 = "c_post_fk";
	protected $foreign_key2 = "c_author_fk";

	protected $idFiedTable1 = "p_id";
	protected $idFiedTable2 = "u_id";

	protected $updateForId = "c_id = :c_id";

	//protected $id = 'c_id';

	
	//Global functions are still existing by parent class Manager	


	//Function of this class specialy
	public function findWithHisAuthor(?int $id, ?string $where = "", ?string $order = "")
	{
		var_dump($id);
		$sql = "SELECT
		u_nickname AS c_author_name, c_id, c_author_fk, c_title, c_content, c_datetime, c_vote, c_status, c_reporting, c_post_fk
		FROM comment
		INNER JOIN user ON c_author_fk = u_id
		";

		//Conditions in request if parameter choosed
		if ($where)
		{
			$sql .= " WHERE " . $where;
		} 
		elseif (empty($where))
		{
			/* $sql .= " WHERE = ?"; */
			$sql .= " WHERE c_post_fk = " . $id;
		}

		if ($order)
		{
			$sql .= " ORDER BY " . $order; 
		}

		//var_dump($sql);
		$query = $this->pdo->prepare($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'models\entities\PostView');
		
        $query->execute(array($id));
		
		$items = $query->fetchAll();

		return $items;
	}	

	public function findAllWithTheirAuthor(?string $order = "")
	{
		$sql = "SELECT
		u_nickname AS c_author_name, c_id, c_author_fk, c_title, c_content, c_datetime, c_vote, c_status, c_reporting, c_post_fk
		FROM comment
		INNER JOIN user ON c_author_fk = u_id
		";

		//Conditions in request if parameter choosed
		
		/* if ($order)
		{
			$sql .= " ORDER BY " . $order; 
		} */

		//var_dump($sql);
		$query = $this->pdo->query($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'models\entities\PostView');
	
		$query->execute();
		
		$items = $query->fetchAll();

		return $items;
	}	
}
