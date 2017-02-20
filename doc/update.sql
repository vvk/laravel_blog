INSERT into blog_article_category select id,category_id from blog_article;
alter table blog_category CHANGE create_time create_time int(10) not null default 0 COMMENT '添加时间';
ALTER TABLE `blog_article` DROP COLUMN `category_id`;

ALTER TABLE `blog_links`
CHANGE COLUMN `link_order` `rank`  tinyint(1) UNSIGNED NOT NULL DEFAULT 50 COMMENT '排序' AFTER `target`;

ALTER TABLE `blog_links` DROP COLUMN `target`;
