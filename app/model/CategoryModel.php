<?php
namespace app\model;

class CategoryModel extends \core\Model
{
	protected $table = 'category';


	public function limitlessLevelCategory($categorys, $level = 0, $parentId = 0)
	{
		static $limitlessLevelCategorys = array();

 		foreach($categorys as $category) {
 			if($category['parent_id'] == $parentId) {
          		$category['level'] = $level;
          		$limitlessLevelCategorys[] = $category;

          		$this->limitlessLevelCategory($categorys, $level + 1, $category['id']);    
 			}
 		}
 		return $limitlessLevelCategorys;
	}

	public function getAllWithJoin()
	{
		$sql = "SELECT  category.*, count(article.id) AS count FROM category LEFT JOIN article ON category.id = article.category_id GROUP BY category.id";
		return $this->getAll($sql);
	}
	
}