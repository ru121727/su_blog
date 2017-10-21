<?php
namespace app\model;

class ArticleModel extends \core\Model
{
	protected $table = 'article';

	public function getAllWithJoin($where= '2>1', $sort='id ASC', $start=0, $pageSize = 10 )
	{
		$sql = "SELECT article.*, category.`name` AS category_name, user.username
		          FROM  article 
		          LEFT JOIN category ON article.category_id = category.id 
		          LEFT JOIN user ON article.author_id = user.id
		          WHERE {$where}
		          ORDER BY {$sort} 
		          LIMIT {$start}, {$pageSize}";
		//echo $sql;die;
		return $this->getAll($sql);
	}

}