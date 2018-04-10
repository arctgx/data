DROP TABLE IF EXISTS `xiaomi_area`;

CREATE TABLE `xiaomi_area` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `name` varchar(128) NOT NULL COMMENT '名称',
  `fid` int(20) NOT NULL DEFAULT '0' COMMENT '父级id',
  `level` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1 省 2 市 3 县',
  `zip_code` varchar(16) NOT NULL DEFAULT '' COMMENT '邮编',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='小米地区表';
