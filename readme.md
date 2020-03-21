##  基于[Laravel5.6](https://github.com/laravel/laravel/tree/5.6 "Laravel5.6") 开发发的博客
本博客基于Laravel5.6，所以要求 `PHP>=7.2`
* 克隆源代码到本地：
 ```
    git clone git@github.com:vvk/laravel_blog.git
 ```
* 安装依赖包
 ```
    composer install
 ```
* 生成配置文件
 ```
    cp .env.example .env 
 ```
* 编辑 `.env` 文件里的下面内容为自己的实际配置信息
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
* 执行数据库迁移
```
php artisan migrate
```
* 填充初始数据
```
php artisan db:seed
```

至此，博客安装完成
>* 前台地址：`http://example.com`
>* 后台地址：`http://example.com/admin`
>* 账号/密码：`admin/admin`

* 图床功能  
默认已添加图片功能，目前只支持上传到又拍云云存储上（后台添加文章、分类缩略图也可以使用又拍云驱动），使用的驱动是 [https://github.com/vvk/upyun-filesystem](https://github.com/vvk/upyun-filesystem)。  
或要使用图床功能，首先需要在又拍云上购买相应的服务，然后修改`.env`中的默认配置：
```
UPYUN_SERVICE=xxx
UPYUN_OPERATOR=xxx
UPYUN_PASSWORD=xxx
UPYUN_DOMAIND=u-cdn.sviping.com
```
如果这四项没有配置，则图床功能不能使用。