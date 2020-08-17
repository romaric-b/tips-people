<?php

namespace models;
use PDO;


class Post extends Manager //A noter au moment du test dans index le p_author_fk et p_vote passent avec ou sans '' (soit dans le tableau au moment de l'instanciation soit avec $post->p_vote = 0;) 
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "post";
	protected $sqlFields = "p_author_fk, p_title, p_extract, p_content, p_datetime, p_vote, p_status, p_reporting, p_category";
	protected $readingFields = "p_author_fk, p_title, p_extract, p_content, DATE_FORMAT(p_datetime, '%d/%m/%Y à %Hh%imin') AS p_datetime, p_vote, p_status, p_reporting, p_category";
	protected $values = ":p_author_fk, :p_title, :p_extract, :p_content, NOW(), :p_vote, :p_status, :p_reporting, :p_category";	
	protected $set = "p_title = :p_title, p_extract = :p_extract, p_content = :p_content, p_datetime = NOW(), p_vote = :p_vote, p_status = :p_status, p_reporting = :p_reporting, p_category = :p_category";

	//Pour les jointures
	protected $id = 'p_id';

	protected $tableJoined1 = "comment"; //Je sais pas s'il faut pas ça dans Manager
	protected $tableJoined2 = "user";

	protected $foreign_key1 = "c_author_fk";
	protected $foreign_key2 = "p_author_fk";

	protected $idFiedTable1 = "u_id";
	protected $idFiedTable2 = "c_id";
	
	public function findWithHisAuthor(?int $id, ?string $where = "", ?string $order = "")
	{
		$sql = "SELECT
		u_nickname AS p_author_name, p_id, p_extract, p_author_fk, p_title, p_content, p_datetime, p_vote, p_status, p_reporting, p_category
		FROM post
		INNER JOIN user ON p_author_fk = u_id
		";

		//Conditions in request if parameter choosed
		if ($where)
		{
			$sql .= " WHERE " . $where;
		} 
		elseif (empty($where))
		{
			/* $sql .= " WHERE = ?"; */
			$sql .= " WHERE p_id = " . $id;
		}

		if ($order)
		{
			$sql .= " ORDER BY " . $order; 
		}

		//var_dump($sql);
		$query = $this->pdo->prepare($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'models\entities\PostView');

		//var_dump($query);
		//$items = [];
		/* $object = new \models\entities\PostView(); */
	
        $query->execute(array($id));
		//test :
		/* while ($data = $query->fetchObject('models\entities\Comment')) */
		//while ($item = $query->fetchObject('models\entities\PostView'))
		/* while ($item = $query->fetchAll())
		{
			$items[] = $item;
		} */
		$item = $query->fetch();

		//var_dump($item);
		//$object = new \models\entities\PostView($items);
		//var_dump($object);

		return $item;
	}	

	public function findAllWithTheirAuthor(?string $order = "")
	{
		$sql = "SELECT
		u_nickname AS p_author_name, p_id, p_extract, p_author_fk, p_title, p_content, p_datetime, p_vote, p_status, p_reporting, p_category
		FROM post
		INNER JOIN user ON p_author_fk = u_id
		";

		//Conditions in request if parameter choosed
		/* 
		if ($order)
		{
			$sql .= " ORDER BY " . $order; 
		}
		elseif (empty($order))
		{
			$sql .= " ORDER BY p_id";
		} */



		var_dump($sql);
		$query = $this->pdo->query($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'models\entities\PostView');

		//var_dump($query);
		//$items = [];
		/* $object = new \models\entities\PostView(); */
	
        $query->execute();
		//test :
		/* while ($data = $query->fetchObject('models\entities\Comment')) */
		//while ($item = $query->fetchObject('models\entities\PostView'))
		/* while ($item = $query->fetchAll())
		{
			$items[] = $item;
		} */
		$items = $query->fetchAll();

		//var_dump($item);
		//$object = new \models\entities\PostView($items);
		//var_dump($object);

		return $items;
	}	
}
