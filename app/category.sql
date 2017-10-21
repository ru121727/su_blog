---序号  数字  主键 不能为空 没有默认值
-----排序 数字  不能为空  默认值为0
----名称 字符串  不能为空 没有默认值
----别名 字符串 不能为空 默认值''
---父分类的ID  数字  不能为空 默认为0

CREATE TABLE `category` (
`id` INT PRIMARY KEY NOT NULL auto_increment,
`sort` INT NOT NULL DEFAULT 0,
`name` varchar(10) NOT NULL ,
`nickname` varchar(30) NOT NULL DEFAULT '',
`parent_id` INT NOT NULL DEFAULT 0 
)ENGINE = Innodb DEFAULT CHARSET utf8;


---id 主键
---category_id
CREATE TABLE　`article` (
`id` INT PRIMARY KEY auto_increment,
`category_id` INT NOT NULL DEFAULT 0,
`author_id` INT NOT NULL ,
`title` vachar(25) NOT NULL,
`published_date` INT NOT NULL,
`status` TINYINT NOTＮＵＬＬDEFAULT 1
)ENGINE=innodb DEFAULT CHARSET utf8;

ALTER TABLE `article` ADD COLUMN `content` TEXT;
ALTER TABLE `article` ADD COLUMN `top` TINYINT NOT NULL DEFAULT 2;


CREATE TABLE `comment` (
`id` INT PRIMARY KEY auto_increment,
`user_id` INT NOT NULL ,
`article_id` INT NOT NULL ,
`parent_id` INT NOT NULL DEFAULT 0,
`content` varchar(500) NOT NULL ,
`publish_time` INT NOT NULL
)ENGINE = innodb DEFAULT CHARSET utf8;


INSERT INTO `comment` VALUES
(NULL, 1, 1, 0, '么么哒'，1464936963);
(NULL, 2, 2, 0, '么么哒'，1464936962);
(NULL, 1, 3, 0, '么么哒'，1464936964);
(NULL, 3, 3, 0, '么么哒'，1464936963);
(NULL, 2, 1, 0, '么么哒'，1464936965);