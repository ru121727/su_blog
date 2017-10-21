<?php

namespace core;

class Model extends \vendor\PDOWrapper
{
    public function __construct()
    {
        parent::__construct(Application::$config['database']);
    }

	public static function create($modelClassName)
	{
		static $models = array();
		if (isset($models[$modelClassName])) {
			return $models[$modelClassName];
		} else {
			$xxx = new $modelClassName;// new Product
			return $models[$modelClassName] = $xxx;// $models['Product']
		}
	}
}