���ǵ�web��������WAMPSERVER�������Ͽ����ģ����Բ������Ҳ��Ҫ��WAMPSERVER�������Ͻ��еġ�

1��������http://localhost:8080/phpmyadmin/������http://localhost/phpmyadmin/��ҳ�洴��database����������Ϊem;�����ݿ��û���Ϊ"root",����Ϊ""��

�������ݿ�����Ϊ��
create database em DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

2���������ݱ�����������£�
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

3����ѹ�ļ���em����WAMPSERVER��www�ļ����ڣ�ͨ�����������http://localhost:8080/em/������http://localhost/em/��ҳ�棬Ĭ�Ͼ��ǽ������ǵ�index.html��¼ҳ��