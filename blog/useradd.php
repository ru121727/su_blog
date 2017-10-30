<?php  
header('content-type:text/html; charset=utf8');
$a= 'niao';
echo "'{$a}'";die;

//var_dump($_POST);
//初始化数据库 将数据插入到数据库
$mysqli = new mysqli("localhost", "root", "root", "userlist5");

$sql = "INSERT INTO `user` (username, nickname, email) VALUES('{$_POST['Username']}', '{$_POST['Nickname']}', '{$_POST['Email']}')";

if($mysqli->query($sql)) {
	echo "插入成功";
} else{
	echo "插入失败";
}
require('useradd.html');