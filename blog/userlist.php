<?php
header('content-type:text/html; charset=utf8');
//查询所有用户，显示到html中
$mysqli = new mysqli("localhost", "root", "root", "userlist5");


$sql = "SELECT * FROM `user` WHERE 2>1";
$rst = $mysqli->query($sql);
//从资源里获取数据
$users = array();
while($user = mysqli_fetch_assoc($rst)) {
	$users[] = $user;
}
//var_dump($users);die;


require('userlist.html');
?>



