INSERT into blog_article_category select id,category_id from blog_article;
alter table blog_category CHANGE create_time create_time int(10) not null default 0 COMMENT '添加时间';