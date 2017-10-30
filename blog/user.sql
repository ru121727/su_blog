---主键  数字 int 不能为空  没有默认值
---用户名 字符串 varchar(20) 不能为空 没有默认值
--- 昵称 字符串 varchar(16) 不能为空 默认值为空字符串
---邮箱 字符串(80) 不能为空 没有默认值（视具体情况）
---上次登录时间的时间戳 last_login_time  数字 int unsigned 不能为空 默认值



CREATE TABLE `user` (
	`id` INT NOT NULL  PRIMARY KEY auto_increment,
	`username` varchar(20) NOT NULL,
	`nickname` varchar(20) NOT NULL DEFAULT '',
	`email` varchar(80) NOT NULL,
	`last_login_time` INT unsigned NOT NULL DEFAULT 0,
	`last_login_ip` varchar(15) NOT NULLL DEFAULT ''
)ENGINE=innoDB DEFAULT CHARSET = utf8;

insert into `user` (username) VALUES(1);
insert into `user` VALUES(2,'','','','','');



insert into `article`(category_id,title,content) values('','','');
