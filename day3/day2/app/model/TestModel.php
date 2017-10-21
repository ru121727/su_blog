<?php

namespace app\model;

class TestModel extends \core\Model
{
    public function challenge()
    {
        $products = $this->getAll('SELECT * FROM `product`');
        var_dump($products);
        echo 'solution...';
    }
}