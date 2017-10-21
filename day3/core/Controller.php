<?php

namespace core;

// 核心控制器
class Controller
{
    protected function loadHtml($name, $data = array())
    {
//        $data = array(
//            'users' => $users,
//            'a' => '1',
//            'b' => '2',
//            'c' => '3',
//        );
        foreach($data as $variableName => $variableValue) {
            $$variableName = $variableValue;
        }
        require VIEW_PATH . DS . PLATFORM . DS . $name . '.html';
    }

    public function redirect($url, $msg = '', $waitSeconds = 3)
    {
        header('Refresh: ' . $waitSeconds . '; url=' . $url);
        echo $msg;
    }
}





















