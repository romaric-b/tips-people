<?php

namespace models;

//use Models\Manager;

class CommentManager extends Manager
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "comment";
	protected $sqlFields = "c_post_fk, c_author_fk, c_reporting, c_status, c_datetime, c_title, c_content, c_vote";
	protected $values = ":c_post_fk, :c_author_fk, :c_reporting, :c_status, :c_datetime, :c_title, :c_content, :c_vote";
	protected $set = "c_reporting = :c_reporting, c_status = :c_status, c_datetime = :c_datetime, c_title = :c_title, c_content = :c_content, c_vote = :c_vote";
		
	protected $tableJoined1 = "post"; //Je sais pas s'il faut pas ça dans Manager
	protected $tableJoined2 = "user";

	protected $foreign_key1 = "c_post_fk";
	protected $foreign_key2 = "c_author_fk";

	protected $idFiedTable1 = "p_id";
	protected $idFiedTable2 = "u_id";

	
	//Global functions are still existing by parent class Manager	


	//Function of this class specialy
	public function findWithOthers(/* ?string $where = "",  ?string $groupBy = "",*/ ?string $order = "")
	{
		$sql = "SELECT c_id, p_title AS c_post_title, u_nickname AS c_author_name, {$this->sqlFields}
		FROM {$this->table}
		INNER JOIN {$this->tableJoined1} ON {$this->foreign_key1} = {$this->idFiedTable1}
		INNER JOIN {$this->tableJoined2} ON {$this->foreign_key2} = {$this->idFiedTable2}
		";
		/* $sql = "SELECT {$this->sqlFields} 
		FROM {$this->table}
		INNER JOIN {$this->tableJoined1} ON {$this->foreign_key1} = {$this->idFiedTable1}
		INNER JOIN {$this->tableJoined2} ON {$this->foreign_key2} = {$this->idFiedTable2}
		"; */
		//Conditions in request if parameter choosed
		/* if($where)
		{
			$sql .= " WHERE " . $where;
		} *//* 
		else(empty($where))
		{
			$sql .= " WHERE = ?";
		} */

		/* if($groupBy) //TODO mieux vaut utiliser DISTINCT
		{
			$sql .= " GROUP BY " . $groupBy;
		}
 */
		if($order)
		{
			$sql .= " ORDER BY " . $order; 
		}

		//$query = $this->pdo->prepare();
		$query = $this->pdo->query($sql);

		$comments = [];
		//PDO runs the lines as long as there are results
		while ($comment = $query->fetchObject('models\entities\Comment'))
		{
			//Save result in an array
			$comments[] = $comment;
		}
		return $comments;
	}
}
