<?php

namespace models;
use PDO;


class Post extends Manager 
{
    //Define properties declared in Manager pour my Post Manager
	protected $table = "post";
	protected $sqlFields = "p_author_fk, p_title, p_extract, p_content, p_status, p_reporting, p_category, p_datetime";
	protected $readingFields = "p_id, p_author_fk, p_title, p_extract, p_content, DATE_FORMAT(p_datetime, '%d/%m/%Y à %Hh%imin') AS p_datetime, p_status, p_reporting, p_category";
	protected $values = ":p_author_fk, :p_title, :p_extract, :p_content, :p_status, :p_reporting, :p_category, NOW()";	
	protected $set = "p_id = :p_id, p_author_fk = :p_author_fk, p_title = :p_title, p_extract = :p_extract, p_content = :p_content, p_status = :p_status, p_reporting = :p_reporting, p_category = :p_category, p_datetime = NOW()";

	//Pour les jointures
	protected $setReportingField = "p_id = :p_id, p_reporting = :p_reporting";

	protected $tableJoined1 = "comment"; //Je sais pas s'il faut pas ça dans Manager
	protected $tableJoined2 = "user";

	protected $foreign_key1 = "c_author_fk";
	protected $foreign_key2 = "p_author_fk";

	protected $idFiedTable1 = "u_id";
	protected $idFiedTable2 = "c_id";

	protected $updateForId = "p_id = :p_id";
	
	public function findWithHisAuthor(?int $id, ?string $where = "", ?string $order = "")
	{
		$sql = "SELECT
		u_nickname AS p_author_name, p_id, p_extract, p_author_fk, p_title, p_content, DATE_FORMAT(p_datetime, '%d/%m/%Y à %Hh%imin') AS p_datetime, p_status, p_reporting, p_category
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

		$query = $this->pdo->prepare($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'models\entities\PostView');

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

		//$object = new \models\entities\PostView($items);

		return $item;
	}	

	public function findAllWithTheirAuthor(?string $order = "p_datetime DESC")
	{
		$sql = "SELECT
		u_nickname AS p_author_name, p_id, p_extract, p_author_fk, p_title, p_content, DATE_FORMAT(p_datetime, '%d/%m/%Y à %Hh%imin') AS p_datetime, p_status, p_reporting, p_category
		FROM post
		INNER JOIN user ON p_author_fk = u_id
		";

		if($order)
        {
            $sql .= " ORDER BY " . $order; //je concatène à la var requête sql  pour rajouter à la fin l'ordre
		}

		$query = $this->pdo->query($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'models\entities\Post');
	
        $query->execute();
		//test :
		/* while ($data = $query->fetchObject('models\entities\Comment')) */
		//while ($item = $query->fetchObject('models\entities\PostView'))
		/* while ($item = $query->fetchAll())
		{
			$items[] = $item;
		} */
		$items = $query->fetchAll();

		return $items;
	}

	public function countItems($start, $itemPerpage, ?string $order)
	{
		$sql = "SELECT
		u_nickname AS p_author_name, p_id, p_extract, p_author_fk, p_title, p_content, DATE_FORMAT(p_datetime, '%d/%m/%Y à %Hh%imin') AS p_datetime, p_status, p_reporting, p_category
		FROM post
		INNER JOIN user ON p_author_fk = u_id
		";

		//Conditions in request if parameter choosed
		$sql .= " ORDER BY " . $order; //je concatène à la var requête sql  pour rajouter à la fin l'ordre	

		$sql .= " DESC LIMIT " . $start . "," . $itemPerpage;

		$query = $this->pdo->prepare($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'models\entities\Post');
		
        $query->execute();
		
		$items = $query->fetchAll();

		return $items;
	}
}
