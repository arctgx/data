-- books
-- DROP TABLE IF EXISTS `china_pub`;
CREATE TABLE `china_pub_books` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',

  `title` varchar(256) NOT NULL COMMENT '图书标题',
  `book_id` int(20) NOT NULL COMMENT '图书id',
  `book_url` varchar(1024) NOT NULL COMMENT '图书链接',
  `cover_url` varchar(2014) NOT NULL COMMENT '封面图片链接',
  `ori_price` decimal(10,2) NOT NULL COMMENT '标价',
  `dis_price` decimal(10,2) NOT NULL COMMENT '折后价',
  `from_tag` tinyint(2) NOT NULL COMMENT '推荐标签 1 新书排行 2 关注排行 3 评论排行 4 热门收藏 5 编辑推荐 6 出版社推荐 7 重磅推荐',
  `category` tinyint(2) NOT NULL COMMENT '类别 1 计算机 2 科学技术 3 经济管理 4 人文社科',

  `process_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '处理状态 0 未处理 1 已处理',

  `create_at` int NOT NULL COMMENT '纪录创建时间',
  `update_at` int NOT NULL COMMENT '纪录最后更新时间',

  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='china_pub图书';

