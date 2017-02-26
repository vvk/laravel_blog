CREATE TABLE `blog_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'banner名称',
  `remark` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '备注',
  `url` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '跳转链接',
  `image` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '图片链接',
  `target` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否新标签打开，1:是，2:否',
  `rank` tinyint(1) unsigned NOT NULL DEFAULT '50' COMMENT ' 排序，0-255，越大优先级越高',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1:显示，2:不显示，3:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='banner表';



CREATE TABLE `blog_article_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL COMMENT '文章id',
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1 COMMENT='文章分类表';

INSERT into blog_article_category select id,category_id from blog_article;
alter table blog_category CHANGE create_time create_time int(10) not null default 0 COMMENT '添加时间';
ALTER TABLE `blog_article` DROP COLUMN `category_id`;

ALTER TABLE `blog_links`
CHANGE COLUMN `link_order` `rank`  tinyint(1) UNSIGNED NOT NULL DEFAULT 50 COMMENT '排序' AFTER `target`;

ALTER TABLE `blog_links` DROP COLUMN `target`;
