<?php

namespace core;

class Model extends \vendor\PDOWrapper
{
    public function __construct()
    {
    	//要想获得其他文件的数据，首先的加载进来（不是类，就不用名字空间）
    	require CONFIG_PATH . DS . 'config.php';
    	parent::__construct(Application::$config['database']);
    }

     public function count($where = '2 > 1')
    {
        $sql = "SELECT count(*) as count FROM `{$this->table}` WHERE {$where}";
        $row = $this->getOne($sql);
        return $row['count'];
    }

  public function findAll($where = '2 > 1', $order = 'id ASC', $offset = 0, $limit = false)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE {$where} ORDER BY {$order}";
        if($limit !== false) {
            $sql .= " LIMIT {$offset}, {$limit}";
        }
     // echo $sql;die;
    return $this->getAll($sql);
  }
 /* public function findAll($where = '2 > 1')
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE {$where}";
    return $this->getAll($sql);
  }
*/
	
public function findOneBy($where = '2>1')
{
  $sql = "SELECT * FROM {$this->table} WHERE {$where} limit 1";
  return $this->getone($sql);
}

  public function findOneById($id)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE id={$id}";
    return $this->getOne($sql);
  }

	 public function add($data)
    {
    	/*//用户传的形式  想着怎样转换和拼接
    	$data = array(
         '字段名' => '字段值',
         '字段名' => '字段值'
    	);
    	 
    	

    	 */
    	
    	//因为是字符串 所以先定义一个空的字符串 放进要放进的数据 pro_name,price,
    	$columns = '';
    	//'{$data['pro_name']},{$data['price']},.......'
    	$values = '';
    	foreach($data as $column => $value) {
    		$columns = $columns . $column . ',';
    		$values  = $values . "'".$value."'".',';
    	}
     
      $columns = rtrim($columns, ',');
      $values  = rtrim($values, ',');

      $sql = "INSERT INTO `{$this->table}`
       ($columns)
      VALUES
      ($values)";
      return $this->exec($sql);
    }


public function updateById($id, $data, $primaryKey='id') 
{
  $sets = '';
  //username = '{$_POST['Username']}',nickname = '{$_POST['Nickname']}'
  foreach($data as $column => $value) {
    $sets = $sets . "{$column} = '{$value}',";
 }
 $sets = rtrim($sets, ',');
 $sql = "UPDATE `{$this->table}` SET {$sets} WHERE {$primaryKey} = {$id}";
 return $this->exec($sql);
}

public function deleteById($id)
  {
    $sql = "DELETE FROM `{$this->table}` WHERE id={$id}";
    return $this->exec($sql);
  }

	public static function create($modelClassName = false)
	{
    if(!$modelClassName) {
      $modelClassName = get_called_class();
    }
   
    static $models = array();
		if (isset($models[$modelClassName])) {
			return $models[$modelClassName];
		} else {
			$xxx = new $modelClassName;// new Product
			return $models[$modelClassName] = $xxx;// $models['Product']
		}
	}
}