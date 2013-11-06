CREATE TABLE `tad_lunch2` (
  `lunch_sn` smallint(6) unsigned NOT NULL auto_increment COMMENT '編號',
  `lunch_title` varchar(255) NOT NULL default '' COMMENT '菜單名稱',
  `lunch_factory` varchar(255) NOT NULL default '' COMMENT '廠商名稱',
  `lunch_dietician` varchar(255) NOT NULL default '' COMMENT '營養師',
  `lunch_factory_tel` varchar(255) NOT NULL default '' COMMENT '廠商電話',
  `lunch_factory_fax` varchar(255) NOT NULL default '' COMMENT '廠商傳真',
  `lunch_factory_addr` varchar(255) NOT NULL default '' COMMENT '廠商地址',
PRIMARY KEY (`lunch_sn`)
) ENGINE=MyISAM;

CREATE TABLE `tad_lunch2_data` (
  `lunch_data_sn` mediumint(9) unsigned NOT NULL auto_increment COMMENT '流水號',
  `lunch_target` varchar(255) NOT NULL default '' COMMENT '對象',
  `lunch_sn` smallint(6) unsigned NOT NULL default '0' COMMENT '廠商',
  `lunch_date` date NOT NULL default '0000-00-00' COMMENT '日期',
  `main_food` varchar(255) NOT NULL default '' COMMENT '主食',
  `main_food_stuff` varchar(255) NOT NULL default '' COMMENT '主食食材',
  `main_dish` varchar(255) NOT NULL default '' COMMENT '主菜',
  `main_dish_stuff` varchar(255) NOT NULL default '' COMMENT '主菜食材',
  `main_dish_cook` varchar(255) NOT NULL default '' COMMENT '主菜烹煮方式',
  `side_dish1` varchar(255) NOT NULL default '' COMMENT '副菜1',
  `side_dish1_stuff` varchar(255) NOT NULL default '' COMMENT '副菜1食材',
  `side_dish1_cook` varchar(255) NOT NULL default '' COMMENT '副菜1烹煮方式',
  `side_dish2` varchar(255) NOT NULL default '' COMMENT '副菜2',
  `side_dish2_stuff` varchar(255) NOT NULL default '' COMMENT '副菜2食材',
  `side_dish2_cook` varchar(255) NOT NULL default '' COMMENT '副菜2烹煮方式',
  `side_dish3` varchar(255) NOT NULL default '' COMMENT '副菜3',
  `side_dish3_stuff` varchar(255) NOT NULL default '' COMMENT '副菜3食材',
  `side_dish3_cook` varchar(255) NOT NULL default '' COMMENT '副菜3烹煮方式',
  `fruit` varchar(255) NOT NULL default '' COMMENT '水果',
  `soup` varchar(255) NOT NULL default '' COMMENT '湯點',
  `soup_stuff` varchar(255) NOT NULL default '' COMMENT '湯點食材',
  `soup_cook` varchar(255) NOT NULL default '' COMMENT '湯點烹煮方式',
  `protein` smallint(6) unsigned NOT NULL default '0' COMMENT '蛋白質',
  `fat` smallint(6) unsigned NOT NULL default '0' COMMENT '脂肪',
  `carbohydrate` smallint(6) unsigned NOT NULL default '0' COMMENT '醣類',
  `calorie` smallint(6) unsigned NOT NULL default '0' COMMENT '總熱量',
PRIMARY KEY (`lunch_data_sn`)
) ENGINE=MyISAM;

