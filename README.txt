我们的web部分是在WAMPSERVER服务器上开发的，所以部署过程也是要在WAMPSERVER服务器上进行的。

1）首先在http://localhost:8080/phpmyadmin/（或者http://localhost/phpmyadmin/）页面创建database，我们命名为em;（数据库用户名为"root",密码为""）

创建数据库的语句为：
create database em DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

2）创建数据表，建表语句如下：
CREATE TABLE `users` 
(
`u_id` INT(20) NOT NULL auto_increment, 
`u_name` VARCHAR(20) NOT NULL, 
`u_pwd` VARCHAR(32) NOT NULL, 
PRIMARY KEY (`u_id`)
) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `resultImg` 
(
`img_id` INT(20) NOT NULL auto_increment,
`u_id` INT(20) NOT NULL, 
`content` TEXT,
PRIMARY KEY (`img_id`)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

3）解压文件夹em放在WAMPSERVER的www文件夹内，通过浏览器进入http://localhost:8080/em/（或者http://localhost/em/）页面，默认就是进入我们的index.html登录页面